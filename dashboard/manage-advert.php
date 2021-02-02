<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	/* Set Main Page Routes*/
	$route = "pages/home/sections/advert";
	/* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route);
	$formTitle = "Create A New Advert";
	$advert = '';
	if(isset($_GET['advert_id'])){
		$id = h(u($_GET["advert_id"]));
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
		$advert = sanitize_html($_POST);

		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			$formTitle = "Edit Homepage Advert";
			switch ($_GET["mode"]) {
				case 'edit':
					//Editing a new Advert
					// Rearrange data values
					$formUrl = generate_route($route, "edit", $id);
					$editMode = true;
					if(!$_POST["enable_advert_section"]){
						// Request was sent with form being modified in an unscrupulous way
						$msg = "Sorry request was unsucessful";
						$status = false;
						// Set cookie message
						cookie_message($status, $msg);
						redirect_to(generate_route($route));
					}
					// Advert section is checked
					$advert["enable_advert_section"] = '1';
					$advert["enable_advert_btn"] = (!$_POST["enable_advert_btn"]) ? '0' : '1';
					// N/B: validation is done only on the title if the advert section is checked
					$valResult =  validate_data(regenerate_with_required($advert,"advert_title"), ['advert_title'=>'title']);
					// This is because they are optional
					if(!$valResult){
						// No errors
						// Confirm if advert already exist by retrieving the image mapped to the advert
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "home-advert" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
						if($file){
							// File Exist
							// Prepare data values to be inserted
							$data["content"] = array_to_json($advert,'csrf_token');
							$data["date_updated"] = date('Y-m-d h:i:s');
							$data["id"] = $id;
							$status = update_data('page_datas',$data,'id');
							$msg = "Advert information updated successfully";
							$editMode = true;
							$advert["file_id"] = $file["id"];
							$advert["image"] = $file["path"];
							
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
						// Retrieve the file data to be redisplayed on the file form
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "home-advert" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
						$advert["file_id"] = $file["id"];
						$advert["image"] = $file["path"];
					}
					
					break;
					
				case 'editFile':
					$editMode = true;
					$msg = "Advert Image Update failed. Please try again"; //Default message to be displayed if update fails
					// Retrieve record to be deleted, and advert data to be render again on the form
					$data  = find_data('page_datas',['page_datas.id','content','path'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE files.id = ".merge_and_escape([$id],$db).' AND page_datas.title = "home-advert" LIMIT 1 ',false);
					if($data){
						$result = upload_file($_FILES["file"]);
						if($result["mode"]){
							$advert = sanitize_html(json_to_array($data["content"]));
							$result["id"] = $id;
							$result["date_updated"] = date('Y-m-d H:i:s');
							$advert["image"] = $data["path"];
							if(unlink(UPLOAD_PATH.'/'.$data["path"])){// Delete the previous file
								// Update data
								update_data('files',$result,'id,mode');
								$status = true;
								// update the previous slider path to the updated food path
								$advert["image"] = $result["path"];
								$advert["file_id"] = $result["id"];
								$msg = "Advert image was updated succesfully";
								cookie_message($msg, $status);
								redirect_to(generate_route($route));
							}
						}else{
							// Errors occured while uploading file
							// Display Errors to the user
							$errors = $result;
							// Retrieve record to be displayed again on the form
							$advert = sanitize_html(json_to_array($data["content"]));
							$advert["image"] = h($data["path"]);
							$advert["id"] = h($data["id"]);
							$advert["file_id"] = $id;
							$editMode = $advert ? true : false; 
							$formUrl = generate_route($route, "edit", $advert["id"]);
						}

					}else{
						// User messed around with the record Id 
						$msg = "Sorry file update was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route));
					}
					break;
				default:
					// Mode has no specified case under the request type
					redirect_to(DASHBOARD_PATH.'pages/home/sections/advert');
			}
		}else{
				//Creating a new Advert
				// Rearrange data values
				if(!$_POST["enable_advert_section"]){
					// Request was sent with form being modified in an unscrupulous way
						$msg = "Sorry request was unsucessful";
						$status = false;
						// Set cookie message
						cookie_message($status, $msg);
						redirect_to(DASHBOARD_PATH.'pages/home/sections/advert');
					// $advert
				}else{
					// Advert section is checked
					$advert["enable_advert_section"] = '1';
					$advert["enable_advert_btn"] = (!$_POST["enable_advert_btn"]) ? '0' : '1';

				}
			// validate Data
			// N/B: validation is done only on the advert title if the advert section is selected
			$valResult = validate_data(regenerate_with_required($advert,"advert_title"));
			if(!$valResult){
					$file = $_FILES["file"];
					$result = upload_file($file);
					if($result["mode"]){
						// No errors
						insert_data('files',$result,'mode');
						// Prepare slider values to be inserted
						$data["file_id"] = get_id($db);
						$data["content"] = $advert["enable_advert_section"] === "1" ? array_to_json($advert,'csrf_token'):null;
						$data["title"] = "home-advert";
						$data["date_created"] = date('Y-m-d h:i:s');
						$status = insert_data('page_datas',$data);
						$msg = "New advert created successfully";
						//To be used in the form again
						$advert["file_id"] = $data["file_id"];
						$advert["image"] = $result["path"];  
						$editMode = true;
						$formUrl = DASHBOARD_PATH.'pages/home/sections/advert/'.h(u($id)).'/edit';
						$formTitle = "Edit Homepage Advert";
						//cookie_message($msg, $status);
						//redirect_to(DASHBOARD_PATH.'sliders/create');
					}else{
						// Errors occured while uploading file
							$errors = $result;
					}

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
					$data  = find_data('page_datas',['page_datas.id','content','path','file_id'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE page_datas.title='home-advert' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						$advert = json_to_array($data["content"]);
						$advert["image"] = $data["path"];
						$advert["file_id"] = $data["file_id"];
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit Homepage Advert";
						$editMode = true;
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
			$data = find_data('page_datas',['content','page_datas.id','path','files.id as file_id'],'INNER JOIN files ON files.id = page_datas.file_id', 'WHERE page_datas.title ="home-advert" LIMIT 1',false);
			if($data){
				$editMode = true; 
				$advert = sanitize_html(json_to_array($data["content"]));
				$advert["image"] = $data["path"];
				$advert["file_id"] = $data["file_id"];
				$advert["id"] = h(u($data["id"]));
				$formUrl = generate_route($route, "edit", $advert["id"]);;
				$formTitle = "Edit Homepage Advert";
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
									<h1>Manage Home Advert Section</h1>
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
											Home Advert Section
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
						
						echo display_multiple_errors($errors); //Display errors while uploading files
					
					?>
					<div class="row">
						<!-- form statrts -->
							<?php if($editMode) {?>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header bg-info text-white">
											Edit Advert Image
										</div>
										<div class="card-body">
											<form method="post" id="editFile" action="<?php echo DASHBOARD_PATH.'resources/advert/file/'.u($advert["file_id"]).'/edit'?>" enctype="multipart/form-data">
												<div class="slider-img mb-2">
													<img class="img-fluid" src="<?php echo full_upload_url($advert["image"]); ?>" alt="Advert Image">
													<span title="Change Slider Image" data-toggle="tooltip" class="update-icon"><i class="fa fa-pencil"></i></span>
												</div>
												
												<div class="form-group d-none mt-3" id="fileBox">
													<input id="file" class="form-control mb-3" type="file" name="file">
													<div class="control row d-flex justify-content-between">
														<button type="button" class="btn btn-danger btn-md text-white"><i class="fa fa-times"> Cancel</i></button>
														<button type="submit" class="btn btn-info btn-md"><i class="fa fa-rocket"> Update Image</i></button>
													</div>
                                            	</div>
                                            <div class="form-group">
                                             	<input type="hidden" value="" name="csrf_token">
                                            </div>
											</form>
										</div>
										<div class="card-footer bg-info p-4">
											
										</div>
									</div>
								</div>

							<?php } ?>
						
						
								<div class="<?php echo 	$editMode ? "col-md-8":"col-md-12";?>">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
											<div class="card-header bg-info ">
												<div class="card-title text-white">
													<?php echo $formTitle; ?>
												</div>
											</div>
										<div class="card-body container">
											<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>" enctype="multipart/form-data">
												<div class="form-check">
													<input type="checkbox" id="advert-section" <?php echo isset($advert["enable_advert_section"]) && $advert["enable_advert_section"] == '1' ? 'checked':'';?> name="enable_advert_section"> 		
													<label for="advert-section" class="form-check-label"> Enable Advert Section </label>
												</div>
												<div class="btn-wrapper <?php echo isset($advert["enable_advert_section"]) && $advert["enable_advert_section"] === '1' ? '':'d-none';?> ">
													<div class="form-group">
														<label class="control-label" for="primary-title">Advert Title</label>
														<input type="text" value="<?php echo $advert["advert_title"] ?? ""; ?>" class="form-control" id="primary-title" name="advert_title" placeholder="Primary Title">
														<?php echo form_error_component($errors, 'advert_title');?>
													</div>
													<div class="form-group">
														<label class="control-label" for="primary-title">Advert Message</label>
														<textarea id="advert-title" class="form-control editor" name="advert_text" rows="8" cols="4"><?php echo $advert["advert_text"] ?? ""; ?></textarea>
													</div>
													<div class="form-check">
														<input type="checkbox" <?php echo isset($advert["enable_advert_btn"]) && $advert["enable_advert_btn"] == '1' ? 'checked':'';?> id="enable-advert-btn" name="enable_advert_btn"> 		
														<label for="agree" class="form-check-label">Enable Advert Button </label>
													</div>
													<div class="btn-wrapper <?php echo isset($advert["enable_advert_btn"]) && $advert["enable_advert_btn"] == '1' ? '':'d-none';?> ">
														<div class="form-group">
															<label class="control-label" for="advert-btn-text">Advert Button Text</label>
															<input type="text" value="<?php echo $advert["advert_btn_text"] ?? ""; ?>" class="form-control" id="advert-btn-text" name="advert_btn_text" placeholder="Advert Button Text">
														</div>
														<div class="form-group">
															<label class="control-label" for="advert-btn-link">Advert Button Link</label>
															<input type="text" value="<?php echo $advert["advert_btn_link"] ?? ""; ?>" class="form-control" id="advert-btn-link" name="advert_btn_link" placeholder="Advert Button Link">
														</div>
													</div>
													<?php if(!$editMode){?>
														<div class="form-group mb-4">
															<label class="control-label" for="file">Home Advert Image</label>
															<input type="file" class="form-control" id="file" name="file" placeholder="Choose Tip Slider image" />
														</div>
													<?php } ?>
												<?php echo csrf_token_tag(); ?>
											
												<div class="form-group text-center form-row">
													<div class="col-sm-4 mb-sm-2"><button type="submit" class="btn btn-block p-3 btn-info">Submit</button></div>
													<div class="col-sm-4"><input id="reset" type="reset" value="Reset" class="btn p-3 btn-block btn-danger"/></div>
												</div>
													
												</div>
											</form>
										</div>
									</div>
							</div>
					</div>
				</div>
			</main>
			<!--main contents end-->

<?php //echo display_delete_modal('Page'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>