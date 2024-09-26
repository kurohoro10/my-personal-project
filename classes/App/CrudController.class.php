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
        $id = isset($_POST['crud-id']) ? trim($_POST['crud-id']) : null;
        $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : null;
        $username = isset($_POST['username']) ? trim($_POST['username']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : null;

        // Check if any required field is empty
        if (!$this->validate_input($fullname, $username, $email, $password, $repassword)) {
            echo "<p class='errMsg notification'>Validation failed. Data not inserted.</p>";
            return;
        }

        if (!$id) {
            // If data has no id insert it as a new record to the database
            // If all validations pass, insert data into the database
            parent::insertDataToTable( $fullname, $username, $email, $password );
            echo "<p class='successMsg notification'>Data inserted successfully</p>";
            
        }
        
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
            echo "<p class='errMsg notification'>Validation failed. Data not inserted.</p>";
            return false;
        }

        $data = parent::showSingleData($id);

        if (empty($data)) {
            return false;
        }

        // print_r($data);
        return $data;
    }

    public function update_single_data() {
        $id = isset($_POST['crud-id']) ? trim($_POST['crud-id']) : null;
        $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : null;
        $username = isset($_POST['username']) ? trim($_POST['username']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : null;
        $sanitize = new Sanitize();

        if ($id !== null) {
            $sanitize->sanitize_id_int($id);
            // If data have an id look into the database and update the data instead
            parent::updateData($id, $fullname, $username, $email, $password) ;
            echo "<p class='successMsg notification'>Data updated successfully</p>";
        }
    }

    public function delete_data() {
        $id = isset($_POST['delete_id']) ? trim($_POST['delete_id']) : null;
        $sanitize = new Sanitize();
        $sanitize->sanitize_id_int($id);

        if (!$id) {
            echo "<p class='errMsg notification'>Cannot find ID.</p>";
        }

        parent::deleteData($id);
        echo "<p class='successMsg notification'>Data deleted successfully</p>";
    }

}