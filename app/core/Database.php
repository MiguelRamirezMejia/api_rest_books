<?php
class Database
{
    private $host = 'localhost'; // Cambia esto a la dirección de tu servidor MySQL
    private $dbname = 'api_libros'; // Cambia esto al nombre de tu base de datos
    private $username = 'root'; // Cambia esto a tu nombre de usuario de MySQL
    private $password = ''; // Cambia esto a tu contraseña de MySQL

    private $conn;

    public function getConnection()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
