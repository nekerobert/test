<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>
<?php
	/* Set Main Page Routes*/
	$route = "pages/home/sections/footer-banner";
	/* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route);
	$formTitle = "Add Footer Banner Content";
	$advert = '';
	if(isset($_GET['banner_id'])){
		$id = h(u($_GET["banner_id"]));
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
		// confirm_request_source();
		// Sanitize to avoid xss attack
		$banner = sanitize_html($_POST);

		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			$formTitle = "Edit Homepage footer banner";
			switch ($_GET["mode"]) {
				case 'edit':
					//Editing a new Advert
					// Rearrange data values
					$formUrl = generate_route($route, "edit",$id);
					$editMode = true;
					// N/B: validation is done only on the title if the advert section is checked
					$valResult =  validate_data(regenerate_with_required($banner,"banner_title"), ['banner_title'=>'title']);
					// This is because they are optional
					if(!$valResult){
						// No errors
						// Confirm if banner already exist by retrieving the record based on the Id
						$data = find_data('page_datas',['id'],' WHERE page_datas.title = "home-footer-banner" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1', false);
						if($data){
							// File Exist
							// Prepare data values to be Updated
							$data["content"] = array_to_json($banner,'csrf_token');
							$data["date_updated"] = date('Y-m-d h:i:s');
							$status = update_data('page_datas',$data,'id');
							$msg = "Homepage footer banner updated successfully";
						}else{
							// Record Id was tempered with
							$msg = "Sorry request was not successful. Please try again";
							$status = false;
							cookie_message($msg, $status);
							redirect_to(generate_route($route));
						}
						
					}else{
						// Error occured
						$errors = $valResult;
					}
					break;
				default:
					// Mode has no specified case under the request type
					redirect_to(generate_route($route));
			}
		}else{
			// validate Data
			// N/B: validation is done only on the advert title if the advert section is selected
			$valResult = validate_data(regenerate_with_required($banner,"banner_title"));
			if(!$valResult){
				$data["content"] =  array_to_json($banner,'csrf_token');
				$data["title"] = "home-footer-banner";
				$data["date_created"] = date('Y-m-d h:i:s');
				$status = insert_data('page_datas',$data);
				$msg = "Banner created successfully";
				//To be used in the form again
				$formUrl = generate_route($route, 'edit', h(u(get_id($db))));
				$formTitle = "Edit Homepage footer banner";

			}else{
				// Validation errors are available here
					// There is errors and request source is valid
				$errors = $valResult;
			}

		}

	}else{
		//Get Request
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					//Fetch Record base on the specified Identifier
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE page_datas.title='home-footer-banner' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						$banner = json_to_array($data["content"]);
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit Homepage Footer Banner";
						// var_dump($banner); exit;
					}else{
						//User tempered with the query string parameter
						$msg = "Sorry request failed. Try again";
						$status = false;
						cookie_message($status, $msg);
						redirect_to(generate_route($route));
					}
					# code...
					break;
				
				default:
					// Mode has no specified case under the request type
					redirect_to(generate_route($route));
			}
			
		}else{
			// Default Get Request to the page
			$data = find_data('page_datas',['content','page_datas.id'], ' WHERE page_datas.title ="home-footer-banner" LIMIT 1', false);
			if($data){
				$banner = sanitize_html(json_to_array($data["content"]));
				$banner["id"] = h(u($data["id"]));
				$formUrl = generate_route($route, "edit", $banner["id"]);;
				$formTitle = "Edit Homepage footer banner";
			}

		
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
									<h1>Manage Home Footer Banner</h1>
								</div>
							</div>
							<div class="col-md-6 justify-content-md-end d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="<?php echo DASHBOARD_PATH.'index'?>">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Home Footer Banner
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

						<!-- form statrts -->

						<div class="col-sm-12">
							<div class="row">
							<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Home Footer Banner
											</div>
										</div>
								<div class="card-body">
									<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>">
											<div class="form-group">
												<label class="control-label" for="banner-title">Banner Title</label>
												<input type="text" value="<?php echo $banner["banner_title"] ?? ""; ?>" class="form-control form-control-lg" id="banner-title" name="banner_title" placeholder="Banner Main Title">
												<?php echo form_error_component($errors, 'banner_title');?>
											</div>
											<div class="form-group">
												<label class="control-label" for="button-text">Banner Button Text</label>
												<input type="text" value="<?php echo $banner["btn_text"] ?? ""; ?>" class="form-control form-control-lg" id="button-text" name="btn_text" placeholder="Banner Button Text">
											</div>
											<div class="form-group">
												<label class="control-label" for="button-link">Banner Button Link</label>
												<input type="text" value="<?php echo $banner["btn_link"] ?? ""; ?>" class="form-control form-control-lg" id="button-link" name="btn_link" placeholder="Banner Button Link">
											</div>
											<?php echo csrf_token_tag(); ?>
											<div class="form-group text-center form-row">
												<div class="col-sm-4 mb-sm-2"><button type="submit" class="btn btn-block p-3 btn-info">Submit</button></div>
												<div class="col-sm-4"><input id="reset" type="reset" value="Reset" class="btn p-3 btn-block btn-danger"/></div>
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

		<!-- Delete modal -->
<?php //echo display_delete_modal('Page'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>
<!-- include footer stops