<div class="row">

            <?php
                if(isset($_GET['saved'])) {
                    echo '<div class="alert alert-success saved"><span class="glyphicon glyphicon-ok"></span><strong> Well done.</strong> You successfully uploaded a picture.</div>';
                }
                if(isset($_GET['comment'])) {
                    echo '<div class="alert alert-success saved"><span class="glyphicon glyphicon-ok"></span><strong> Well done.</strong> You successfully shared the picture.</div>';
                }
                if(isset($_GET['error'])) {
                    echo '<div class="alert alert-danger saved"><span class="glyphicon glyphicon-ok"></span><strong> Oh snap!.</strong> Something went wrong! ' . urldecode($_GET['error']) . '</div>';
                }
            ?>


            <h1>Picture gallery - my pictures</h1>

            <style>
                .thumbnail {
                    height: 490px;
                    overflow: hidden;
                }
                .comments {
                    height: 110px;
                    overflow-y: scroll;
                }
            </style>

            <?php
            include_once('backend/Qry.php');

            $myPictures = Qry::q('SELECT id, picture FROM pictures WHERE owner_id=' . $_SESSION["login"]['id']);

            foreach ($myPictures as $picture) {
                echo '<div class="col-sm-6 col-md-4">';
                echo '<div class="thumbnail">';
                echo '<img src="backend/uploads/'.$picture['picture'].'" alt="..." style="width: 330px; height: 200px;">';
                echo '<div class="caption">';
                echo '<h4>Comments</h4>';
                echo '<div class="comments">';
                $i = 1;
                $comments = Qry::q('SELECT id, text, created FROM picture_comments WHERE picture_id=' . $picture['id']. ' ORDER BY created');
                foreach($comments as $comment) {
                    echo '<p>'.$i++.'. '.$comment['text'].' <i style="font-size: 10px;">'.$comment['created'].'</i></p>';
                }
                echo '</div>';
                ?>
                <form id="add-comment" class="form-horizontal" action="#" method="post">
                    <div class="form-group">
                        <div class="col-md-9">
                            <input id="company-name" name="company-name" type="text" placeholder="Add comment..." class="form-control required">
                        </div>
                        <a href="#" class="btn btn-default btn-s" role="button">Add</a>
                    </div>
                </form>
                <hr>
                <form id="data-view" class="form-horizontal" action="backend/share.php" method="get">
                    <div class="form-group col-md-12">
                        <div class="col-md-8">
                            <select class="form-control" name="s">
                                <?php

                                $share = Qry::q('SELECT id, email FROM users');
                                foreach ($share as $user) {
                                    if($user['email'] != $_SESSION['login']['email']) {
                                        echo '<option value="'.$user['id'].'">'.$user['email'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="<?php echo $picture['id'] ?>" class="btn btn-primary btn-sm">Share picture</button>
                        </div>
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
                foreach ($othersPictures as $user) {
                    echo '<div class="col-sm-6 col-md-4">';
                    echo '<div class="thumbnail">';
                    echo '<img src="backend/uploads/'.$user['picture'].'" alt="..." style="width: 330px; height: 200px;">';
                    echo '<div class="caption">';
                    echo '<h4>Comments</h4>';
                    echo '<div class="comments">';
                    $i = 1;
                    $comment = Qry::q('SELECT id, text, created FROM picture_comments WHERE picture_id=' . $user['id']. ' ORDER BY created');
                    foreach($comment as $user) {
                        echo '<p>'.$i++.'. '.$user['text'].' <i style="font-size: 10px;">'.$user['created'].'</i></p>';
                    }
                    echo '</div>';
                    ?>
                    <form id="add-comment" class="form-horizontal" action="#" method="post">
                        <div class="form-group">
                            <div class="col-md-9">
                                <input id="company-name" name="company-name" type="text" placeholder="Add comment..." class="form-control required">
                            </div>
                            <a href="#" class="btn btn-default btn-s" role="button">Add</a>
                        </div>
                    </form>
                    <?php
                    echo '</div></div></div>';
                }
            ?>
        </div>