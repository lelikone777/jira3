<?php 

namespace App;

class Codec 
{

    /**
     * @param array $params
     * @param string $key
     * @return string
     */
    public static function paramsEncode(array $params, string $key = 'puma_api_key'): string
    {
        $encrypted = openssl_encrypt(
            json_encode($params),
            'aes-256-ecb',
            md5($key),
            false,
            openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ecb'))
        );
        return str_replace('%', '-', urlencode($encrypted));
    }
}