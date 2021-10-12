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
      <h4>Forum Posts</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="index.php">Home</a></li>
         <li><a href="forum_categories.php">Forum Category</a></li>
        <li><a href="topiclist1.php">Forum Topics</a></li>
      </ul>
      <hr>
      <h4>StoreFront</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="">Store Categories</a></li>
         <li><a href="">View Cart</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h4><small>APPLICATIONS</small></h4>
      <hr>
      <div class="row">
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <div class="caption">
              <h3>Forum App</h3>
              <p>This is a forum app where you can create forums</p>
              <p><a href="topiclist1.php" class="btn btn-primary" role="button">Visit App</a></p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <div class="caption">
              <h3>StoreFront App</h3>
              <p>This is a storefont app where you can purchase items</p>
              <p><a href="" class="btn btn-primary" role="button">Visit App</a></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
