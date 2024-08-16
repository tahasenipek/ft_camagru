<?php

class Database {

    private $pdo;

    public function __construct() {

        $env = parse_ini_file(__DIR__ . '/../../.env');

        if ($env === false) {
            throw new Exception("Error Processing Request", 1);
        }
        $db = $env['DATABASE'];
        $dbName = $env['DATABASE_NAME'];
        $dbHost = $env['DATABASE_HOST'];
        $dbUser = $env['DATABASE_USER'];
        $dbPass = $env['DATABASE_PASSWORD'];

        
        try {
            $this->pdo = new PDO("$db:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }


    public function query($query) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
