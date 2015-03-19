<div class="row">

    <?php
    if(isset($_GET['resource'])) {
        echo '<div class="alert alert-success saved"><strong> Well done.</strong> ' . urldecode($_GET['resource']) . '</div>';
    }
    if(isset($_GET['error'])) {
        echo '<div class="alert alert-danger saved"><strong> Oh snap!.</strong> Something went wrong! ' . urldecode($_GET['error']) . '</div>';
    }
    ?>


    <h1>Picture gallery - my pictures</h1>

    <style>
        .thumbnail {
            height: 490px;
            overflow: hidden;
        }
        .comments {
            height: 160px;
            overflow-y: scroll;
        }
        .comments-shared {
            height: 190px;
            overflow-y: scroll;
        }
        .form-group {
            margin-bottom: 4px;
        }
        .share-picture {
            height: 25px;
            font-size: 12px;
            padding: 0px 12px;
            margin-bottom: 0px;
        }
    </style>

    <?php
    include_once('backend/Qry.php');

    $myPictures = Qry::q('SELECT id, picture FROM pictures WHERE owner_id=' . $_SESSION["login"]['id']);
    $share = Qry::q('SELECT id, email FROM users');

    foreach ($myPictures as $picture) {
        echo '<div class="col-sm-6 col-md-4">';
        echo '<div class="thumbnail">';
        ?>
        <form id="data-view" class="form-horizontal" action="backend/share.php" method="post">
            <div class="form-group col-md-12">
                <div class="col-md-8">
                    <select class="form-control share-picture" name="s">
                        <?php

                        foreach ($share as $user) {
                            if($user['email'] != $_SESSION['login']['email']) {
                                echo '<option value="'.$user['id'].'">'.$user['email'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" value="<?php echo $picture['id'] ?>" class="btn btn-primary btn-xs">Share picture</button>
                </div>
            </div>
        </form>
        <?php
        echo '<img src="backend/uploads/'.$picture['picture'].'" alt="..." style="width: 330px; height: 200px;">';
        echo '<div class="caption">';
        echo '<h4>Comments</h4>';
        echo '<div class="comments">';
        $i = 1;
        $comments = Qry::q('SELECT pc.text, pc.created, pc.commentor_id, u.email
                            FROM picture_comments pc
                            INNER JOIN users u
                              ON pc.commentor_id = u.id
                            WHERE picture_id=' . $picture['id']. '
                            ORDER BY pc.created');

        foreach($comments as $comment) {
            echo '<p>'.$i++.'. '.$comment['text'].' - <a>'.$comment['email'].'</a> <i style="font-size: 10px; color: gray;">'.date("jS M Y",strtotime($comment['created'])).' at '.date("H:i",strtotime($comment['created'])).'</i></p>';
        }
        echo '</div>';
        ?>
        <form id="add-comment" class="form-horizontal" action="backend/comment.php" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input id="comment" name="comment" type="text" placeholder="Add comment..." class="form-control required">
                </div>
                <button type="submit" name="submit" value="<?php echo $picture['id'] ?>" class="btn btn-primary btn-sm">Add</button>
            </div>
        </form>
        <?php
        echo '</div></div></div>';
    }

    ?>

    <script>
        $(document).ready(function() {
            $("#share_1").click(function(){
                //console.log('hi from button.');
                //alert('hi from button');
            });
        });
    </script>
</div>
<div class="row">
    <h1>Picture gallery - shared with me</h1>
    <?php

    $othersPictures = Qry::q('SELECT p.id, p.picture, u.email
                                        FROM pictures p
                                        INNER JOIN picture_shared ps
                                            ON p.id = ps.picture_id
                                        INNER JOIN users u
                                            ON p.owner_id = u.id
                                        WHERE ps.shared_with_id=' . $_SESSION["login"]['id']);

    $path = 'backend/uploads/';
    foreach ($othersPictures as $picture) {
        echo '<div class="col-sm-6 col-md-4">';
        echo '<div class="thumbnail">';
        echo '<img src="backend/uploads/'.$picture['picture'].'" alt="..." style="width: 330px; height: 200px;">';
        echo '<div class="caption">';
        echo '<h4>Comments</h4>';
        echo '<div class="comments-shared">';
        $i = 1;
        $comments = Qry::q('SELECT pc.text, pc.created, pc.commentor_id, u.email
                            FROM picture_comments pc
                            INNER JOIN users u
                              ON pc.commentor_id = u.id
                            WHERE picture_id=' . $picture['id']. '
                            ORDER BY pc.created');

        foreach($comments as $comment) {
            echo '<p>'.$i++.'. '.$comment['text'].' - <a>'.$comment['email'].'</a> <i style="font-size: 10px; color: gray;">'.date("jS M Y",strtotime($comment['created'])).' at '.date("h:m",strtotime($comment['created'])).'</i></p>';
        }
        echo '</div>';
        ?>
        <form id="add-comment" class="form-horizontal" action="backend/comment.php" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input id="comment" name="comment" type="text" placeholder="Add comment..." class="form-control required">
                </div>
                <button type="submit" name="submit" value="<?php echo $picture['id'] ?>" class="btn btn-default btn-sm">Add</button>
            </div>
        </form>
        <?php
        echo '</div></div></div>';
    }
    ?>
    <script>
        $(function() {
            $(document).ready(function() {
                $(".comments").animate({ scrollTop: $('.comments')[0].scrollHeight}, 2000);
                $(".comments-shared").animate({ scrollTop: $('.comments-shared')[0].scrollHeight}, 2000);
            });
        });


    </script>
</div>