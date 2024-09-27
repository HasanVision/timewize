<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestConnection extends Controller
{
    public function index()
    {
        try {
            // Connect to the database
            $db = \Config\Database::connect();
            
            // Run a test query
            $query = $db->query('SELECT DATABASE()');   
            $result = $query->getRow();

            // Check if the database connection was successful
            if ($result) {
                echo 'Connected to the database: ' . $result->{'DATABASE()'};
            } else {
                echo 'Failed to connect to the database.';
            }
        } catch (\Exception $e) {
            echo 'Error connecting to the database: ' . $e->getMessage();
        }
    }
}
?>