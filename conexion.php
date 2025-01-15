<?php
//Hacemos una instancia de mysqli y la guardamos en una variable $conexiín
$conexion = new mysql('localhost', 'root', '', 'practica_asir';) //Ponemos 4 parámetros: 
//nos conectamos a localhost, el usuario es root, la contraseña en blanco. la bbdd se llama practica_asir
if ($conexion->connect_errno){
    die('Lo siento hubo un problema con el servidor')
} else {
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);
    if($resultado->num_rows){ //con este condicional comprobamos que hay datos en la bbdd
        while($fila = $resultado->fech_assoc()){
            echo $fila['ID'] . '-' . $fila['Nombre'] . '<br />';
        }
    }else {
        echo 'No hay datos';
    }
}