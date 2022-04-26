<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiHandler;
use App\Models\Session;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Middleware
{
    protected $except = [
    ];

    protected $exceptToken = [
        'token',
    ];

    protected $forceLogin = [
        
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (in_array($request->path(), $this->except)) {
            return $next($request);
        }

        try {
            if (!in_array($request->path(), $this->exceptToken)) {
                $token = $request->header('token');
                if (trim($token) == '') {
                    throw new Exception('Informar o "token" no header');
                }

                $sid = Session::where('token', $token)->first();
                if (!$sid) {
                    throw new ApiHandler('Sua sessão foi finalizada, realize o acesso novamente', ApiHandler::TOKEN);
                }
                $sid->updated_at = Carbon::now();
                $sid->save();

                if (in_array($request->path(), $this->forceLogin)) {
                    if (!$sid->user_id) {
                        throw new ApiHandler('Sua sessão foi finalizada, realize o acesso novamente', ApiHandler::LOGIN);
                    }
                }

                $request->sid = $sid;
            }

            /**
             * @var Response $response
             */
            $response = $next($request);
            if (!is_null($response->exception)) {
                throw $response->exception;
            }

            return response()->json([
                'response' => [
                    'action' => 0,
                    'msg' => null,
                    'internal' => null,
                ],
                'data' => $response->original,
            ]);
        } catch (ApiHandler $a) {
            return response()->json([
                'response' => [
                    'action' => $a->getAction(),
                    'msg' => $a->getMessage(),
                    'internal' => null,
                ],
                'data' => null,
            ]);
        } catch (MethodNotAllowedHttpException $e) {
            return response()->json([
                'response' => [
                    'action' => ApiHandler::NONE,
                    'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                    'internal' => 'Método do endpoint não permitido',
                ],
                'data' => null,
            ]);
        } catch (HttpException $e) {
            return response()->json([
                'response' => [
                    'action' => ApiHandler::NONE,
                    'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                    'internal' => 'Rota inválida',
                ],
                'data' => null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'response' => [
                    'action' => ApiHandler::NONE,
                    'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                    'internal' => $e->getMessage(),
                ],
                'data' => null,
            ]);
        }
    }
}
