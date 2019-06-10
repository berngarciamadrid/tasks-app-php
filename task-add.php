<?php


include('database.php');

if(isset($_POST['name']) && isset($_POST['description'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $query = "INSERT into task(name, description) VALUES('$name', '$description')";
    // IMPORTANTE PONER LO DE MYSQLI_SET_CHARSET
    mysqli_set_charset($connection, "utf8");
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('La consulta ha fallado');
    }
    echo "Tarea agregada con éxito";
}

?>