<?php

namespace Model;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/App/ErrorHandler.class.php';
require_once __DIR__ . '/Database.class.php';

use PDO;
use Model\Database;
use App\ErrorHandler;
use \Exception;
use \Throwable;

class Crud extends Database {
    protected $errorHandler;

    public function __construct() {
        parent::__construct();
        $this->errorHandler = new ErrorHandler();
    }

    protected function createTable() {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                fullname VARCHAR(255) NOT NULL,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
            )";

            $this->conn->exec($sql);
            // echo "Table 'users' created successfully";

        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die("Table creation failed.");
        }
    }

    protected function showData() {
        $this->createTable();
        try {
            // Check if the table exists
            $tableName = 'users';
            $checkTable = $this->conn->prepare("SHOW TABLES LIKE :tableName");
            $checkTable->bindParam(':tableName', $tableName);
            $checkTable->execute();

            if ($checkTable->rowCount() === 0) {
                throw new Exception("Table '$tableName' does not exist.");
            }

            $stmt = $this->conn->prepare("SELECT id, fullname, username, email, password FROM users");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();

            if (empty($data)) {
                return;
            } else {
                return $data;
            }

        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die($t->getMessage());
        }
    }

    protected function insertDataToTable($fullname, $username, $email, $password) {
        $this->createTable();

        try {
            // Check if the user already exists
            $checkStmt = $this->conn->prepare('SELECT COUNT(*) FROM users WHERE email = :email OR username = :username');
            $checkStmt->bindParam(':email', $email);
            $checkStmt->bindParam(':username', $username);
            $checkStmt->execute();

            // Get the number of existing users with the same email or username
            $count = $checkStmt->fetchColumn();

            if ( $count > 0 ) {
                throw new Exception("Email or username already exists.");
            } 

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting data into the database.");
            }

            // echo "New record created successfully";
        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die($t->getMessage());
        }
    }

    public function showSingleData($id) {
        try {
            $sql = "SELECT id, fullname, username, email, password FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                throw new Exception("Cannot get the data of the specific user.");
            } else {
                // print_r($data);
                return $data;
            }
        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die($t->getMessage());
        }
    }

    protected function updateData($id, $fullname, $username, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET fullname = :fullname, username = :username, email = :email, password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if(!$stmt->execute()) {
                throw new Exception("Error updating data in the database!");
            }

        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die($t->getMessage());
        }
        
    }

    protected function deleteData($id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die("There was a problem deleting the data.");
        }
    }
}