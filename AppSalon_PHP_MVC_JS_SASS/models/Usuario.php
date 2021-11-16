<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El apellido del usuario es obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";
        $resultado = self::$db->query($query);
        
        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya tiene una cuenta registrada';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function validarLogin() {
        if(!$this->email) {
            self::setAlerta('error', 'El e-mail es obligatorio');
        }
        if(!$this->password) {
            self::setAlerta('error', 'El password es obligatorio');
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::setAlerta('error', 'El e-mail es obligatorio');
        }

        return self::$alertas;
    }

    public function comprobarPassConfirmado($password) {
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado) {
            self::setAlerta('error', 'Password incorrecto o tu cuenta no ha sido confirmada');
        } else {
            return true;
        }
    }

    public function validarPassword() {
        if(!$this->password) {
            self::setAlerta('error', 'El password es obligatorio');
        }
        if(strlen($this->password) < 6) {
            self::setAlerta('error', 'El password debe tener al menos 6 caracteres');
        }

        return self::$alertas;
    }
}