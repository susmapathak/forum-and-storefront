
<?php
    include 'config.php';
    doDB();
    if (!$_POST) {
        // showing the form; check for required item in query string
        if (!isset($_GET['post_id'])) {
            header("Location:topiclist1.php");
            exit;
        }


        //create safe values for use
        $safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

            //still have to verify topic and post
        $verify_sql = "SELECT ft.topic_id, ft.topic_title
                        FROM forum_posts as fp
                        LEFT JOIN forum_topics as ft
                        ON fp.topic_id =ft.topic_id
                        WHERE fp.post_id = '" . $safe_post_id . "'";


        $verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

        if (mysqli_num_rows($verify_res) < 1) {
                    //this post or topic does not exist
            header("Location:topiclist1.php");
            exit;

        } else {
                //get the topic id and title
            while ($topic_info = mysqli_fetch_array($verify_res)) {
                $topic_id = $topic_info['topic_id'];
                $topic_title = stripslashes($topic_info['topic_title']);
            }
 ?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>reply to topic</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Susma Forum Posts</h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php">Home</a></li>
        <li><a href="forum_categories.php">Forum Category</a></li>
        <li class="active"><a href="topiclist1.php">Forum Topics</a></li>
        <li><a href="forumposts.php">Forum Posts</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h4><small>Reply To Your Topic</small></h4>
      <hr>
      <p>Post Your Reply in<strong> <?php echo $topic_title; ?></strong></p>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Your Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="post_owner" required="required">
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Post Text</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_text" required="required"></textarea>
        </div>
         <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
        <button type="submit" class="btn btn-primary">Add Topic</button>
        </form>


      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>



<?php

    }
    //free result
    mysqli_free_result($verify_res);

    //close connection to MySQL
    mysqli_close($mysqli);

    } else if ($_POST) {
        print_r($_POST);

        //check for required items from form
        if ((!$_POST['topic_id']) || (!$_POST['post_text']) || (!$_POST['post_owner'])) {
            header("Location:topiclist1.php");
            exit;
        }
                //create safe values for use
        $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
        $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
        $safe_post_owner = mysqli_real_escape_string($mysqli, $_POST['post_owner']);
                //add the post
        $add_post_sql = "INSERT INTO forum_posts(
                        topic_id,
                        post_text,
                        post_create_time,
                        post_owner)
                        VALUES ('" . $safe_topic_id . "', '" . $safe_post_text . "',
                        now(),'" . $safe_post_owner . "')";

        $add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

                    //close connection to MySQL
        mysqli_close($mysqli);

                    //redirect user to topic
        header("Location:showtopic1.php?topic_id=".$_POST['topic_id']);
        exit;


    }


?>

