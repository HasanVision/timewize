<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Register extends ResourceController
{
    /**
     * User Registration
     */
    public function index()
    {
        $userModel = new UserModel();
        $input = $this->request->getJSON(true);

        // Retrieve input data
        $username = $input['username'];
        $email = $input['email'];
        $password = $input['password'];

        log_message('debug', 'Register input - Username: ' . $username . ', Email: ' . $email);

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
            'role' => 'employee',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($userModel->insert($userData)) {
            return $this->response
                ->setStatusCode(200)
                ->setContentType('application/json')
                ->setJSON([
                    'status' => 'success',
                    'message' => 'User registered successfully.',
                ]);
        } else {
            return $this->response
                ->setStatusCode(400)
                ->setContentType('application/json')
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid request data.',
                ]);
        }
    }
}