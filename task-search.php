<?php

include('database.php');

$search = $_POST['search'];


if(!empty($search)) {
    $query = "SELECT * FROM task WHERE name LIKE '$search%' ";
    // IMPORTANTE PONER LO DE MYSQLI_SET_CHARSET
    mysqli_set_charset($connection, "utf8");
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Query Error: '. mysqli_error($connection));
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
}

?>