<?php


namespace Islami\Shared\Providers;


use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Response::macro('api', function ($result = null, $httpCode = 200, $message = '', $success = true, MessageBag $errors = null, $headers = [], $options = 0) {

            $response = Response::make(apiResponseFormat($success, $httpCode, $message, $result, $errors));

            if ($headers) {
                foreach ($headers as $key => $val) {
                    $response->header($key, $val);
                }
            }

            return $response;

        });
    }

}
