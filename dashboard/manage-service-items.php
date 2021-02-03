
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
									<h1>Manage Service Item</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="#">Service</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Service Items
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
												Service Items Table
											</div>
										</div>
							          <div class="card-body table-responsive">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Service Title</th>
                                                    <th>Service Image</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Service Title</th>
                                                    <th>Service Image</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><img src="../images/gallery/01.jpg" class="img-thumbnail" alt="member"></td>
                                                    <td></td>
                                                    <td>
                                                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewServiceItem" data-whatever="@mdo">View</button>
                                                  </td>
                                                  <td>
                                                      <button type="submit" class="btn btn-success" name="" id="">Edit</button>
                                                  </td>
                                                  <td>
                                                      <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
												Add Service Item
											</div>
										</div>
								<div class="card-body">
									<form id="signupForm1" method="post" class=" right-text-label-form feedback-icon-form" action="#" novalidate="novalidate">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Short Service Title</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="sectitle" placeholder="Short Service Item Title">
											</div>
										</div>
									<div class="form-group row">
											<label class="col-sm-4 control-label" for="">Full Service Title</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="" name="sectitle" placeholder="Full Service Item Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="secdesc">Service Description</label>
											<div class="col-sm-5">
												 <textarea class="form-control" id="editor" name="" placeholder=" Service Item Description"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="email1">Service Category</label>
											<div class="col-sm-5">
												<select class="form-control" id="">
											      <option>Select Option</option>
											      <option>Lab test</option>
											      <option>x ray</option>
											    </select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="username1">Service Image</label>
											<div class="col-sm-5">
												 <input type="file" multiple class="form-control" id="" name="" placeholder="Service Item Image" />
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">
												<button type="submit" class="btn btn-info" name="submit" value="submit">
													Submit
												</button>
												<button type="submit" class="btn btn-danger" name="delete" value="submit">
													Delete
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

<!-- modal starts -->
                          		<div class="modal fade" id="viewServiceItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">View Service Items</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form>
														<div class="form-group">
															<label for="recipient-name" class="col-form-label">Short Service Title:</label>
														<input type="text" class="form-control" id="" name="sectitle" placeholder="Short Service Item Title" readonly>
														</div>
														<div class="form-group">
															<label class="col-form-label">Full Service Title:</label>
														<input type="text" class="form-control" id="" name="sectitle" placeholder="Full Service Item Title" readonly>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="col-form-label">Service Description:</label>
															 <textarea class="form-control" name="" placeholder="Service Item Description" readonly></textarea>
														</div>
														<div class="form-group">
															<label class="col-form-label">Service Category:</label>
														<input type="text" class="form-control" id="" name="sectitle" placeholder="Service Category" readonly>
														</div>
														<div class="form-group">
															<label class="col-form-label">Service Image:</label>
														<img src="../images/gallery/01.jpg" class="img-thumbnail" alt="member" readonly>
														</div>
														<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
													</form>
												</div>
												
											</div>
										</div>
									</div>
        <!-- modal ends -->

<!-- include footer starts-->
<?php 
include('includes/footer.inc.php');
?>
<!-- include footer stops