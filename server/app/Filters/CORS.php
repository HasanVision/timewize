<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Cors as CorsConfig;

class CORS implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $config = new CorsConfig();

        // Set CORS headers based on the configuration
        header('Access-Control-Allow-Origin: ' . implode(',', $config->default['allowedOrigins']));
        header('Access-Control-Allow-Methods: ' . implode(',', $config->default['allowedMethods']));
        header('Access-Control-Allow-Headers: ' . implode(',', $config->default['allowedHeaders']));
        header('Access-Control-Max-Age: ' . $config->default['maxAge']);

        if ($config->default['supportsCredentials']) {
            header('Access-Control-Allow-Credentials: true');
        }

        // Handle preflight (OPTIONS) requests
        if ($request->getMethod() === 'options') {
            exit();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Additional processing after the request, if needed
    }
}