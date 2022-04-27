<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiHandler;
use App\Libraries\Api;
use Closure;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MiddlewareNotToken
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
            $headers = [
                'Access-Control-Allow-Origin'      => '*',
                'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age'           => '86400',
                'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, Access-Control-Allow-Credentials, Access-Control-Allow-Origin'
            ];

            if ($request->isMethod('OPTIONS')) {
                return response()->json('{"method":"OPTIONS"}', 200, $headers);
            }

            /**
             * @var Response $response
             */
            $response = $next($request);
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }


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
