<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 13/09/19
 * Time: 16:40
 */

return [
    'client_id' => env('PASSPORT_CLIENT_ID', ''),
    'client_secret' => env('PASSPORT_CLIENT_SECRET', ''),
    'sign_in_url' => env('PASSPORT_SIGN_IN_URL', ''),
    'sign_up_url' => env('PASSPORT_SIGN_UP_URL', ''),
    'facebook_auth_url' => env('PASSPORT_FACEBOOK_AUTH_URL', ''),
    'google_auth_url' => env('PASSPORT_GOOGLE_AUTH_URL', ''),
    'get_user_from_token_url' => env('PASSPORT_GET_USER_FROM_TOKEN_URL', ''),
    'check_token_url' => env('PASSPORT_CHECK_TOKEN_URL', ''),
    'test_connection_url' => env('PASSPORT_TEST_CONNECTION_URL', ''),
    'register_url' => env('PASSPORT_REGISTER_URL', ''),
    'log_in_url' => env('PASSPORT_LOGIN_URL', ''),
    'validate_otp_url' => env('PASSPORT_VALIDATE_OTP_URL', '')
];