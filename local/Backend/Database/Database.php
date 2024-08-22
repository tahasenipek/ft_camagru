<?php

namespace Backend\Database;

class Database {

    private $pdo;
    private $dbName;

    public function __construct() {
        $env = parse_ini_file(__DIR__ . '/../../.env');

        if ($env === false) {
            throw new \Exception("Error Processing Request", 1);
        }
        $db = $env['DATABASE'];
        $this->dbName = $env['DATABASE_NAME'];
        $dbHost = $env['DATABASE_HOST'];
        $dbUser = $env['DATABASE_USER'];
        $dbPass = $env['DATABASE_PASSWORD'];

        try {
            // PDO'yu global namespace'den kullanmak için başına \ ekliyoruz
            $this->pdo = new \PDO("$db:host=$dbHost", $dbUser, $dbPass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            $this->createDatabase();

            $this->pdo->exec("USE `$this->dbName`");

            $this->createTables();

        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function createDatabase() {
        $query = "CREATE DATABASE IF NOT EXISTS `$this->dbName`";
        $this->pdo->exec($query);
    }

    private function createTables() {
        try {
            $query = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $this->pdo->exec($query);

            $query = "
            CREATE TABLE IF NOT EXISTS photos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT,
                photo_path VARCHAR(255) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )";
            $this->pdo->exec($query);

            $query = "
            CREATE TABLE IF NOT EXISTS comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                photo_id INT NOT NULL,
                user_id INT NOT NULL,
                comment TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (photo_id) REFERENCES photos(id),
                FOREIGN KEY (user_id) REFERENCES users(id)
            )";
            $this->pdo->exec($query);
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
