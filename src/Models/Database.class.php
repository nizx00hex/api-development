<?php
class Database {

    private static ?PDO $connection = null;

    // Establishes and returns the database connection.
    public static function connect(): PDO
    {
        if (self::$connection === null) {
            
            // $location = __DIR__ . '/../../database.json';
            $location = $_SERVER['DOCUMENT_ROOT'] .'/src/Core'. '/../../database.json';

            // echo "__DIR__: " . $location;
            // echo "<br>";
            // echo "DOCUMENT_ROOT: " . $location1;
            // echo "<br>";


            $config_json = file_get_contents($location);
            
            $config = json_decode($config_json, true);
            
            $host = $config['server'];
            $port = $config['port'];
            $dbname = $config['db_name'];
            $username = $config['username'];
            $password = $config['password'];
            $charset = $config['charset'];

            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
            // echo json_encode($dsn);
            try {
                self::$connection = new PDO(
                    $dsn,
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );

            // echo json_encode($dsn);

            } catch (PDOException $e) {
                error_log($e->getMessage());
                Response::json([
                    'error' => 'Database connection failed'
                ],500);
            }
        }

        return self::$connection;
    }
}