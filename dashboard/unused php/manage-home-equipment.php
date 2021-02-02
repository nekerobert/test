include headers starts-->
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
									<h1>Manage Home Equipment</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="index-2.html">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Home Equipment
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
						<div class="col-sm-6">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Home Equipment Image Table
											</div>
										</div>
							          <div class="card-body">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Equipt Image</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                     <th>S/N</th>
                                                    <th>Equipt Image</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                      <button type="submit" class="btn btn-info editbtn" name="editfaq" id="editId">Edit</button>

                                                      <button type="submit" class="btn btn-danger confirmDelete" name="delete">Delete</button>
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





						<div class="col-sm-6">
							<div class="row">
							<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Add Home Equipment
											</div>
										</div>
								<div class="card-body">
									<form id="signupForm1" method="post" class=" right-text-label-form feedback-icon-form" action="#" novalidate="novalidate">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="sectitle">Section Title</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="sectitle" name="sectitle" placeholder="Section Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="secdesc">Section Description</label>
											<div class="col-sm-5">
												 <textarea class="form-control" id="" name="secdesc" placeholder="Section Description"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="username1">Equipment Image</label>
											<div class="col-sm-5">
												 <input type="file" multiple class="form-control" id="equiptimg" name="equiptimg" placeholder="Choose Equipment image" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="email1">Max Image on Home</label>
											<div class="col-sm-5">
												<select class="form-control" id="">
											      <option>Select Option</option>
											      <option>1</option>
											      <option>2</option>
											      <option>3</option>
											      <option>4</option>
											    </select>
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
						</div>
						<!-- form ends -->
					</div>
					<!-- state end-->

				</div>
			</main>
			<!--main contents end-->


<!-- include footer starts-->
<?php 
include('includes/footer.inc.php');
?>
<!-- include footer stops