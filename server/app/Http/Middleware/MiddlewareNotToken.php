<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiHandler;
use App\Libraries\Api;
use Closure;
use Exception;
use Illuminate\Http\Response;
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
        header('Access-Control-Allow-Origin: *');
        try {
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
