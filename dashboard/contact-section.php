<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	/* Set Main Page Routes*/
	$route = "pages/contact-us/sections/main-section";
	/* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route);
	$formTitle = "Add Contact-Us Section Content";
	$advert = '';
	if(isset($_GET['section_id'])){
		$id = h(u($_GET["section_id"]));
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
		$section = sanitize_html($_POST);

		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			$formTitle = "Edit contact us section";
			switch ($_GET["mode"]) {
				case 'edit':
					//Editing a new Contact us
					// Rearrange data values
					$formUrl = generate_route($route, "edit",$id);
					$editMode = true;
					// N/B: validation is done only on the title if the advert section is checked
					$valResult =  validate_data(regenerate_with_required($section,"section_title"), ['section_title'=>'title']);
					// This is because they are optional
					if(!$valResult){
						// No errors
						// Confirm if section already exist by retrieving the record based on the Id
						$data = find_data('page_datas',['id'],' WHERE page_datas.title = "contact-section-content" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1', false);
						if($data){
							// File Exist
							// Prepare data values to be Updated
							$data["content"] = array_to_json($section,'csrf_token');
							$data["date_updated"] = date('Y-m-d h:i:s');
							$status = update_data('page_datas',$data,'id');
							$msg = "Section updated successfully";
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
			$valResult = validate_data(regenerate_with_required($section,"section_title"));
			if(!$valResult){
				$data["content"] =  array_to_json($section,'csrf_token');
				$data["title"] = "contact-section-content";
				$data["date_created"] = date('Y-m-d h:i:s');
				$status = insert_data('page_datas',$data);
				$msg = "section created successfully";
				//To be used in the form again
				$formUrl = generate_route($route, 'edit', h(u(get_id($db))));
				$formTitle = "Edit contact us section";

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
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE page_datas.title='contact-section-content' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						$section = json_to_array($data["content"]);
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit contact us section";
						// var_dump($section); exit;
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
			$data = find_data('page_datas',['content','page_datas.id'], ' WHERE page_datas.title ="contact-section-content" LIMIT 1', false);
			if($data){
				$section = sanitize_html(json_to_array($data["content"]));
				$section["id"] = h(u($data["id"]));
				$formUrl = generate_route($route, "edit", $section["id"]);;
				$formTitle = "Edit contact us section";
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
						
					<?php 
						echo display_status_message($status, $msg); //Display status success/failure message
					?>
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<h1>Manage contact section</h1>
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
											Contact Section
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

						<!-- form statrts -->

						<div class="col-sm-12">
							<div class="row">
							<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
											Contact section
											</div>
										</div>
									<div class="card-body">
										<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>">
											<div class="form-group">
												<label class="control-label" for="section-title">Section Title</label>
												<input type="text" value="<?php echo $section["section_title"] ?? ""; ?>" class="form-control form-control-lg" id="section-title" name="section_title" placeholder="Section Title">
												<?php echo form_error_component($errors, 'section_title');?>
											</div>
											
											<div class="form-group">
												<label class="control-label" for="section-description">Section Description</label>
												<textarea id="section-description" class="form-control editor" name="section_desc" rows="8" cols="4"><?php echo $section["section_desc"] ?? ""; ?></textarea>
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


<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>

<!-- include footer starts-->
