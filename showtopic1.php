
<?php
  include 'config.php';
  doDB();

  if (!isset($_GET['topic_id'])) {
    header("Location: topiclist1.php");
    exit;
  }

  $safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['topic_id']);

  $verify_topic_sql = "SELECT topic_title FROM forum_topics
    WHERE topic_id = '" . $safe_topic_id . "'";

$verify_topic_res = mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>show post</title>
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
      <h4><small>FORUM POST</small></h4>
      <hr>
      <?php
      while($topic_info = mysqli_fetch_array($verify_topic_res)) {
        $topic_title = stripslashes($topic_info['topic_title']);
      }
      ?>
      <p>Showing posts for the <strong><?php echo $topic_title?></strong> topic:</p>
      <?php if (mysqli_num_rows($verify_topic_res) < 1) : ?>
      <p><em> You have selected an invalid topic . <br/>Please <a href ='topiclist.php'> try again </a> . </em> </p>
      <?php else : ?>

      <table class="table table-bordered">
        <thead>
          <tr>

            <th scope="col">AUTHOR</th>
            <th scope="col">POST</th>

          </tr>
        </thead>
        <tbody>
</body>
</html>
          <?php
            $get_posts_sql = "SELECT post_id, post_text,
            DATE_FORMAT(post_create_time,'%b %e %Y <br/> %r')
            AS fmt_post_create_time, post_owner
            FROM forum_posts
            WHERE topic_id = '" . $safe_topic_id . "'
            ORDER BY post_create_time ASC";

            $get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));


            while ($posts_info = mysqli_fetch_array($get_posts_res)) {
              $post_id = $posts_info['post_id'];
              $post_text = nl2br(stripslashes($posts_info['post_text']));
              $post_create_time = $posts_info['fmt_post_create_time'];
              $post_owner = stripslashes($posts_info['post_owner']);


          ?>

          <tr>
            <td>
              <p><?php echo $post_owner ; ?></p>
              <p>Created on <?php echo $post_create_time ; ?></p>
            </td>
            <td>
              <p><?php echo $post_text; ?></p>
              <br>
              <a href="replytopost1.php?post_id=<?php echo$post_id?>">Reply To Post</a>
            </td>
          </tr>
          <?php } ?>

        </tbody>
      </table>
      <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>
<?php
  mysqli_free_result($get_posts_res);
  mysqli_free_result($verify_topic_res);

  mysqli_close($mysqli);
?>


