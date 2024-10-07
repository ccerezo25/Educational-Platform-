<?php

class BD{
    public static $isntancia=null;
    public static function crearInstancia(){
        if(!isset(self::$isntancia)){
            $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$isntancia = new PDO('mysql:host=localhost;dbname=aplicacion','root','',$opciones);
            //echo "conectado...";
        }
        return self::$isntancia;
    }
}
?>