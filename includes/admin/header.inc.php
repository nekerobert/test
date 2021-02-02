<!DOCTYPE html>
<html lang="en">
<?php require_once(INCLUDES_PATH.'/admin/head.inc.php'); ?>
<!-- <body style="overflow: hidden;"> -->
<body>
	<div class="wrapper">
		<!-- header -->
		<header class="main-header">
			<div class="container_header">
				<div class="logo d-flex align-items-center">
					<a href="#"> <strong class="logo_icon"> <img src="<?php echo ADMIN_ASSET_PATH.'/images/small-logo.png'?>" alt=""> </strong> <span class="logo-default">
							<img src="<?php echo ADMIN_ASSET_PATH.'/images/logo2.png'?>" alt=""> </span> </a>
					<div class="icon_menu full_menu">
						<a href="#" class="menu-toggler sidebar-toggler"></a>
					</div>
				</div>
				<div class="right_detail">
					<div class="row d-flex align-items-center min-h pos-md-r">
						<div class="col-xl-5 col-3 search_col ">
							<div class="top_function">

								<div class="search">
									<a id="toggle_res_search" data-toggle="collapse" data-target="#search_form" class="res-only-view collapsed"
									 href="javascript:void(0);" aria-expanded="false"> <i class=" icon-magnifier"></i> </a>
									<form id="search_form" role="search" class="search-form collapse" action="#">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search...">
											<button type="button" class="btn" data-target="#search_form" data-toggle="collapse" aria-label="Close">
												<i class="ion-android-search"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-xl-7 col-9 d-flex justify-content-end">
							<div class="right_bar_top d-flex align-items-center">

								<!-- notification_Start -->
								<div class="dropdown dropdown-notification">
									<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"
									 aria-expanded="false"> <i class="fa fa-bell-o"></i> <span class="badge_coun"> 6 </span> </a>
									<ul class="dropdown-menu scroll_auto height_fixed">
										<li class="bigger">
											<h3><span class="bold">Notifications</span></h3>
											<span class="notification-label">New 6</span>
										</li>
										<li>
											<ul class="dropdown-menu-list">
												<li>
													<a href="javascript:;"> <span class="time">just now</span> <span class="details"> <span class="notification-icon deepPink-bgcolor">
																<i class="fa fa-check"></i> </span> Congratulations!. </span> </a>
												</li>
												<li>
													<a href="javascript:;"> <span class="time">3 mins</span> <span class="details"> <span class="notification-icon purple-bgcolor">
																<i class="fa fa-user o"></i> </span> <b>John Micle </b>is now following you. </span> </a>
												</li>
												<li>
													<a href="javascript:;"> <span class="time">7 mins</span> <span class="details"> <span class="notification-icon blue-bgcolor">
																<i class="fa fa-comments-o"></i> </span> <b>Sneha Jogi </b>sent you a message. </span> </a>
												</li>
												<li>
													<a href="javascript:;"> <span class="time">12 mins</span> <span class="details"> <span class="notification-icon pink">
																<i class="fa fa-heart"></i> </span> <b>Ravi Patel </b>like your photo. </span> </a>
												</li>
												<li>
													<a href="javascript:;"> <span class="time">15 mins</span> <span class="details"> <span class="notification-icon yellow">
																<i class="fa fa-warning"></i> </span> Warning! </span> </a>
												</li>
												<li>
													<a href="javascript:;"> <span class="time">10 hrs</span> <span class="details"> <span class="notification-icon red">
																<i class="fa fa-times"></i> </span> Application error. </span> </a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
								<!-- notification_End -->
								<!-- DropDown_Inbox -->
								<div class="dropdown dropdown-inbox">
									<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										<i class="fa fa-envelope-o"></i> <span class="badge_coun"> 2 </span> </a>
									<ul class="dropdown-menu scroll_auto height_fixed">
										<li class="bigger">
											<h3><span class="bold">Messages</span></h3>
											<span class="notification-label">New 2</span>
										</li>
										<li>
											<ul class="dropdown-menu-list">
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
												<li>
													<a href="#"> <span class="photo"> <img src="assets/images/about-1.jpg" class="img-circle" alt=""> </span>
														<span class="subject"> <span class="from"> Sarah Smith </span> <span class="time">Just Now </span> </span>
														<span class="message"> Jatin I found you on LinkedIn... </span> </a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
								<!--DropDown_Inbox_End -->
								<!-- Dropdown_User -->
								<div class="dropdown dropdown-user">
									<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"
									 aria-expanded="true"> <img class="img-circle pro_pic" src="<?php echo full_upload_url($_SESSION["dp"]);?>" alt=""> </a>
									<ul class="dropdown-menu dropdown-menu-default">
										<li>
											<a href="#"> <i class="icon-user"></i> Profile </a>
										</li>
										<li>
											<a href="#"> <i class="icon-settings"></i> Settings </a>
										</li>
										<li>
											<a href="#"> <i class="icon-directions"></i> Help </a>
										</li>
										<li class="divider"></li>
										<li>
											<a href="https://theembazaar.com/?password-protected=login&amp;redirect_to=https%3A%2F%2Ftheembazaar.com%2Fdemo%2Fthemesfolios%2Fintellir%2Fv1%2Flight%2Flock_screen.html"> <i class="icon-lock"></i> Lock </a>
										</li>
										<li>
											<a href="<?php echo DASHBOARD_PATH.'logout'?>"> <i class="icon-logout"></i> Log Out </a>
										</li>
									</ul>
								</div>
								<!-- Dropdown_User_End -->
							</div>
						</div>
					</div>
				</div>
			</div>

		</header>
		<!-- header_End -->