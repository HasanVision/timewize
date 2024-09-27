<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;

class AuthController extends ResourceController
{
    /**
     * User Registration
     */
    public function register()
    {
        $userModel = new UserModel();

        // Retrieve input data
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Validate the input
        if (!$username || !$email || !$password) {
            return $this->fail('All fields are required.', 400);
        }

        // Check if the user already exists
        if ($userModel->where('email', $email)->first()) {
            return $this->fail('Email already exists.', 400);
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'employee',  // Default role for new users
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($userModel->insert($userData)) {
            return $this->respondCreated([
                'status' => 'success',
                'message' => 'User registered successfully.',
            ]);
        } else {
            return $this->fail('Unable to register user. Please try again.', 500);
        }
    }

    /**
     * User Login
     */
    public function login()
    {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Find the user by email
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        // Verify the password
        if (!password_verify($password, $user['password'])) {
            return $this->fail('Invalid credentials');
        }

        // Generate JWT token
        $key = getenv('JWT_SECRET');
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600, // Token expires in 1 hour
            'data' => [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]
        ];
        $token = JWT::encode($payload, $key);

        return $this->respond([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
}