<?php
namespace App;

require dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once 'ErrorHandler.class.php';
use PDO;
use Dotenv\Dotenv;
use App\ErrorHandler;


class Database {
    private $servername;
    private $username;
    private $dbname;
    private $password;
    private $errorHandler;
    private $conn;

    public function __construct() {
        $this->connection();
    }

    private function connection() {
        $info = $this->getInfo();
        $this->setInfo(
            $info['servername'], 
            $info['username'], 
            $info['dbname'], 
            $info['password']
        );

        $this->errorHandler = new ErrorHandler();

        try {
            $this->conn =  new PDO("mysql:host={$this->servername}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS {$this->dbname}";
            $this->conn->exec($sql);
            echo "Database connection successful";

            $this->conn->exec("USE {$this->dbname}");

        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("Database connection failed.");
        }
    }

    private function getInfo() {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        if (!isset($_ENV['DB_SERVERNAME'])) {
            echo ".env file not loaded properly";
        } else {
            echo ".env file loaded correctly";
        }
        
        return [
            'servername' => $_ENV['DB_SERVERNAME'] ?: '',
            'username' => $_ENV['DB_USERNAME'] ?: '',
            'dbname' => $_ENV['DB_DBNAME'] ?: '',
            'password' => $_ENV['DB_PASSWORD'] ?: ''
        ];
    }

    private function setInfo($servername, $username, $dbname, $password) {
        $this->servername = $servername;
        $this->username = $username;
        $this->dbname = $dbname;
        $this->password = $password;
    }

    public function createTable() {
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
            echo "Table 'users' created successfully";

        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("Table creation failed.");
        } finally {
            $this->conn = null;
        }
    }

    public function showData() {
        try {
            $stmt = $this->conn->prepare("SELECT id, fullname, username, email, password FROM users");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            print_r($stmt->fetchAll());

        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("Theres a problem in showing the data.");
        } finally {
            $this->conn = null;
        }
    }

    public function insertDataToTable($fullname, $username, $email, $password) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // $fullname = 'adasd';
            // $username = 'test';
            // $email = 'test@gmail.com';
            // $password = 'test';
            $stmt->execute();

            echo "New record created successfully";
        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("There was a problem inserting the data in the database.");
        } finally {
            $this->conn = null;
        }
        
    }

    public function updateData() {
        try {
            $sql = "UPDATE users SET fullname = :fullname, username = :username, email = :email, password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);

            $fullname = 'ADSADASDASD';
            $username = 'Brothers';
            $email = 'mario@brothers.com';
            $password = 'marioB';
            $id = 2;

            $stmt->execute();

            echo "Record updated successfully";

        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("There was a problem updating the data");
        } finally {
            $this->conn = null;
        }
        
    }

    public function deleteData() {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = 3;

            $stmt->execute();

            echo "Data deleted successfully";
        } catch (PDOException $e) {
            $this->errorHandler->customErrorHandler(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            die("There was a problem deleting the data.");
        } finally {
            $this->conn = null;
        }
    }

}