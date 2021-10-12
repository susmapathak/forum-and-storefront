
<?php
  include 'config.php';
  doDB();
  // database ko forum categories table bata data tannu paryoo
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>forum posts</title>
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
        <li><a href="forumposts.php">Forum Posts.</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h4><small>ADD NEW TOPIC</small></h4>
      <hr>
      <form method="post" action="create_topic.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Your Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="topic_owner" required="required">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Topic category</label>
          <select class="form-control" id="exampleFormControlSelect1" name="category_id" required="required">

          <?php
            $category_sql = "SELECT category_id, category_name
                        FROM forum_categories";


            $verify_category_res = mysqli_query($mysqli, $category_sql) or die(mysqli_error($mysqli));

            while ($posts_info = mysqli_fetch_array($verify_category_res)) {
              $category_id= $posts_info['category_id'];

              $category_name= $posts_info['category_name'];
          ?>
            <option value="<?php echo $category_id; ?>"><?php echo $category_name ;?></option>

            <?php }?>

          </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Topic Title</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="topic_title" required="required">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Post Text</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_text" required="required"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Topic</button>
        </form>

      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
