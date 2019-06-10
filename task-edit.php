<?php

include('database.php');

if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['taskId'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['taskId'];
    $query = "UPDATE task SET name='$name', description='$description' WHERE id='$id'";
    // IMPORTANTE PONER LO DE MYSQLI_SET_CHARSET
    mysqli_set_charset($connection, "utf8");
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('La consulta ha fallado');
    }
    echo "Tarea actualizada con éxito";
}

?>