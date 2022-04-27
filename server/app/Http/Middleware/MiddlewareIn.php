<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiHandler;
use App\Libraries\Api;
use App\Models\Session;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MiddlewareIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
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

            if (!$sid->user_id) {
                throw new ApiHandler('Sua sessão foi finalizada, realize o acesso novamente', ApiHandler::LOGIN);
            }

            /**
             * @var Response $response
             */
            $response = $next($request);
            if (!is_null($response->exception)) {
                throw $response->exception;
            }

            return Api::ok($response->original);
        } catch (ApiHandler $a) {
            return Api::error($a->getAction(), $a->getMessage(), 'Erro de regra');
        } catch (MethodNotAllowedHttpException $b) {
            return Api::error(ApiHandler::NONE, 'Ocorreu um erro, favor tentar novamente mais tarde.', 'Método do endpoint não permitido');
        } catch (HttpException $c) {
            return Api::error(ApiHandler::NONE, 'Ocorreu um erro, favor tentar novamente mais tarde.', 'Rota inválida');
        } catch (Exception $d) {
            return Api::error(ApiHandler::NONE, 'Ocorreu um erro, favor tentar novamente mais tarde.', $d->getMessage());
        }
    }
}
