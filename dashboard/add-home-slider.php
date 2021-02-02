<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>

<?php confirm_user_login(); ?>

<?php
	   /* Set Main Page Routes*/
	   $route = "sliders";
	   /* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route, "create");
	$formTitle = "Create A New Slider";
	if(isset($_GET['slider_id'])){
		$id = h(u($_GET["slider_id"]));
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
		$slider = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			$formTitle = "Edit Selected Slider";
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					// validate Data
					// N/B data not validated is specify as the third parameter oof validate_data function
					// This is because they are optional
					$editMode = true; //Set Edit Mode
					$valResult = validate_data(regenerate_with_required($slider,'primary_title'), ['primary_title'=>'title']);
					if(!$valResult){
							// Rearrange data values
						if(!isset($_POST["enable_sec_title"])){
							$slider["enable_sec_title"] = 0;
							$slider["secondary_title"] = "";
						}else{
							$slider["enable_sec_title"] = 1;
						}

						if(!isset($_POST["enable_btn_one"])){
							$slider["enable_btn_one"] = 0;
							$slider["btn_one_text"] = "";
							$slider["btn_one_link"] = "";
						}else{
							$slider["enable_btn_one"] = 1;
						}

						if(!isset($_POST["enable_btn_two"])){
							$slider["enable_btn_two"] = 0;
							$slider["btn_two_text"] = "";
							$slider["btn_two_link"] = "";
						}else{
							$slider["enable_btn_two"] = 1;
						}
					// Creating a new Slider is handle here
						// No errors
						// Confirm if slider already exist by retrieving the image mapped to the slider
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "slider" AND page_datas.id ='.merge_and_escape([$id],$db));
						if($file){
							// File Exist
							// Prepare slider values to be inserted
							$data["content"] = array_to_json($slider,'csrf_token');
								$data["date_updated"] = date('Y-m-d h:i:s');
							$data["id"] = $id;
							$status = update_data('page_datas',$data,'id');
							$msg = "Slider information updated successfully";
							$editMode = true;
							$slider["file_id"] = $file["id"];
							$slider["image"] = $file["path"];
							$formUrl = generate_route($route, "edit",$id,);
					}else{
						// Id is unverified therefore request source is not accurate
						$msg = "Sorry request was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route, "manage"));
					}
						
					}else{
						// Errors occured while Handling form validating
						$errors = $valResult;
						// Retrieve the file data to be redisplayed on the file form
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "slider" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
						$slider["file_id"] = $file["id"];
						$slider["image"] = $file["path"];
						$formUrl = generate_route($route, "edit",$id,);

					}
					break;
					
				case 'editFile':
					$editMode = true;
					$msg = "Slider Image Update failed. Please try again"; //Message to be displayed if update fails
					$data  = find_data('page_datas',['page_datas.id','content','path'],'INNER JOIN files ON page_datas.file_id = files.id'," WHERE page_datas.title = 'slider' AND files.id = ".merge_and_escape([$id],$db),false);
					if(!$data){
						$msg = "Sorry file update was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route, "manage"));
					}
					
					$result = upload_file($_FILES["file"]);
					if($result["mode"]){
						// Retrieve file to be deleted
						$slider = sanitize_html(json_to_array($data["content"]));
						$result["id"] = $id;
						$result["date_updated"] = date('Y-m-d H:i:s');
						$slider["image"] = $data["path"];
						$slider["id"] = $data["id"];
						if(unlink(UPLOAD_PATH.'/'.$data["path"])){// Delete the previous file
							// Update data
							update_data('files',$result,'id,mode');
							$status = true;
							// update the previous slider path to the updated food path
							$slider["image"] = $result["path"];
							$slider["file_id"] = $result["id"];
							$msg = "slider Image was updated succesfully";
							$formUrl = generate_route($route, "edit", $slider["id"]);
						}
						else{
							// Error occured during file upload
							// Retrieve the slider content to be display in the page again
							$slider = sanitize_html(json_to_array($data["content"]));
							$slider["image"] = h($data["path"]);
							$slider["id"] = h($data["id"]);
							$slider["file_id"] = $id;
							$editMode = true; 
							$formUrl = generate_route($route, "edit", $slider["id"]);
						}	
					}else{
						// Error occured while uplaoding file
						$slider = sanitize_html(json_to_array($data["content"]));
						$slider["image"] = h($data["path"]);
						$slider["id"] = h($data["id"]);
						$slider["file_id"] = $id;
						$errors = $result;
						$formUrl = generate_route($route, "edit", $slider["id"]);
					}
			
				break;
			}
		}else{
			// This is because they are optional
			$valResult = validate_data($slider, ['primary_title'=>'title'], 'csrf_token,enable_sec_title,secondary_title,enable_btn_one,btn_one_text,btn_one_link,btn_two_text,btn_two_link');
			if(!$valResult){
				//Creating a new Slider
				// Rearrange data values
				if(!isset($_POST["enable_sec_title"])){
					$slider["enable_sec_title"] = 0;
					$slider["secondary_title"] = "";
				}else{
					$slider["enable_sec_title"] = 1;
				}

				if(!isset($_POST["enable_btn_one"])){
					$slider["enable_btn_one"] = 0;
					$slider["btn_one_text"] = "";
					$slider["btn_one_link"] = "";
				}else{
					$slider["enable_btn_one"] = 1;
				}

				if(!isset($_POST["enable_btn_two"])){
					$slider["enable_btn_two"] = 0;
					$slider["btn_two_text"] = "";
					$slider["btn_two_link"] = "";
				}else{
					$slider["enable_btn_two"] = 1;
				}
			// Creating a new Slider is handle here
			// validate Data
			// N/B data not validated is specify as the third parameter oof validate_data function
				$file = $_FILES["file"];
				$result = upload_file($file);
				if($result["mode"]){
					// No errors
					insert_data('files',$result,'mode');
						// Prepare slider values to be inserted
					$data["file_id"] = get_id($db);
					$data["content"] = array_to_json($slider,'csrf_token');
					$data["title"] = "slider";
					$data["date_created"] = date('Y-m-d h:i:s');
					$status = insert_data('page_datas',$data);
					$msg = "New slider created successfully";
					cookie_message($msg, $status);
					redirect_to(generate_route($route, "create"));
				}else{
					// Errors occured while uploading file
					$errors = $result;
				}

			}else{
				// There is errors
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
					$data  = find_data('page_datas',['page_datas.id','content','path','file_id'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE page_datas.title='slider' AND page_datas.id = ".merge_and_escape([$id],$db),false);
					if($data){
						$slider = json_to_array($data["content"]);
						$slider["image"] = $data["path"];
						$slider["file_id"] = $data["file_id"];
						$formUrl = DASHBOARD_PATH.'sliders/'.$id.'/edit';
						$formTitle = "Edit Selected Slider";
						$editMode = true;
					}else{
						redirect_to(generate_route($route, "manage"));
					}
					# code...
					break;
				
				default:
					redirect_to(generate_route($route, "manage"));
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
									<h1>Home Slider</h1>
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
										<li>
											<i class="fa fa-cogs"></i>
											<a class="parent-item" href="<?php echo DASHBOARD_PATH.'sliders/manage'?>">Manage Sliders</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Home Slider
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--page title end-->


				<div class="container-fluid">
					<?php echo display_status_message($status, $msg); //Display status success/failure message?>
					<?php echo display_multiple_errors($errors); //Display errors while uploading files?>

					<div class="row">
						<!-- form statrts -->
							
							<?php if($editMode) {?>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header bg-info text-white">
											Edit Slider Image
										</div>
										<div class="card-body">
											<form method="post" id="editFile" action="<?php echo DASHBOARD_PATH.'sliders/file/'.u($slider["file_id"]).'/edit'?>" enctype="multipart/form-data">
												<div class="slider-img mb-2">
													<img class="img-fluid" src="<?php echo full_upload_url($slider["image"]); ?>" alt="Slider Image">
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
											<div class="card-header d-flex justify-content-between bg-info ">
												<div class="card-title text-white">
													<?php echo $formTitle; ?>
												</div>
												<div class="card-title text-white">
													<a class="btn btn-dark" href="<?php echo DASHBOARD_PATH.'sliders/manage'?>"><i class="fa fa-cogs"></i> Manage Sliders</a>
												</div>
											</div>
										<div class="card-body container">
											<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>" enctype="multipart/form-data">
												<div class="form-group">
													<label class="control-label" for="primary-title">Primary Title</label>
													<input type="text" value="<?php echo $slider["primary_title"] ?? ""; ?>" class="form-control" id="primary-title" name="primary_title" placeholder="Primary Title">
													<?php echo form_error_component($errors, 'primary_title');?>
												</div>
												<div class="form-check">
												<?php //echo (int) $slider["enable_sec_title"]; exit?>
														<input type="checkbox" <?php echo isset($slider["enable_sec_title"])? ($slider["enable_sec_title"] == '1' ? 'checked':'') : "";?> id="enable-sec-title" name="enable_sec_title"> 		
														<label for="agree" class="form-check-label">Enable secondary title </label>
												</div>
												<div class="btn-wrapper <?php echo isset($slider["enable_sec_title"])? ($slider["enable_sec_title"] == '1' ? '':'d-none') : "d-none";?> ">
													<div class="form-group">
														<label class="control-label" for="sectitle">Secondary Title</label>
														<input type="text" class="form-control" id="sectitle" value="<?php echo $slider["secondary_title"] ?? "";?>" name="secondary_title" placeholder="Secondary Title">
													</div>
												</div>
												
												<div class="form-check">
													<input type="checkbox" id="enable-sec-title" <?php echo isset($slider["enable_btn_one"])? ($slider["enable_btn_one"] == '1' ? 'checked':''):"";?> name="enable_btn_one"> 		
													<label for="agree" class="form-check-label"> Enable button one </label>
												</div>
												<div class="btn-wrapper <?php echo isset($slider["enable_btn_one"]) ? ($slider["enable_btn_one"] == '1' ? '':'d-none'):"d-none";?>">
													<div class="form-group">
														<label class="control-label" for="">Button one Text</label>
														<input type="text" class="form-control" id="btn-one-text" value="<?php echo $slider["btn_one_text"] ?? "";?>" name="btn_one_text" placeholder="Button one text">
													</div>
													<div class="form-group">
														<label class="control-label" for="">Button one link</label>
														<input type="text" class="form-control" id="btn-one-link" value="<?php echo $slider["btn_one_link"] ?? "";?>" name="btn_one_link" placeholder="Button one link">
													</div>
												</div>
												<div class="form-check">
														<input type="checkbox" id="enable-btn-two" <?php echo isset($slider["enable_btn_two"]) ? ($slider["enable_btn_two"] == '1' || $slider["enable_btn_two"] == "on" ? 'checked':''):"";?> name="enable_btn_two"> 		
														<label for="agree" class="form-check-label"> Enable button two </label>
												</div>
												<div class="btn-wrapper <?php echo isset($slider["enable_btn_two"]) ? ($slider["enable_btn_two"] == '1' ? '':'d-none'):"d-none";?> ">
													<div class="form-group">
														<label class="control-label" for="sectitle">Button two text</label>
														<input type="text" class="form-control" id="btn-two-text" value="<?php echo $slider["btn_two_text"] ?? "";?>" name="btn_two_text" placeholder="Button two text">
													</div>
													<div class="form-group">
														<label class="control-label" for="sectitle">Button two link</label>
														<input type="text" class="form-control" id="" value="<?php echo $slider["btn_two_link"] ?? "";?>" name="btn_two_link" placeholder="Button two link">
														
													</div>
												</div>
												<?php if(!$editMode){?>
													<div class="form-group mb-4">
														<label class="control-label" for="file">Home Slider Image</label>
														<input type="file" class="form-control" id="file" name="file" placeholder="Choose Tip Slider image" />
													</div>
												<?php } ?>
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
			</main>
			<!--main contents end-->

<?php //echo display_delete_modal('Page'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>