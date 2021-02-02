<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>

<?php

    $errors = []; $status = false; $msg = "";
    if(isset($_COOKIE["message"])){
		// Get Output Message from cookie
	// It is placed here to avoid headers sent out before output error
	// Information 
		$msgArray = cookie_message();
		$status = $msgArray["status"];
		$msg = $msgArray["message"];
			// Destroy cookie Message
		destroy_cookie_message();
    }
    
    if(is_post_request()){
        
        confirm_request_source();
        
        $user = sanitize_html($_POST);

        $valResult = validate_data(regenerate_with_required($user, 'username,password'), ['username'=>'name', 'password'=>'LoginPassword']);
        if(!$valResult){
            $msg = "Login was unsuccesfull!!!";
            $admin = find_data('users', ['username','firstname','surname','password','path','users.date_created','role','status'],' INNER JOIN files on files.id = users.file_id',' WHERE username = '.merge_and_escape([$user["username"]], $db).' LIMIT 1');
            if($admin){
                if(password_verify($user['password'], $admin["password"])){
                    if($admin["status"] == 1){
                        // Account is approved. Continue with login
                        login_user($admin);
                        redirect_to(DASHBOARD_PATH."index");
                    }
                    $msg = "Sorry You cannot have access to the system right now. Your account is not yet approved";

                }
            }

        }else{
            $errors = $valResult;
        }

    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119595512-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119595512-1');
</script>

	</head>

<body class="bg_darck">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="logo">
                    <a href="#">
                        <strong class="logo_icon">
                            <img alt="" src="assets/images/small-logo.png" alt="">
                        </strong>
                        <span class="logo-default">
                            <img alt="" src="assets/images/logo.png" alt="">
                        </span>
                    </a>
                </div>
                <div class="login-form">
                <?php echo display_status_message($status, $msg); //Display status success/failure message?>

                    <form method="post" action="<?php echo DASHBOARD_PATH.'login'?>">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $user['username'] ?? ""?>" class="form-control" placeholder="Username">
                            <?php echo form_error_component($errors, 'username');?>
                        </div>
                        <?php echo csrf_token_tag(); ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <?php echo form_error_component($errors, 'password');?>
                        </div>
                        <!-- <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>
                        </div> -->
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ?
                                <a href="<?php echo DASHBOARD_PATH.'register'?>"> Sign Up Here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
</body>
</html>