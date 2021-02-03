<?php
include('includes/header.inc.php');
include('includes/sidebar.inc.php');
?>
			<!--main contents start-->
			<main class="content_wrapper">
				<!--page title start-->
				<div class="page-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<h1>Manage Topnotch Equipment</h1>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSliderModal" data-whatever="@mdo">Add Equipment</button>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-users"></i>
											<a class="parent-item" href="index-2.html">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Topnotch Equipment
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
						<!-- first card starts -->
						<div class="col-md-4">
							<div class="card card-shadow mb-4">
								<div class="card-body">
									<div class="tab-content">
										<div class="tab-pane active">
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
				<!-- first card ends -->

				<!-- second card starts -->
						<div class="col-md-4">
							<div class="card card-shadow mb-4">
								<div class="card-body">
									<div class="tab-content">
										<div class="tab-pane active">
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
				<!-- second card end -->
					</div>


					<!-- state end-->

				</div>
			</main>
			<!--main contents end-->

		</div>
		<!-- Content_right_End -->


		<!-- modal starts -->
						<div class="col-xl-4  col-lg-6">
							<div class="card card-shadow mb-4">
								<div class="card-body">

									<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Add Equipment</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
										<form >
										<div class="form-group">
											<label for="message-text" class="col-form-label">Topnotch Equipment:</label>
											<input type="file" multiple class="form-control" id="team_img" name="team_img" placeholder="Choose Slider Image" />
										</div>
										<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Add Equipment</button>
												</div>
													</form>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
		<!-- modal ends -->
	<?php include('includes/footer.inc.php'); ?>