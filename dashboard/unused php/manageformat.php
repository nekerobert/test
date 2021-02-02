<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php 
	require_once(INCLUDES_PATH.'/admin/header.inc.php');
	require_once(INCLUDES_PATH.'/admin/sidebar.inc.php');
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
									<h1>Manage Advert</h1>
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
											Advert
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
						<!-- table starts -->
						<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 col-xl-6">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Advert Image
											</div>
										</div>
								<div class="card-body">
									<div class="tab-content">
										<div class="tab-pane active" id="tab-j_1" role="tabpanel">
										<div class="card mb-4">
											<img class="card-img-top img-fluid" src="assets/images/product_img.jpg" alt="Card image cap">
											<div class="card-body">
												
												<a href="#" class="btn btn-success">Edit</a>
												<a href="#" class="btn btn-danger">Delete</a>
											</div>
										</div>
										</div>

									</div>
								</div>
									</div>
								</div>
							</div>
						</div>
						<!-- table ends -->

						<!-- form statrts -->





							<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 col-xl-6">
								<div class="row">
								<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Manage Advert Details
											</div>
										</div>
								<div class="card-body">
									<form id="signupForm1" method="post" class=" right-text-label-form feedback-icon-form" action="#" novalidate="novalidate">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Advert Title:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="" placeholder="Advert Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Advert Text:</label>
											<div class="col-sm-5" >
												 <textarea class="form-control" id="editor" name="" placeholder="Advert Text"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Advert Button Text:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="" placeholder="Advert Button Text">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Advert Button Link:</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="" placeholder="Advert Button Link">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">
												<div class="checkbox">
													<label>
														<input type="checkbox" id="agree" name="agree" value="agree"> Enable Advert Button </label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="username1">Advert Image:</label>
											<div class="col-sm-5">
												 <input type="file" multiple class="form-control" id="" name="" placeholder="Choose Advert image" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">
												<div class="checkbox">
													<label>
														<input type="checkbox" id="agree" name="agree" value="agree"> Enable/Disable Advert </label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-8 ml-auto offset-sm-2">
												<button type="submit" class="btn btn-info btn-block btn-lg" name="submit" value="submit">
													Submit
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
						</div>
						<!-- form ends -->
					</div>
					<!-- state end-->

				</div>
			</main>
			<!--main contents end-->


<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>
<!-- include footer stops