<?php

    include('database.php');
    
    $query = "SELECT * from task";
    // IMPORTANTE PONER LO DE MYSQLI_SET_CHARSET
    mysqli_set_charset($connection, "utf8");
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('No se han obtenido datos: '.mysqli_error($connection));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>