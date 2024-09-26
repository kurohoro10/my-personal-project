<?php
namespace Model;

require dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/App/ErrorHandler.class.php';
use PDO;
use Dotenv\Dotenv;
use App\ErrorHandler;
use \Exception;
use \Throwable;


class Database {
    private $servername;
    private $username;
    private $dbname;
    private $password;
    private $errorHandler;
    protected $conn;

    public function __construct() {
        $this->errorHandler = new ErrorHandler();
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

        try {
            $this->conn =  new PDO("mysql:host={$this->servername}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS {$this->dbname}";
            $this->conn->exec($sql);
            // echo "Database connection successful";

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

        try {
            $dotenv->load();

            if (!isset($_ENV['DB_SERVERNAME'])) {
                throw new Exception(".env file not loaded properly");
            }
            
            return [
                'servername' => $_ENV['DB_SERVERNAME'] ?: '',
                'username' => $_ENV['DB_USERNAME'] ?: '',
                'dbname' => $_ENV['DB_DBNAME'] ?: '',
                'password' => $_ENV['DB_PASSWORD'] ?: ''
            ];
        } catch (\Throwable $t) {
            $this->errorHandler->customErrorHandler(
                $t->getCode(),
                $t->getMessage(),
                $t->getFile(),
                $t->getLine()
            );
            die("Error loading environment variables: " . $t->getMessage());
        }
    }

    private function setInfo($servername, $username, $dbname, $password) {
        $this->servername = $servername;
        $this->username = $username;
        $this->dbname = $dbname;
        $this->password = $password;
    }
}