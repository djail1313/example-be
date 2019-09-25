<?php

if(!function_exists('apiResponseFormat')) {
    function apiResponseFormat(
        $success = true,
        $httpCode = 200,
        $message = '',
        $result = null,
        \Illuminate\Support\MessageBag $errors = null)
    {

        $response = collect([
            'success'   => $success,
            'code'      => $httpCode,
            'message'   => $message
        ]);

        if ($result) {
            $response['result'] = collect($result);
        }

        if ($errors) {
            $response['errors'] = $errors;
        }

        return $response;

    }
}

if (!function_exists('asset_cloud')) {
    function asset_cloud(string $path)
    {
        if(config("app.url") != "https://myislami.com/" &&
            (Str::endsWith($path,".js") ||
                Str::endsWith($path,".css"))) {
            return asset($path);
        }

        $domain = config('shared.asset.domain');
        if ($path != "") {
            if ($path[0] == '/')
                $path = substr($path, 1);

            return asset($domain . "/" . $path);
        } else {
            return asset($domain);
        }

    }
}
