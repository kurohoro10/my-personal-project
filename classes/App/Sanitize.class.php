<?php
namespace App;

class Sanitize {
    public function sanitize_id_int($id) {
        if($id === null && !is_int($id)) {
            echo "Cannot find ID.";
            return false;
        }

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo "Invalid ID.";
            return false;
        }

        return true;
    }

    public function sanitize_empty_string( $fields ) {
        foreach ( $fields as $key => $value ) {
            if (empty($value)) {
                echo ucfirst($key) . " is required.";
                return false;
            }
        }
        return true;
    }

    public function sanitize_name_string( $name ) {
        if ( preg_match('/[!@#$%^&*(),?":{}|<>]/', $name) ) {
            echo $name . " cannot contain any special character.";
            return false;
        }

        return true;
    }

    public function sanitize_period_count( $name, $count ) {
        if ( substr_count($name, '.') > $count ) {
            echo $name . " cannot contain more than " . $count ." periods";
            return false;
        }

        return true;
    }

    public function sanitize_email_string($email) {
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            echo "Invalid email format";
            return false;
        }

        return true;
    }

    public function sanitize_password_string($password, $repassword) {
        if ( strlen($password) < 8 ) {
            echo "Password must be 8 characters or longer.";
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            echo "Password must contain at least 1 number.";
            return false;
        }

        if ( !preg_match('/[!@#$%^&*(),?":{}|<>]/', $password) ) {
            echo "Password must contain at least 1 special character.";
            return false;
        }

        if ( !preg_match('/[A-Z]/', $password) ) {
            echo "Password must contain at least 1 uppercase letter.";
            return false;
        }

        if ( !preg_match('/[a-z]/', $password) ) {
            echo "Password must contain at least 1 lowercase letter.";
            return false;
        }

        if ( $repassword === null && $repassword !== $password ) {
            echo "Password and re-type password do not match.";
            return false;
        }

        return true;
    }
}