<?php
namespace App;

require_once(dirname(__DIR__) . '/model/Crud.class.php');
require_once('Sanitize.class.php');
use Model\Crud;
use App\Sanitize;

class CrudController extends Crud {
    private function validate_input( $fullname, $username, $email, $password, $repassword ) {
        $sanitize = new Sanitize();
        if ( !$sanitize->sanitize_empty_string([
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'repassword' => $repassword
        ]) ||
        !$sanitize->sanitize_name_string($fullname) ||
        !$sanitize->sanitize_name_string($username) ||
        !$sanitize->sanitize_period_count($fullname, 2) ||
        !$sanitize->sanitize_period_count($username, 1) ||
        !$sanitize->sanitize_email_string($email) ||
        !$sanitize->sanitize_password_string($password, $repassword)
        ) {
            return false;
        }

        return true;
    }

    public function createData() {
        // if (isset($_POST['submit'])) {
            $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : null;
            $username = isset($_POST['username']) ? trim($_POST['username']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;
            $repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : null;
        // }

        // Check if any required field is empty
        if (!$this->validate_input($fullname, $username, $email, $password, $repassword)) {
            echo "Validation failed. Data not inserted.";
            return;
        }

        // If all validations pass, insert data into the database
        parent::insertDataToTable( $fullname, $username, $email, $password );
        echo "Data inserted successfully";
    }

    public function showData() {
        $data = parent::showData();

        if (empty($data)) {
            return false;
        }

        return $data;
    }

    public function show_single_data() {
        $sanitize = new Sanitize();
        $id = isset($_POST['edit_button']) ? trim($_POST['edit_button']) : null;

        if (!$sanitize->sanitize_id_int($id)) {
            echo "Validation failed. Data not inserted.";
            return false;
        }

        $data = parent::showSingleData($id);

        if (empty($data)) {
            return false;
        }

        print_r($data);
        return $data;
    }

    // public function update_data() {
    //     $sanitize = new Sanitize();
    //     $id = isset($_POST['edit_button']) ? trim($_POST['edit_button']) : null;
    //     $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : null;
    //     $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    //     $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    //     $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    //     $repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : null;

    //     // Check if any required field is empty
    //     if (!$this->validate_input($fullname, $username, $email, $password, $repassword) && $sanitize->sanitize_id_int($id)) {
    //         echo "Validation failed. Data not inserted.";
    //         return;
    //     }
    // }
}

$crudController = new CrudController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_button']) && !empty($_POST['edit_button'])) {
        $crudController->show_single_data();
    } else {
        $crudController->createData();
    }
}