<?php


//Importar la conexion
require 'includes/app.php';

//Crear un email y password
$email = "admin@admin.com";
$password = "hiveten123";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (nombre, email, password, admin, confirmado) VALUES ('admin', '${email}', '${passwordHash}', 1, 1);";
// $query = "
//     CREATE TABLE IF NOT EXISTS `usuarios` (
//     `id` INT(11) NOT NULL AUTO_INCREMENT,
//     `nombre` VARCHAR(60) NULL,
//     `representante` VARCHAR(60) NULL,
//     `apellidos` VARCHAR(60),
//     `ci` INT(11) NULL,
//     `nit` INT(11) NULL,
//     `celular` VARCHAR(15) NULL,
//     `telefono` VARCHAR(15) NULL,
//     `pais` VARCHAR(50) NULL,
//     `departamento` VARCHAR(50) NULL,
//     `ciudad` VARCHAR(50) NULL,
//     `direccion` VARCHAR(50) NULL,
//     `email` VARCHAR(50) NULL,
//     `password` CHAR(60) NULL,
//     `admin` TINYINT(1) NULL,
//     `confirmado` TINYINT(1) NULL,
//     `token` VARCHAR(15) NULL, 
//     PRIMARY KEY (`id`))
//     ENGINE = InnoDB
//     DEFAULT CHARACTER SET = utf8;";
// $query = "
//     DROP TABLE usuarios;
// ";

// echo $query;
//Agregar a la base de datos
// mysqli_query($db, $query);

if($db->query($query)) {
    echo 'exito';
}

