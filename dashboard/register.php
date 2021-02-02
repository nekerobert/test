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

        $valResult = validate_data(regenerate_with_required($user, 'username,password,email,firstname,surname'), ['username'=>'name', 'password'=>'password', 'email'=>'email','firstname'=>'name','surname'=>'name'] );
        if(!$valResult){
            $file = $_FILES["file"];
            $result = upload_file($file);
            if($result["mode"]){
                // No errors
                insert_data('files',$result,'mode');
                $user["file_id"] = get_id($db);
                // Prepare slider values to be ins
                $user["password"] = password_hash($user["password"], PASSWORD_BCRYPT);
                $status = insert_data('users',$user,'confirm_password,csrf_token');
				$msg = "Registration successful. Login Now";
				cookie_message($msg, $status);
				redirect_to(DASHBOARD_PATH.'login');
            }else{
                $errors = $result;
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
    <title>Cleveland Hospital || Register</title>
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
			<?php echo display_multiple_errors($errors); ?>
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
    
                <form method="post" action="<?php echo DASHBOARD_PATH.'register'?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" value="<?php $user['firstname'] ?? ""?>" class="form-control" placeholder="First Name">
                            <?php echo form_error_component($errors, 'firstname');?>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php $user['surname'] ?? ""?>" placeholder="Surname">
                            <?php echo form_error_component($errors, 'surname');?>
                        </div>

                        <div class="form-group">
                            <label>UserName</label>
                            <input type="text" value="<?php $user['username'] ?? ""?>" name="username" class="form-control" placeholder="User Name">
                            <?php echo form_error_component($errors, 'username');?>

                        </div>

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" value="<?php $user['name'] ?? ""?>" name="email" class="form-control" placeholder="Email">
                            <?php echo form_error_component($errors, 'email');?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="<?php $_POST['password'] ?? ""?>" name="password" class="form-control" placeholder="Password">
                            <?php echo form_error_component($errors, 'password');?>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" value="<?php $user['confirm_password'] ?? ""?>" name="confirm_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" name="file" class="form-control-file" >
                        </div>
                        <?php echo csrf_token_tag(); ?>
                        <button type="submit" class="btn btn-info btn-flat m-b-30 m-t-30">Register</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ?
                                <a href="<?php echo DASHBOARD_PATH.'login'?>"> Sign in</a>
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