<?php
namespace App;

class Sanitize {
    public function sanitize_id_int($id) {
        if(!isset($id) && !is_int($id)) {
            echo "<p class='errMsg notification'>Cannot find ID.</p>";
            return false;
        }

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo "<p class='errMsg notification'>Invalid ID.</p>";
            return false;
        }

        return true;
    }

    public function sanitize_empty_string( $fields ) {
        foreach ( $fields as $key => $value ) {
            if (empty($value)) {
                echo "<p class='errMsg notification'>" . ucfirst($key) . " is required.</p>";
                return false;
            }
        }
        return true;
    }

    public function sanitize_name_string( $name ) {
        if ( preg_match('/[!@#$%^&*(),?":{}|<>]/', $name) ) {
            echo "<p class='errMsg notification'>Username or fullname cannot contain any special character.</p>";
            return false;
        }

        return true;
    }

    public function sanitize_period_count( $name, $count ) {
        if ( substr_count($name, '.') > $count ) {
            echo "<p class='errMsg notification'>" . $name . " cannot contain more than " . $count ." periods </p>";
            return false;
        }

        return true;
    }

    public function sanitize_email_string($email) {
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            echo "<p class='errMsg notification'>Invalid email format</p>";
            return false;
        }

        return true;
    }

    public function sanitize_password_string($password, $repassword) {
        if (str_contains( trim($password), ' ' )) {
            echo "<p class='errMsg notification'>Password cannot contain spaces.</p>";
            return false;
        }

        if ( strlen($password) < 8 ) {
            echo "<p class='errMsg notification'>Password must be 8 characters or longer.</p>";
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            echo "<p class='errMsg notification'>Password must contain at least 1 number.</p>";
            return false;
        }

        if ( !preg_match('/[!@#$%^&*(),?":{}|<>]/', $password) ) {
            echo "<p class='errMsg notification'>Password must contain at least 1 special character.</p>";
            return false;
        }

        if ( !preg_match('/[A-Z]/', $password) ) {
            echo "<p class='errMsg notification'>Password must contain at least 1 uppercase letter.</p>";
            return false;
        }

        if ( !preg_match('/[a-z]/', $password) ) {
            echo "<p class='errMsg notification'>Password must contain at least 1 lowercase letter.</p>";
            return false;
        }

        if ( $repassword === null && $repassword !== $password ) {
            echo "<p class='errMsg notification'>Password and re-type password do not match.</p>";
            return false;
        }

        return true;
    }
}