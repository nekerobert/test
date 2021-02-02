<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	/* Set Main Page Routes*/
	$route = "pages/contact-us/sections/contact-details";
	/* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route);
	$formTitle = "Add Contact-Us Details";
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
			$formTitle = "Edit contact us details";
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
						$data = find_data('page_datas',['id'],' WHERE page_datas.title = "contact-details" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1', false);
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
                $data["title"] = "contact-details";
                
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
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE page_datas.title='contact-details' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						$section = json_to_array($data["content"]);
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit contact us details";
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
			$data = find_data('page_datas',['content','page_datas.id'], ' WHERE page_datas.title ="contact-details" LIMIT 1', false);
			if($data){
				$section = sanitize_html(json_to_array($data["content"]));
				$section["id"] = h(u($data["id"]));
				$formUrl = generate_route($route, "edit", $section["id"]);;
				$formTitle = "Edit contact us details";
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
											Contact Details
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
												<label class="control-label" for="section-description">Contact Description</label>
												<textarea id="section-desc" class="form-control" name="section_desc" rows="8" cols="4"><?php echo $section["section_desc"] ?? ""; ?></textarea>
											</div>

                                            <div class="form-group">
												<label class="control-label" for="address-description">Address Location</label>
												<textarea id="address-desc" class="form-control" name="address_desc" rows="8" cols="4" placeholder="Contact Address Location"><?php echo $section["address_desc"] ?? ""; ?></textarea>
											</div>

                                            <div class="form-group">
												<label class="control-label" for="contact-phonenum1">Phone Number 1</label>
												<input type="text" value="<?php echo $section["contact_phonenum1"] ?? ""; ?>" class="form-control form-control-lg" id="contact-phonenum1" name="contact_phonenum1" placeholder="Contact phone number1">
												<?php echo form_error_component($errors, 'contact_phonenum1"');?>
											</div>
                                            
											<div class="form-group">
												<label class="control-label" for="contact-phonenum2">Phone Number 2</label>
												<input type="text" value="<?php echo $section["contact_phonenum2"] ?? ""; ?>" class="form-control form-control-lg" id="contact-phonenum2" name="contact_phonenum2" placeholder="Contact phone number2">
												<?php echo form_error_component($errors, 'contact_phonenum2"');?>
											</div>
                                            <div class="form-group">
												<label class="control-label" for="email-addr">Email Address</label>
												<input type="email" value="<?php echo $section["email_addr"] ?? ""; ?>" class="form-control form-control-lg" id="email-addr" name="email_addr" placeholder="eg: clevelandlab@gmail.com">
												<?php echo form_error_component($errors, 'email_addr"');?>
											</div>
											<div class="form-group">
												<label class="control-label" for="facebook-handle">Facebook Handle</label>
												<input type="test" value="<?php echo $section["facebook_handle"] ?? ""; ?>" class="form-control form-control-lg" id="facebook-handle" name="facebook_handle" placeholder="eg: facebook/clevelandlab.com">
												<?php echo form_error_component($errors, 'facebook_handle"');?>
											</div>
											<div class="form-group">
												<label class="control-label" for="twitter-handle">Twitter Handle</label>
												<input type="test" value="<?php echo $section["twitter_handle"] ?? ""; ?>" class="form-control form-control-lg" id="twitter-handle" name="twitter_handle" placeholder="eg: twitter/clevelandlab.com">
												<?php echo form_error_component($errors, 'twitter_handle"');?>
											</div>
											<div class="form-group">
												<label class="control-label" for="linkedin-handle">Linkedin Handle</label>
												<input type="test" value="<?php echo $section["linkedin_handle"] ?? ""; ?>" class="form-control form-control-lg" id="linkedin-handle" name="linkedin_handle" placeholder="eg: linkedin/clevelandlab.com">
												<?php echo form_error_component($errors, 'linkedin_handle"');?>
											</div>
											<div class="form-group">
												<label class="control-label" for="instagram-handle">Instagram Handle</label>
												<input type="test" value="<?php echo $section["instagram_handle"] ?? ""; ?>" class="form-control form-control-lg" id="instagram-handle" name="instagram_handle" placeholder="eg: instagram/clevelandlab.com">
												<?php echo form_error_component($errors, 'instagram_handle"');?>
											</div>
                                            <div class="form-group">
												<label class="control-label" for="service-hrs">Service Hours</label>
												<textarea id="service-hrs" class="form-control editor" name="service_hrs" rows="8" cols="4" placeholder="Service Hours"><?php echo $section["service_hrs"] ?? ""; ?></textarea>
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
