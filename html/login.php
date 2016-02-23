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
    <title>Login</title>
</head>
<body class="login">
    
    <div class="separator"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                
            <div class="shadow-wrap">
                <div class="top-div-title">
                    Login to our site!
                </div>
                <div class="login-body-wrap">
                    <form id="form" action="../sessions_controller.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me!
                            </label>
                        </div>
                        <div class="container-fluid" style="padding:0px;">
                          <div class="row">
                            <div class="col-md-9" style="margin-top:10px;">
                                <button type="submit" name="action" value="Login" class="btn btn-block btn-primary">Login</button>
                            </div>
                            <div class="col-md-3" style="margin-top:10px;">
                                <a href="registration.html" class="btn btn-block btn-default btn-gray"> Or Register</a>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>



            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!-- Script links -->
    <script src="../js/login.js"></script>
    <script src="../js/bootstrap.js"></script>
    
</body>
</html>