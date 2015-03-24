<?php

if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    if(isset($_POST['comment']) && !empty($_POST['comment'])) {

        include_once('Qry.php');
        session_start();
        $picture_id = trim($_POST['submit']);
        $check = Qry::q('SELECT picture_id FROM picture_shared WHERE shared_with_id=' . $_SESSION['login']['id']);
        $allow_comment = FALSE;
        foreach($check as $id) {
            if($id['picture_id'] == $picture_id) {
                $allow_comment = TRUE;
                break;
            }
        }
        if($allow_comment) {
            $result = Qry::qId('INSERT INTO picture_comments (text, created, picture_id, commentor_id)
                            VALUES ("'.$_POST['comment'].'", "'.date('Y-m-d H:i:s').'" ,"'.trim($_POST['submit']).'", "'.$_SESSION['login']['id'].'")');
            if($result) {
                header('Location: ../index.php?page=pictures&resource=' . urlencode('You successfully added a comment.'));
            } else {
                header('Location: ../index.php?page=pictures&error=' . urlencode('The comment did not get saved! Try again.'));
            }
        } else {
            header('Location: ../index.php?page=pictures&error=' . urlencode('The comment did not get saved! You do not have access to comment on this picture.'));
        }
    }
}