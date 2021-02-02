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
									<h1>Manage Slider</h1>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSliderModal" data-whatever="@mdo">Add Slider</button>
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
											Manage Slider
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
						<div class="col-md-12">
							<div class="card card-shadow mb-4">
								<div class="card-body">
									<ul class="nav nav-tabs nav-fill mb-4" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#tab-j_1">
												<i class="fa fa-home pr-2"></i> Slider 1</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tab-j_2"> Slider 2</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tab-j_3"> Slider 3</a>
										</li>

									</ul>

									<div class="tab-content">
										<div class="tab-pane active" id="tab-j_1" role="tabpanel">
										<div class="card mb-4">
											<img class="card-img-top img-fluid" src="assets/images/product_img.jpg" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title">Slider Title</h5>
												<p class="card-text">
													Some quick example text to build on the card title and make up the bulk of the card's content.
												</p>
												<a href="#" class="btn btn-success">Edit</a>
												<a href="#" class="btn btn-danger">Delete</a>
											</div>
										</div>
										</div>
										<div class="tab-pane" id="tab-j_2" role="tabpanel">
											<div class="card mb-4">
											<img class="card-img-top img-fluid" src="assets/images/product_img.jpg" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title">Slider Title</h5>
												<p class="card-text">
													Some quick example text to build on the card title and make up the bulk of the card's content.
												</p>
												<a href="#" class="btn btn-success">Edit</a>
												<a href="#" class="btn btn-danger">Delete</a>
											</div>
										</div>
										</div>
										<div class="tab-pane" id="tab-j_3" role="tabpanel">
											<div class="card mb-4">
											<img class="card-img-top img-fluid" src="assets/images/product_img.jpg" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title">Slider Title</h5>
												<p class="card-text">
													Some quick example text to build on the card title and make up the bulk of the card's content.
												</p>
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
													<h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form>
														<div class="form-group">
															<label for="recipient-name" class="col-form-label">Title:</label>
															<input type="text" class="form-control" id="recipient-name" placeholder="Add a title">
														</div>
														<div class="form-group">
															<label for="recipient-name" class="col-form-label">Sub Title:</label>
															<input type="text" class="form-control" id="recipient-name" placeholder="Add a sub title">
														</div>
														<div class="form-group">
															<label for="message-text" class="col-form-label">Slider Image:</label>
															<input type="file" multiple class="form-control" id="slider_img" name="slider_img" placeholder="Choose Slider Image" />
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Add Slider</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
		<!-- modal ends -->
	<?php include('includes/footer.inc.php'); ?>