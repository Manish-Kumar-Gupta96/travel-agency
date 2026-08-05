<?php

declare(strict_types=1);

namespace App\Core\Security;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT
{
    public static function generate(
        array $payload
    ): string {
        $config = require BASE_PATH . '/config/app.php';

        $issuedAt = time();
        $expire = $issuedAt + $config['jwt']['expiry'];

        $data = array_merge(
            [
                'iat' => $issuedAt,
                'exp' => $expire,
                'iss' => $config['jwt']['issuer']
            ],
            $payload
        );

        return FirebaseJWT::encode(
            $data,
            $config['jwt']['secret'],
            'HS256'
        );
    }

    public static function decode(
        string $token
    ): object {
        $config = require BASE_PATH . '/config/app.php';

        return FirebaseJWT::decode(
            $token,
            new Key(
                $config['jwt']['secret'],
                'HS256'
            )
        );
    }
}
