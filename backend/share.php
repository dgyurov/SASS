<?php

if(isset($_GET['submit']) && isset($_GET['s']) && !empty($_GET['s'])) {

    include_once('Qry.php');
    $result = Qry::qId('INSERT INTO picture_shared (picture_id, shared_with_id) VALUES ("'.trim($_GET['submit']).'", "'.trim($_GET['s']).'")');
    
    if($result) {
        header('Location: ../index.php?page=pictures&comment=saved');
    } else {
        header('Location: ../index.php?page=pictures&error=' . urlencode('The picture did not get shared! Try again later.'));
    }

}