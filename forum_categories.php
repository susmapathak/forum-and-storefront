<?php
    include 'config.php';
    doDB();

    // database categories bata data tannu paryo
    $forum_category_sql = "SELECT category_id, category_name,
                      DATE_FORMAT(category_create_time,'%b %e %Y at %r') AS fmt_category_create_time
                      FROM forum_categories
                      ORDER BY category_create_time DESC";

    // data tanera euta $ ma rakhnu paryo
   $forum_category_results = mysqli_query($mysqli, $forum_category_sql) or die(mysqli_error($mysqli));

    //  ani query lai run garunu paryo
    // tyo aako data lai loop garayera table ma dekhunu paryoo



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>forum categories</title>
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
      <h4><small>FORUM CATEGORIES</small></h4>
      <hr>
      <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">CATEGORY ID</th>
                <th scope="col">CATEGORY NAME</th>
                <th scope="col">CATEGORY CREATE TIME</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($topic_info = mysqli_fetch_array($forum_category_results)) {
                $category_id = $topic_info['category_id'];
                $category_name = stripslashes($topic_info['category_name']);
                $category_create_time = $topic_info['fmt_category_create_time'];
            ?>
                <tr>
                    <td><?php echo $category_id; ?></td>
                    <td><?php echo $category_name; ?></td>
                    <td><?php echo $category_create_time; ?></td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
        <p>Would you like to <a href="add_category.php">add a Category</a>?</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
