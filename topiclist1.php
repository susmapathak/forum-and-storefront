
<?php
  include 'config.php';
  doDB();

  $get_topics_sql = "SELECT topic_id, topic_title,
                      DATE_FORMAT(topic_create_time,'%b %e %Y at %r') AS
                      fmt_topic_create_time, topic_owner FROM forum_topics
                    ORDER BY topic_create_time DESC";

  $get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>forum topics</title>
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
      <h4><small>FORUM TOPICS</small></h4>
      <hr>
      <?php if(mysqli_num_rows($get_topics_res) < 1) : ?>
        <p><em>No topics exist.</em></p>
      <?php else: ?>

      <table class="table table-bordered table-sm">
            <thead>
              <tr>
                  <th>TOPIC TITLE</th>
                  <th>NUMBER OF POSTS</th>
              </tr>
            </thead>
            <tbody>

                <?php
                while ($topic_info = mysqli_fetch_array($get_topics_res)) {
                  $topic_id = $topic_info['topic_id'];
                  $topic_title = stripslashes($topic_info['topic_title']);
                  $topic_create_time = $topic_info['fmt_topic_create_time'];
                  $topic_owner = stripslashes($topic_info['topic_owner']);


                  $get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM
                  forum_posts WHERE topic_id = '" . $topic_id . "'";

                  $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

                  while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
                    $num_posts = $posts_info['post_count'];
                  }
                ?>
                <tr>
                  <td>
                    <a href="showtopic1.php?topic_id=<?php echo $topic_id ?>"><?php echo $topic_info['topic_title']; ?></a>
                    <p>Created on <?php echo $topic_info['fmt_topic_create_time']; ?> by <span><?php echo $topic_info['topic_owner']; ?> </span></p>
                  </td>
                  <td><?php echo $num_posts ; ?></td>

              </tr>
                <?php }?>
            </tbody>
        </table>
        <p>Would you like to <a href="addtopic.php">add a topic</a>?</p>

         <?php endif; ?>

    </div>

  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
