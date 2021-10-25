<?php

namespace Model;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];
    
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            //crear un nuevo registro
            $this->crear();
        }
    }

    public function crear() {
        //Sanitizar atributos
        $atributos = $this->sanitizarAtributos();

        // $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedorid')";

        //Insertar en BD de una forma mas dinamica
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";

        if(self::$db->query($query)) {
            //Readireccionar al usuario

            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        //Sanitizar atributos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "';";

        if(self::$db->query($query)) {
            //Readireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminar() {

        //Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }
    
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;
    }

    public function setImagen($imagen) {
        //Elimina la imagen previa
        if(isset($this->imagen)) {
            $this->borrarImagen();
        }

        //Asignar al atributo de la imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Elimina imagen
    public function borrarImagen() {
        //eliminar el archivo
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //Lista todas los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        return self::consultarSQL($query);
    }

    //Lista registros con limite
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;
        return self::consultarSQL($query);
    }

    //Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}