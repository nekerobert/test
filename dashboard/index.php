<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<!-- include headers starts-->

<?php //confirm_user_login(); ?>

<?php 
 require_once(INCLUDES_PATH.'/admin/header.inc.php');
 require_once(INCLUDES_PATH.'/admin/sidebar.inc.php');
?>
<!-- include headers stops -->

			<div class="content_wrapper">
				<div class="container-fluid">
					<!-- breadcrumb -->
					<div class="page-heading">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<h1>Dashboard</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="#">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Dashboard
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb_End -->

					<!-- Section -->
					<section class="chart_section">

						<div class="row">
							<div class="col-xl-3 col-md-6">
								<div class="info_items bg_green d-flex align-items-center">
									<span class="info_items_icon">
										<i class="ion-android-people"></i>
									</span>
									<div class="info_item_content">
										<span class="info_items_text">New users</span>
										<span class="info_items_number">450</span>
										<div class="progress">
											<div class="progress-bar" style="width: 45%"></div>
										</div>
										<span class="progress-description"> 45% Increase in 28 Days </span>
									</div>
								</div>
							</div>
							<!-- /info-box-content -->
							<div class="col-xl-3 col-md-6">
								<div class="info_items bg_yellow d-flex align-items-center">
									<span class="info_items_icon">
										<i class="ion-ios-person"></i>
									</span>
									<div class="info_item_content">
										<span class="info_items_text">Avg Time</span>
										<span class="info_items_number">155</span>
										<div class="progress">
											<div class="progress-bar" style="width: 40%"></div>
										</div>
										<span class="progress-description"> 40% Increase in 28 Days </span>
									</div>
								</div>
							</div>
							<!-- /info-box-content -->
							<div class="col-xl-3 col-md-6">
								<div class="info_items bg_blue d-flex align-items-center">
									<span class="info_items_icon">
										<i class="ion-ios-book"></i>
									</span>
									<div class="info_item_content">
										<span class="info_items_text">Total Prodcut</span>
										<span class="info_items_number">52</span>
										<div class="progress">
											<div class="progress-bar" style="width: 85%"></div>
										</div>
										<span class="progress-description"> 85% Increase in 28 Days </span>
									</div>
								</div>
							</div>
							<!-- /info-box-content -->
							<div class="col-xl-3 col-md-6">
								<div class="bg_pink info_items d-flex align-items-center">
									<span class="info_items_icon">
										<i class="ion-social-usd"></i>
									</span>
									<div class="info_item_content">
										<span class="info_items_text">Sales</span>
										<span class="info_items_number">13,921</span>
										<span>$</span>
										<div class="progress">
											<div class="progress-bar" style="width: 50%"></div>
										</div>
										<span class="progress-description"> 50% Increase in 28 Days </span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</div>
						</div>

						<!-- <div class="row">
							<div class="col-lg-12 d-flex align-items-stretch">
								<div class="stats-wrap full_chart card mb-4">
									<div class="chart_header">
										<div class="chart_headibg">
											<h3>Referrals</h3>
										</div>

									</div>
									<div class="card_chart">
										<ul class="list-unstyled list-referrals">
											<li class="mb-4">
												<p><span class="value">2301</span><span class="text-muted float-right">visits from Facebook</span></p>
												<div class="progress">
													<div class="progress-bar bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25"
													 aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</li>

											<li class="mb-4">
												<p><span class="value">1357</span><span class="text-muted float-right">visits from Twitter</span></p>
												<div class="progress">
													<div class="progress-bar badge-info" role="progressbar" style="width: 25%;" aria-valuenow="25"
													 aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</li>

											<li class="mb-4">
												<p><span class="value">2765</span><span class="text-muted float-right">visits from Search</span></p>
												<div class="progress">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 25%;" aria-valuenow="25"
													 aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</li>

											<li class="mb-4">
												<p><span class="value">3121</span><span class="text-muted float-right">visits from Linkedin</span></p>
												<div class="progress">
													<div class="progress-bar badge-danger" role="progressbar" style="width: 25%;" aria-valuenow="25"
													 aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->


						<div class="row">
							<div class="col-md-6">
								<div class="card card-inverse card-danger mb-4">
									<div class="card-body pb-0">
										<div class="btn-group float-right">
											<div class="dropdown ">
												<a href="#" class="btn btn-transparent text-light dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true"
												 aria-expanded="false">
													<i class=" icon-options"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right ">
													<a class="dropdown-item" href="#">
														<i class="icon-note text-info pr-2"></i> Edit</a>
													<a class="dropdown-item" href="#">
														<i class="icon-close text-danger pr-2"></i> Delete</a>
													<a class="dropdown-item" href="#">
														<i class="icon-shield text-warning pr-2"></i> Cancel</a>
												</div>
											</div>
										</div>
										<h4 class="mb-0 text-light">9876</h4>
										<p class="text-light"> Total Profit</p>
									</div>
									<div class="px-">
										<canvas id="myChart2-alt" height="100"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-inverse card-success mb-4">
									<div class="card-body pb-0">
										<div class="btn-group float-right">
											<div class="dropdown ">
												<a href="#" class="btn btn-transparent text-light dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true"
												 aria-expanded="false">
													<i class=" icon-options"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right ">
													<a class="dropdown-item" href="#">
														<i class="icon-note text-info pr-2"></i> Edit</a>
													<a class="dropdown-item" href="#">
														<i class="icon-close text-danger pr-2"></i> Delete</a>
													<a class="dropdown-item" href="#">
														<i class="icon-shield text-warning pr-2"></i> Cancel</a>
												</div>
											</div>
										</div>
										<h4 class="mb-0 text-light">234</h4>
										<p class="text-light">New Orders</p>
									</div>
									<div class="px-">
										<canvas id="myChart2" height="100"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-inverse card-warning mb-4">
									<div class="card-body pb-0">
										<div class="btn-group float-right">
											<div class="dropdown ">
												<a href="#" class="btn btn-transparent text-light dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true"
												 aria-expanded="false">
													<i class=" icon-options"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right ">
													<a class="dropdown-item" href="#">
														<i class="icon-note text-info pr-2"></i> Edit</a>
													<a class="dropdown-item" href="#">
														<i class="icon-close text-danger pr-2"></i> Delete</a>
													<a class="dropdown-item" href="#">
														<i class="icon-shield text-warning pr-2"></i> Cancel</a>
												</div>
											</div>
										</div>
										<h4 class="mb-0 text-light">12083</h4>
										<p class="text-light">Yearly Revineue</p>
									</div>
									<div class="px-4">
										<canvas id="myChart3" height="100"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-inverse card-primary mb-4">
									<div class="card-body pb-0 ">
										<div class="btn-group float-right">
											<div class="dropdown ">
												<a href="#" class="btn btn-transparent text-light dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true"
												 aria-expanded="false">
													<i class=" icon-options"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right ">
													<a class="dropdown-item" href="#">
														<i class="icon-note text-info pr-2"></i> Edit</a>
													<a class="dropdown-item" href="#">
														<i class="icon-close text-danger pr-2"></i> Delete</a>
													<a class="dropdown-item" href="#">
														<i class="icon-shield text-warning pr-2"></i> Cancel</a>
												</div>
											</div>
										</div>
										<h4 class="mb-0 text-light">12083</h4>
										<p class="text-light">New Users</p>
									</div>
									<div class="">
										<canvas id="myChart" height="100"></canvas>
									</div>
								</div>
							</div>
						</div>
						<!--graph widget end-->

					</section>
					<!-- Section_End -->

				</div>
			</div>
		</div>
		<!-- Content_right_End -->
		

		<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>