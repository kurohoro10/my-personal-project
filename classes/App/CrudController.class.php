<?php
namespace App;

require_once('Database.class.php');
use App\Database;

class CrudController {
    public function insertDataToDB() {
        $fullname = $_POST['fullname'] ?? null;
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$fullname || !$username || !$email || !$password) {
            echo "All fields are required.";
            return;
        }

        $insertToDB = new Database();
        $insertToDB->insertDataToTable($fullname, $username, $email, $password);
        echo "Data inserted successfully";
    }

    // public function testFunction() {
    //     echo "test";
    // }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crudController = new CrudController();
    $crudController->insertDataToDB();
}