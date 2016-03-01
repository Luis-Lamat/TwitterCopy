<?php if (!$_COOKIE["loggedIn"]) { header("location: login.php"); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css"> 
    <script src="../js/jquery.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <title>Home</title>
</head>
<body>

    <!-- nav begin -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
          data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Lab Web</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="homepage.php">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="profile.php?user_id=<?php echo $_COOKIE['user_id']; ?>">Profile</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                </span>
            </div><!-- /input-group -->
          </form>
            <form action="../sessions_controller.php" method="post">
                <input id="logout-btn" class="navbar-text pull-right navbar-link" type="submit" name="action" value="Log Out">
            </form>
            <p class="navbar-text pull-right">Signed in as 
                <a href="profile.php?user_id=<?php echo $_COOKIE['user_id']; ?>" class="navbar-link"><?php echo $_COOKIE['username'];?></a>
            </p>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!-- nav end -->


    <div class="separator"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            

            <div class="shadow-wrap">
                <div class="top-div-title">Post Feed</div>
                <div class="postfeed-wrap">

                    <div class="post-form">
                        <form id="form">
                            <div class="form-group">
                                <textarea name="post" id="post-content" 
                                class="form-control" placeholder="What's happening?"></textarea>
                            </div>
                            <button type="submit" id="post-btn" class="btn btn-primary" disabled>Post</button>
                        </form>
                    </div>

                    <div class="new-posts">
                    <div class="empty post-card" hidden>
                        <img src="../assets/images/user.png" class="img-responsive post-usr-img" alt="">
                        <a href="" class="post-creator">
                        </a>
                        <div class="post-content">
                        </div>
                        <hr>
                        <div class="post-footer">
                        </div>
                    </div>
                    </div>
                    

                </div>
            </div>


            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="separator"></div>


    <!-- Script links -->
    <script src="../js/posts.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>
</html>