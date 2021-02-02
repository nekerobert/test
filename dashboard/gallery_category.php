<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>


<?php
	/* Set Main Page Routes*/
    	$route = "pages/gallery/sections/gallery-category";
   /* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$formUrl = generate_route($route, "manage");
	$formTitle = "Create A New Category";
	if(isset($_GET['cat_id'])){
		$id = h(u($_GET["cat_id"]));
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
		$category = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					// validate Data
					$valResult = validate_data($category, ['cat_title'=>'title'], 'csrf_token');
					// Id to used for updating record
					if(!$valResult){
						// No Errors Continue with Updating
						$data = find_data('categories',['id'],null," WHERE type='gallery' AND id =".merge_and_escape([$id],$db));
						// Confirm if record exist
						if($data){
							$category["id"] = $id;
							$status = update_data('categories',$category,'id,csrf_token');
							$msg = "Category Updated Successfully";
							// Set cookie message
							cookie_message($msg,$status);
							redirect_to(generate_route($route, "manage"));
						}else{
							$msg = "Sorry request failed. Please Try again ";
							// Set cookie message
							cookie_message($status, false);
							redirect_to(generate_route($route, "manage"));
						}
						

					}else{
						// Errors Occured
						$errors = $valResult;
                        $categories = find_data('categories',['id','cat_title','type','date_created'], null, ' WHERE type="gallery" ');
					}
					
					break;

				case 'delete':
					// validate the existence of a record tied to the Id
					$data = find_data('categories',['id'],null," WHERE type='gallery' AND id =".merge_and_escape([$id],$db));
					if($data){
						$status = delete_data('categories', [$id]);
						$msg = "Category deleted successfully";
						// Set cookie message here
						cookie_message($msg,$status);
						redirect_to(generate_route($route,"manage"));
					}else{
						$msg = "Sorry request failed. Please Try again ";
						// Set cookie message
						cookie_message($status, false);
						redirect_to(generate_route($route, "manage"));
					}
					
					break;
				default:
				    $msg = "Sorry request failed. Please Try again ";
						// Set cookie message
						cookie_message($status, false);
						redirect_to(generate_route($route, "manage"));
					break;
			}
		}else{
			// Creating a new Page is handle here
			// validate Data
			$valResult = validate_data($category, ['cat_title'=>'title'], 'csrf_token');
			if(!$valResult){
				// No errors continue with insertion of data
                $category["type"] = "gallery";
                $status = insert_data('categories', $category, 'csrf_token');
				$msg = "Category created successfully";
				cookie_message($msg,true);
				redirect_to(generate_route($route, "manage"));
			}else{
				// There is errors
				$errors = $valResult;
				// Retrieve record to be displayed on the table again
				$categories = find_data('categories',['id','cat_title','type','date_created'], null, ' WHERE type="gallery" ');
			}

		}

	}else{
		//Get Request
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					$category = find_data_by_id('categories',['cat_title'],$id);
					if($category){
						$formUrl = generate_route($route, "edit",$id);
						$formTitle = "Edit Selected Category";
						// repopulate table again
						$categories = find_data('categories',['id','cat_title','type','date_created'], null, ' WHERE type="gallery" ');
					}else{
						cookie_message("Sorry request Failed. Try again", false);
						redirect_to(generate_route($route, "manage"));
					}
					
					# code...
					break;
			}
			
		}else{
			//display all pages if any
            $categories = find_data('categories',['id','cat_title','type','date_created'], null, ' WHERE type="gallery" ');
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
									<h1>Gallery Categories</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="<?php echo DASHBOARD_PATH .'index'; ?>">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											gallery categories
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--page title end-->

				<div class="container-fluid">
					<?php echo display_status_message($status, $msg); ?>
					<!-- state start-->
					<div class="row">
						<!-- table starts -->
						<div class="col-sm-12 col-md-12 col-lg-7 col-xs-12 col-xl-7">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Manage Gallery Categories (<i class="fa fa-book"></i>) 
											</div>
										</div>
							            <div class="card-body table-responsive">
                                        	<table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Category title</th>
													<th>Type</th>
													<th>Date Added</th>
													<th></th>
													<th></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Category Title</th>
													<th>Type</th>
													<th>Date Added</th>
													<th></th>
													<th></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                              	<?php echo category_table_component($categories, 'gallery'); ?>
                                            </tbody>
                                        </table>
                                    </div>
									</div>
								</div>
							</div>
						</div>
						<!-- table ends -->

						<!-- form statrts -->

						<div class="col-sm-12 col-md-12 col-lg-5 col-xs-12 col-xl-5">
							<div class="row">
							<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												<?php echo $formTitle; ?> (<i class="fa fa-book"></i>)
											</div>
										</div>
								<div class="card-body card-responsive">
									<form id= "form" action="<?php echo $formUrl; ?>" method="post">
										<div class="form-group mb-3">
											<label class="control-label" for="cat-title">Category Title</label>
											<input type="text" value="<?php echo $category["cat_title"] ?? ""; ?> " class="form-control" id="cat-title" name="cat_title" placeholder="Enter Category title">
											<?php 	// Display validation error if available  
												echo form_error_component($errors,'cat_title')
											?>
                                        </div>
										<?php echo csrf_token_tag(); ?>
										<div class="form-group text-center form-row">
											<div class="col-sm-8"><button type="submit" class="btn btn-block btn-info">Submit</button></div>
											<div class="col-sm-4"><input id="reset" type="reset" value="Reset" class="btn btn-block btn-danger"/></div>
										</div>
									</div>
								</div>
								</div>
								</div>
								</div>
							</div>
							</main>
			<!--main contents end-->
			
			<!-- Delete modal -->
			<?php echo display_delete_modal('Category'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>
<!-- include footer stops