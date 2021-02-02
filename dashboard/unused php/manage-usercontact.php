
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
									<h1>Manage User Contact</h1>
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
											User Contact
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
						<div class="col-sm-12">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												User Contact Table
											</div>
										</div>
							          <div class="card-body table-responsive">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                   <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email Address</th>
                                                    <th>Date Submited</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                   <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email Address</th>
                                                    <th>Date Submitted</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewUserContact" data-whatever="@mdo">View</button>
                                                  </td>
                                                    <td>
                                                      <button type="submit" class="btn btn-success" name="" id="">Edit</button>
                                                  </td>
                                                  <td>
                                                      <button type="submit" class="btn btn-danger" name="">Delete</button>
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
					</div>
				</div>

<!-- modal starts -->
                                    <div class="modal fade" id="viewUserContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">View User Contact</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form>
														<div class="form-group">
															<label class="col-form-label">User First Name:</label>
															<input type="text" class="form-control" id="" name="" placeholder="User First Name" readonly>
														</div>
														<div class="form-group">
															<label class="col-form-label">User Email:</label>
															<input type="text" class="form-control" id="" name="" placeholder="First Name" readonly>
														</div>
														<div class="form-group">
															<label class="col-form-label">Message:</label>
															 <textarea class="form-control" name="" placeholder="Message" readonly></textarea>
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