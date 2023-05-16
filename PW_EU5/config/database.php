<?php

class Database
{
    private $hostname="localhost";
    private $database="examen";
    private $username="root";
    private $password="";
    private $charset="utf8";

    function conectar()
    {
        try
        {
            $conexion="mysql:host=".$this ->hostname."; dbname=".$this->database.";
            charset=".$this->charset;
            $opciones = 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conexion, $this->username,$this->password,$opciones);
            return $pdo;
        }catch(PDOException $e)
        {
            echo 'Fallo la conexion: '.$e->getMessage();
            exit;
        }
    }
    
}
?>