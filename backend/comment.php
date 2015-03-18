<?php

if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    if(isset($_POST['comment']) && !empty($_POST['comment'])) {

        include_once('Qry.php');
        session_start();
        $result = Qry::qId('INSERT INTO picture_comments (text, created, picture_id, commentor_id)
                            VALUES ("'.$_POST['comment'].'", "'.date('Y-m-d H:i:s').'" ,"'.trim($_POST['submit']).'", "'.$_SESSION['login']['id'].'")');

        if($result) {
            header('Location: ../index.php?page=pictures&resource=' . urlencode('You successfully added a comment.'));
        } else {
            header('Location: ../index.php?page=pictures&error=' . urlencode('The comment did not get saved! Try again.'));
        }
    }

}