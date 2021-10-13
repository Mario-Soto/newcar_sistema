<?php
class Conexion
{
    private $dbh;
    private static $instancia; //The single instance
    private $host = 'bluedragon1.database.windows.net';
    private $usuario = 'newcar_ST';
    private $password = 'new-car_ST-lti6';
    private $nombreBaseDatos = 'new_car';

    /*
    Get an instance of the Database
    @return Instance
     */
    public static function getInstancia()
    {
        if (!self::$instancia) { // singleton
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    // Constructor
    private function __construct()
    {
        try {
            $this->dbh = new PDO("sqlsrv:server=$this->host;database=$this->nombreBaseDatos", $this->usuario, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDbh()
    {
        return $this->dbh;
    }
}
