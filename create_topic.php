
<?php
  include 'config.php';
  doDB();
          //check for required fields from the form
  if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) || (!$_POST['post_text']) ||(!$_POST['category_id'])) {
      header("Location : addtopic.php");
      exit;
  }

          //create safe values for input into the database
  $clean_topic_owner = mysqli_real_escape_string($mysqli, $_POST['topic_owner']);
  $clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
  $clean_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
  $clean_category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);



      //create and issue the first query
  $add_topic_sql = "INSERT INTO forum_topics
          (topic_title, topic_create_time, topic_owner, category_id)
          VALUES('" . $clean_topic_title . "', now(),'" . $clean_topic_owner . "','" . $clean_category_id ."') ";

  $add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));


      //get the id of the last query
  $topic_id = mysqli_insert_id($mysqli);


      //create and issue the second query

  $add_post_sql = "INSERT INTO forum_posts
                      (topic_id, post_text, post_create_time, post_owner)
                      VALUES ('" . $topic_id . "', '" . $clean_post_text . "',
                      now(), '" . $clean_topic_owner . "')";


  $add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));


      //close connection to MySQL
  mysqli_close($mysqli);

      //create nice message for user
  $display_block = "<p>The<strong> " . $_POST["topic_title"] . "</strong> topic has been created.</p>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>topic created</title>
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
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php">Home</a></li>
        <li><a href="forum_categories.php">Forum Category</a></li>
        <li class="active"><a href="topiclist1.php">Forum Topics</a></li>
        <li><a href="forumposts.php">Forum Posts</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h4><small>Topic Created</small></h4>
      <hr>
       <h3>New Topic Added</h3>
       <?php echo $display_block; ?>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
