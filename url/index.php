<?php
require_once("../config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $conn->prepare("SELECT * FROM url WHERE url_id=:id");
    $select->execute([':id'=>$id]);
    $data = $select->fetch(pdo::FETCH_OBJ);

    $clicks = ++$data->clicks;
    $update = $conn->prepare("UPDATE url SET clicks=:clicks WHERE url_id=:id");
    $update->execute([':clicks'=>$clicks, ':id'=>$id]);

    header("location: ".$data->url);
}


?>