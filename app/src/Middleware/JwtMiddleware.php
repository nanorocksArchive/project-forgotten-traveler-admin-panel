<?php

namespace App\Middleware;

use Gamegos\JWS\JWS;
use Gamegos\JWS\Exception\InvalidSignatureException;
use Gamegos\JWS\Exception\UnspecifiedAlgorithmException;
use Gamegos\JWS\Exception\MalformedSignatureException;

class JwtMiddleware
{
    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $config = require __DIR__ . '/../config.php';
        $authorization = $request->getHeaders()["HTTP_AUTHORIZATION"][0];
        $verifyJws = 1;
        $jwsData = null;

        if ($authorization != null) {
            $key = $config['jws']['key'];
            $jws = new JWS();

            try {
                $authorization = trim(str_replace($config['jws']['access'], '', $authorization));
                $jwsData = $jws->verify($authorization, $key);

                if (!is_array($jwsData)) {
                    throw new InvalidSignatureException();
                }
            }
            catch (InvalidSignatureException $e) {
                $verifyJws = 0;
            }
            catch (UnspecifiedAlgorithmException $e) {
                $verifyJws = 0;
            }
            catch (MalformedSignatureException $e){
                $verifyJws = 0;
            }

        } else {
            return $response->withJson([
                'message' => 'Forbidden',
                'status' => '403'
            ], 403);
        }

        if ($verifyJws) {
            $response = $next($request->withAttribute('jwsData', $jwsData), $response);
            return $response;

        } else {
            return $response->withJson([
                'message' => 'Unauthorized request',
                'status' => '401'
            ], 401);
        }
    }
}


