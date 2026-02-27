<?php
class Db {
    private static $pdo = null;
    public static function getConnection() {
        if (self::$pdo === null) {
            $host = "MySQL-8.4";
            $dbname = "banketam";
            $user = "root";
            $pass = "";
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            self::$pdo = new PDO($dsn, $user, $pass);
        }
        return self::$pdo;
    }
}