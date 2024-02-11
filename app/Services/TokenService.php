<?php

namespace App\Services;

use App\Models\User;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;
use MiladRahimi\Jwt\Cryptography\Keys\HmacKey;
use MiladRahimi\Jwt\Parser;
use MiladRahimi\Jwt\Validator\DefaultValidator;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * Class TokenService.
 */
class TokenService
{
    public function create(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    public function refresh(): string
    {
        return JWTAuth::refresh();
    }

    public function expiration(): int
    {
        return JWTAuth::factory()->getTTL() * 60;
    }

    public function verify(string $token): void
    {
        $secret = env('JWT_SECRET');
        $key = new HmacKey($secret);
        $signer = new HS256($key);
        $validator = new DefaultValidator();
        $parser = new Parser($signer, $validator);

        try {
            $parser->parse($token);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
