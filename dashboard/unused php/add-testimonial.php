
<!-- include headers starts-->
<?php 
include('includes/header.inc.php');
include('includes/sidebar.inc.php');
?>
<!-- include headers stops -->
			<!--main contents start-->
			<main class="content_wrapper">
				<!--page title start-->
				<div class="page-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<h1>Add Testimonial</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="#">Dashboard</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Add Testimonial
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--page title end-->
				<div class="container-fluid">
					<!-- state start-->
					<div class="row">
						<div class=" col-md-12">
							<div class="card card-shadow mb-4">
								<div class="card-header">
									<div class="card-title">
										Add Testimonial Form
									</div>
								</div>
								<div class="card-body">
									<form id="signupForm1" method="post" class=" right-text-label-form feedback-icon-form" action="#">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="firstname1">First name</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="firstname1" name="firstname1" placeholder="First name" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="lastname1">Last name</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="lastname1" name="lastname1" placeholder="Last name" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="testTitle">Title</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="testTitle" name="testTitle" placeholder="Title of testifier" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="message">Message*</label>
											<div class="col-sm-5">
												<textarea class="form-control" id="message" name="message" placeholder="Message"></textarea> 
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="image">Image</label>
											<div class="col-sm-5">
												<input type="file" class="form-control" id="image" name="image" placeholder="Image Upload" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">
												<button type="submit" class="btn btn-info" name="addTestimonial" value="Add Testimonial">
													Add Testimonial
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- state end-->
				</div>
			</main>
			<!--main contents end-->
		</div>
		<!-- Content_right_End -->
		<?php include('includes/footer.inc.php'); ?>