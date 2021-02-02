
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
									<h1>Manage Contact</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="#">Contact</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Contact Details
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
						
						<!-- form statrts -->

						<div class="col-sm-12">
							<div class="row">
							<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info">
											<div class="card-title text-white">
												Manage Contact Details
											</div>
										</div>
								<div class="card-body">
									<form id="signupForm1" method="post" class=" right-text-label-form feedback-icon-form" action="#" novalidate="novalidate">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="servetitle">Title:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="servetitle" name="servetitle" placeholder="Service Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="servedesc">Contact Description:</label>
											<div class="col-sm-5">
												<textarea class="form-control" id="" name="servedesc" placeholder="Contact Description"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="servedesc">Address:</label>
											<div class="col-sm-5">
												<textarea class="form-control" id="" name="servedesc" placeholder="Contact Address Location"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="bannerbtn">Phone:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="" placeholder="Phone number">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="bannerbtn">Email:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="" placeholder="Email Address">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="servedesc">Service Hours:</label>
											<div class="col-sm-5">
												<textarea class="form-control" id="editor" name="" placeholder="Service hours"></textarea>
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">
												<button type="submit" class="btn btn-info" name="submit" value="submit">
													Submit
												</button>
												<button type="submit" class="btn btn-secondary" name="submit" value="submit">
													Clear
												</button>
											</div>
										</div>
									</form>
								</div>
									</div>
								</div>
								</div>
								</div>
								</div>
							</div>
							</main>
			<!--main contents end-->


<!-- include footer starts-->
<?php 
include('includes/footer.inc.php');
?>
<!-- include footer stops