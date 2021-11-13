<?php


//Importar la conexion
require 'includes/app.php';

//Crear un email y password
$email = "admin@admin.com";
$password = "hiveten123";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}');";
// $query = "CREATE TABLE IF NOT EXISTS `usuarios` (
//     `id` INT(1) NOT NULL AUTO_INCREMENT,
//     `email` VARCHAR(50) NULL,
//     `password` CHAR(60) NULL,
//     PRIMARY KEY (`id`))
//   ENGINE = InnoDB;";

// echo $query;
//Agregar a la base de datos
// mysqli_query($db, $query);

if($db->query($query)) {
    echo 'exito';
}

