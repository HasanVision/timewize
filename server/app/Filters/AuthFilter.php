<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        if (!$header) {
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Access denied, token required.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // Extract the token
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            // Store user information in the request for future use
            $request->user = $decoded->sub;
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Access denied, invalid token.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // Return null to proceed with the request
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}