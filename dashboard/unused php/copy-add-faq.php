<?php
// session_start(); 
require_once('includes/faq.inc.php');
?>

<!-- include headers starts-->
<?php 
include('includes/header.inc.php');
include('includes/sidebar.inc.php');
?>
<!-- include headers stops -->


			<!--main contents start-->
			<main class="content_wrapper">

				<?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?=$_SESSION['msg_type']?>">
                    <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    ?>
                </div>
                <?php endif ?>
				<!--page title start-->
				<div class="page-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<!-- php print update page when update button is clicked -->
									<?php if ($update == true): ?>
										<h1>Update FAQ</h1>
										<?php else: ?>
										<h1>Add FAQ</h1>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="dashboard.php">Dashboard</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<?php if ($update == true): ?>
										<li class="active">Update FAQ</li>
										<?php else: ?>
										<li class="active">Add FAQ</li>
									<?php endif; ?>
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
									<?php if ($update == true): ?>
									<div class="card-title">Update FAQ Form</div>
									<?php else: ?>
									<div class="card-title">Add FAQ Form</div>
								<?php endif; ?>
								</div>
								<div class="card-body">
									<form id="signupForm1" class=" right-text-label-form feedback-icon-form" method="POST" action="includes/faq.inc.php">

										<input type="hidden" name="id" value="<?php echo $id; ?>">
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="question" name="question">Question*</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="question" name="question" value="<?php echo $question; ?>" placeholder="Provide your Question" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label" for="answer" name="answer">Answer*</label>
											<div class="col-sm-5">
												<textarea class="form-control" id="answer" name="answer" placeholder="Provide your Answer"><?php echo $answer; ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-8 ml-auto">

												<?php if ($update == true): ?>
												<button type="submit" class="btn btn-info" name="update" value="update">Update FAQ</button>
												<a href="manage-faq.php" type="button" class="btn btn-secondary" name="update" value="Cancel">Cancel</a>
											    <?php else: ?>
												<button type="submit" class="btn btn-success" name="addFaq" value="addFaq">Add FAQ</button>
										    	<?php endif; ?>

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
		<!-- </div> -->
		<!-- Content_right_End -->
		<?php include('includes/footer.inc.php'); ?>
