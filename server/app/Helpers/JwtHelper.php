<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($user)
{
    $key = getenv('JWT_SECRET');
    $payload = [
        'iss' => 'localhost',    // Issuer of the token
        'sub' => $user['user_id'],  // Subject of the token (user ID)
        'iat' => time(),         // Time when JWT was issued
        'exp' => time() + 3600,  // Expiration time (1 hour)
    ];

    return JWT::encode($payload, $key, 'HS256');
}

function decodeJWT($token)
{
    $key = getenv('JWT_SECRET');
    return JWT::decode($token, new Key($key, 'HS256'));
}