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
    <script src="../js/jquery.js"></script>
    <title>Profile</title>
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
            <li><a href="homepage.php">Home <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="profile.php">Profile</a></li>
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
            <p class="navbar-text pull-right">Signed in as <a href="profile.php" class="navbar-link"><?php echo $_COOKIE["username"];?></a></p>

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
                <div class="top-div-title">
                    Profile
                </div>
                <div class="login-body-wrap">
                    <div class="post-card" style="border: 0px; padding-bottom:30px;">
                        <img src="https://tracker.moodle.org/secure/attachment/30912/f3.png" class="img-responsive post-usr-img" alt="">
                        <span class="post-creator">
                            Username: Luis Lamadrid
                        </span>
                    </div>
                </div>
            </div>
            <div class="bottom-div-actions">
                <a href="" class="btn btn-primary">Edit</a>
            </div>


            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="separator"></div>


    <!-- Script links -->

    <script src="../js/bootstrap.js"></script>
</body>
</html>