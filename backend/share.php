<?php

if(isset($_POST['submit']) && isset($_POST['s']) && !empty($_POST['s'])) {

    include_once('Qry.php');
    $result = Qry::qId('INSERT INTO picture_shared (picture_id, shared_with_id) VALUES ("'.trim($_POST['submit']).'", "'.trim($_POST['s']).'")');
    
    if($result) {
        header('Location: ../index.php?page=pictures&resource=' . urlencode('You successfully shared the picture.'));
    } else {
        header('Location: ../index.php?page=pictures&error=' . urlencode('The picture did not get shared! Try again later.'));
    }

}