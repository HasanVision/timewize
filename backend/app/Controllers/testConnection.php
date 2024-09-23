<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class testConnection extends Controller
{
    public function index()
    {
        // connect to the database
        $db = \Config\Database::connect();
        // run a test query
        $query = $db->query('SELECT DATABASE()');   
        $result = $query->getRow();

        echo 'Connected to the database: ' . $result->DATABASE();
    }
}
?>