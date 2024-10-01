<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    /**
     * User Login
     */
    public function index()
    {
        $userModel = new UserModel();
        $input = $this->request->getJSON(true);

        // Retrieve input data
        $email = $input['email'] ;
        $password = $input['password'] ;

        // Validate the input
        if (!$email || !$password) {
            return $this->fail('Email and password are required.', 400);
        }

        // Check if the user exists
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->fail('Invalid email or password.', 401);
        }

        // Verify the password
        if (!password_verify($password, $user['password'])) {
            return $this->fail('Invalid email or password.', 401);
        }

        // Successful login
        return $this->respond([
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => [
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ]);
    }
}