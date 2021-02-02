<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	   /* Set Main Page Routes*/
	   $route = "pages/services/sections/service-items";
	   /* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	if(isset($_GET['s_id'])){
		$id = h(u($_GET["s_id"]));
	}

	if(isset($_COOKIE["message"])){
		// Get Output Message from cookie
	// It is placed here to avoid headers sent out before output error
	// Information 
		$msgArray = cookie_message();
		$status = $msgArray["status"];
		$msg = $msgArray["message"];
			// Destroy cookie Message
		destroy_cookie_message();
	}

	if(is_post_request()){
		// confirm request's csrf identifier validity and duration
		confirm_request_source();
		// Sanitize to avoid xss attack
		$service = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'delete':
					// confirm if the id is actually mapped to a slider
					$msg = "Sorry request failed. Please try again";
					$service = find_data('page_datas',['page_datas.id','files.id as file_id'],'INNER JOIN files on page_datas.file_id = files.id ','WHERE page_datas.title="service-item" AND page_datas.id ='.merge_and_escape([$id], $db));
                    if(!$service){
                        // Slider Exists
                        cookie_message($msg,$status);
					    redirect_to(generate_route($route, "manage"));
                    }
                    delete_data('page_datas', [$id]);
                    $status = delete_data('files', [$service["file_id"]]);
					$msg = "Service Item deleted successfully";
					// Set cookie message here
					cookie_message($msg,$status);
					redirect_to(generate_route($route, "manage"));
					break;
				default:
				    cookie_message("Sorry error occured. Please try again",$status);
					redirect_to(generate_route($route, "manage"));
					break;
			}
		}

	}else{
		if(isset($_GET["mode"]) && isset($id)){
			switch ($_GET["mode"]) {
				case 'delete':
					$msg = "You have not delete any service item";
					cookie_message($msg);
					redirect_to(generate_route($route, "manage"));
				break;
			}
		}else{
			//display all pages if any
			$services = find_data('page_datas',['page_datas.id','content','path','page_datas.date_created'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE page_datas.title='service-item' ORDER BY id desc",false);
		}
		
	}

?>

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
									<h1 class="mb-3">Manage Services</h1>
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
											Manage services
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--page title end-->


				<div class="container-fluid">
                    <?php 
						echo display_status_message($status, $msg); //Display status success/failure message
					?>
					<!-- state start-->
					<div class="row">
						<!-- table starts -->
						<div class="col-sm-12">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info d-flex justify-content-between">
											<div class="card-title text-white">
												All Service Items
											</div>
											<div class="card-title text-white">
												<a class="btn btn-dark" href="<?php echo generate_route($route,"create");?>"><i class="fa fa-pencil"></i> Create New Service Item</a>
											</div>
										</div>
							          <div class="card-body table-responsive">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
													<th>S/N</th>
													<th>Short title</th>
                                                    <th>Full title</th>
                                                    <th>Category</th>
                                                    <th>Feature Image</th>
                                                    <th>Date Added</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
													<th>Short title</th>
                                                    <th>Full title</th>
                                                    <th>Category</th>
                                                    <th>Feature Image</th>
                                                    <th>Date Added</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </tfoot>
                                            <tbody>
											<?php 
												echo service_table_component($services); ?>
                                            </tbody>
                                        </table>
                                    </div>
									</div>
								</div>
							</div>
						</div>
						<!-- table ends -->
				</main>
			<!--main contents end-->

			<?php echo display_delete_modal('Service'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>