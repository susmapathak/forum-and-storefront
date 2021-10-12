<?php
    include 'config.php';
    doDB();
/*
     //check for required fields from the form
    if(!$_POST['category_name']) {
        header("Location: forum_categories.php");
        exit;
    }
    //create safe values for input into the database
    $clean_category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
    $clean_category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);

    //create and issue the first query
    $add_category_sql = "INSERT INTO forum_categories
            (category_id,category_name, category_create_time)
            VALUES('" . $clean_category_id . "', '" . $clean_category_name . "','" . now() . "') ";

    $add_category_res = mysqli_query($mysqli, $add_category_sql) or die(mysqli_error($mysqli));
    print_r($add_category_res);

*/


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
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
        <li class="active"><a href="forum_categories.php">Forum Category</a></li>
        <li><a href="topiclist1.php">Forum Topics</a></li>
        <li><a href="forumposts.php">Forum Posts</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h4><small>Topic Created</small></h4>
      <hr>

      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
