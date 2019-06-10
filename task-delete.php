<?php
include('database.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    mysqli_set_charset($connection, "utf8");
    
    $query = "DELETE FROM task WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('No hay resultado o error en la conexión: '.mysqli_error($connection));
    }
    echo "Tarea eliminada con éxito";
}

?>