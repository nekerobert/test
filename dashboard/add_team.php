<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login(); ?>

<?php
	   /* Set Main Page Routes*/
	   $route = "pages/about-us/sections/team";
	   /* Page Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route, "create");
	$formTitle = "Create New team Member";
	if(isset($_GET['team_id'])){
		$id = h(u($_GET["team_id"]));
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
		$team = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			$formTitle = "Edit Selected Team Member";
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					// validate Data
					// N/B data not validated is specify as the third parameter oof validate_data function
					// This is because they are optional
					$editMode = true; //Set Edit Mode
					$valResult = validate_data(regenerate_with_required($team,'member_name'), ['member_name'=>'title']);
					if(!$valResult){
						//Creating a new Member
						// Rearrange data values
						// Facebook
						if(!isset($_POST["enable_fb"])){
							$team["enable_fb"] = 0;
							$team["member_fb"] = "";
						}else{
							$team["enable_fb"] = 1;
						}

						// LinkedIn
						if(!isset($_POST["enable_lk"])){
							$team["enable_lk"] = 0;
							$team["member_lk"] = "";
						}else{
							$team["enable_lk"] = 1;
						}
						// LinkedIn
						if(!isset($_POST["enable_tw"])){
							$team["enable_tw"] = 0;
							$team["member_tw"] = "";
						}else{
							$team["enable_tw"] = 1;
						}
						// Confirm if member already exist by retrieving the image mapped to the slider
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "about-team-member" AND page_datas.id ='.merge_and_escape([$id],$db));
						if($file){
							// File Exist
							// Prepare slider values to be inserted
							$data["content"] = array_to_json($team,'csrf_token');
								$data["date_updated"] = date('Y-m-d h:i:s');
							$data["id"] = $id;
							$status = update_data('page_datas',$data,'id');
							$msg = "Team member information updated successfully";
							$editMode = true;
							$team["file_id"] = $file["id"];
							$team["image"] = $file["path"];
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
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "about-team-member" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
						$team["file_id"] = $file["id"];
						$team["image"] = $file["path"];
						$formUrl = generate_route($route, "edit",$id,);

					}
					break;
					
				case 'editFile':
					$editMode = true;
					$msg = "Member Image Update failed. Please try again"; //Message to be displayed if update fails
					$data  = find_data('page_datas',['page_datas.id','content','path'],'INNER JOIN files ON page_datas.file_id = files.id'," WHERE page_datas.title = 'about-team-member' AND files.id = ".merge_and_escape([$id],$db),false);
					if(!$data){
						// User tempered with the record Id 
						$msg = "Sorry file update was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route, "manage"));
					}
					
					$result = upload_file($_FILES["file"]);
					if($result["mode"]){
						// Retrieve file to be deleted
						$team = sanitize_html(json_to_array($data["content"]));
						$result["id"] = $id;
						$result["date_updated"] = date('Y-m-d H:i:s');
						$team["image"] = $data["path"];
						$team["id"] = $data["id"];
						if(unlink(UPLOAD_PATH.'/'.$data["path"])){// Delete the previous file
							// Update data
							update_data('files',$result,'id,mode');
							$status = true;
							// update the previous slider path to the updated food path
							$team["image"] = $result["path"];
							$team["file_id"] = $result["id"];
							$msg = "Team member Image was updated succesfully";
							$formUrl = generate_route($route, "edit", $team["id"]);
						}
						else{
							// Error occured during file upload
							// Retrieve the slider content to be display in the page again
							$team = sanitize_html(json_to_array($data["content"]));
							$team["image"] = h($data["path"]);
							$team["id"] = h($data["id"]);
							$team["file_id"] = $id;
							$editMode = true; 
							$formUrl = generate_route($route, "edit", $team["id"]);
						}
					}
					else{
						// Error occured while uploading file
						$team = sanitize_html(json_to_array($data["content"]));
						$team["image"] = h($data["path"]);
						$team["id"] = h($data["id"]);
						$team["file_id"] = $id;
						$errors = $result;
						$formUrl = generate_route($route, "edit", $team["id"]);
					}	
					
					break;

			}
		
		}else{
			// This is because they are optional
			$valResult = validate_data(regenerate_with_required($team, 'member_name'), ['member_name'=>'title'] );
			if(!$valResult){
				//Creating a new Member
				// Rearrange data values
				// Facebook
				if(!isset($_POST["enable_fb"])){
					$team["enable_fb"] = 0;
					$team["member_fb"] = "";
				}else{
					$team["enable_fb"] = 1;
				}

				// LinkedIn
				if(!isset($_POST["enable_lk"])){
					$team["enable_lk"] = 0;
					$team["member_lk"] = "";
				}else{
					$team["enable_lk"] = 1;
				}

				// LinkedIn
				if(!isset($_POST["enable_tw"])){
					$team["enable_tw"] = 0;
					$team["member_tw"] = "";
				}else{
					$team["enable_tw"] = 1;
				}
				
			// Creating a new member
			// validate Data
			// N/B data not validated is specify as the third parameter oof validate_data function
				$file = $_FILES["file"];
				$result = upload_file($file);
				if($result["mode"]){
					// No errors
					insert_data('files',$result,'mode');
						// Prepare slider values to be inserted
					$data["file_id"] = get_id($db);
					$data["content"] = array_to_json($team,'csrf_token');
					$data["title"] = "about-team-member";
					$data["date_created"] = date('Y-m-d h:i:s');
					$status = insert_data('page_datas',$data);
					$msg = "New team member added successfully";
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
					$data  = find_data('page_datas',['page_datas.id','content','path','file_id'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE page_datas.title='about-team-member' AND page_datas.id = ".merge_and_escape([$id],$db),false);
					if($data){
						$team = json_to_array($data["content"]);
						$team["image"] = $data["path"];
						$team["file_id"] = $data["file_id"];
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit Selected Team Member";
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
									<h1>About us Team Section</h1>
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
											<a class="parent-item" href="<?php echo DASHBOARD_PATH.'pages/about-us/sections/team/manage'?>">Manage team</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											team section
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
											Edit team member image
										</div>
										<div class="card-body">
											<form method="post" id="editFile" action="<?php echo DASHBOARD_PATH.'pages/about-us/sections/team/file/'.u($team["file_id"]).'/edit'?>" enctype="multipart/form-data">
												<div class="slider-img mb-2">
													<img class="img-fluid" src="<?php echo full_upload_url($team["image"]); ?>" alt="Member Image">
													<span title="Change team member Image" data-toggle="tooltip" class="update-icon"><i class="fa fa-pencil"></i></span>
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
													<a class="btn btn-dark" href="<?php echo DASHBOARD_PATH.'pages/about-us/sections/team/manage'?>"><i class="fa fa-cogs"></i> Manage Team Members</a>
												</div>
											</div>
										<div class="card-body container">
											<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>" enctype="multipart/form-data">
												<div class="form-group">
													<label class="control-label" for="member-name">Member name</label>
													<input type="text" value="<?php echo $team["member_name"] ?? ""; ?>" class="form-control" id="member-name" name="member_name" placeholder="Member Name">
													<?php echo form_error_component($errors, 'member_name');?>
												</div>
												<div class="form-group">
													<label class="control-label" for="primary-title">Member position</label>
													<input type="text" value="<?php echo $team["member_position"] ?? ""; ?>" class="form-control" id="member-position" name="member_position" placeholder="Member Position">
												</div>
												<div class="form-group">
													<label class="control-label" for="section-description">Member description</label>
													<textarea id="member-desc" class="form-control" name="member_desc" rows="8" cols="4"><?php echo $team["member_desc"] ?? ""; ?></textarea>
												</div>
												<div class="form-check">
													<input type="checkbox" <?php echo isset($team["enable_fb"])? ($team["enable_fb"] == '1' ? 'checked':'') : "";?> id="enable-fb" name="enable_fb"> 		
													<label for="agree" class="form-check-label">Enable facebook handle </label>
												</div>
												<div class="btn-wrapper <?php echo isset($team["enable_fb"])? ($team["enable_fb"] == '1' ? '':'d-none') : "d-none";?> ">
													<div class="form-group">
														<label class="control-label" for="primary-title">Member facebook handle</label>
														<input type="text" value="<?php echo $team["member_fb"] ?? ""; ?>" class="form-control" id="member-fb" name="member_fb" placeholder="Member facebook handle">
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" <?php echo isset($team["enable_lk"])? ($team["enable_lk"] == '1' ? 'checked':'') : "";?> id="enable-lk" name="enable_lk"> 		
													<label for="agree" class="form-check-label">Enable linkedIn handle </label>
												</div>
												<div class="btn-wrapper <?php echo isset($team["enable_lk"])? ($team["enable_lk"] == '1' ? '':'d-none') : "d-none";?> ">
													<div class="form-group">
														<label class="control-label" for="primary-title">Member LinkedIn handle</label>
														<input type="text" value="<?php echo $team["member_lk"] ?? ""; ?>" class="form-control" id="member-lk" name="member_lk" placeholder="Member linkedIn handle">
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" <?php echo isset($team["enable_tw"])? ($team["enable_tw"] == '1'? 'checked':'') : "";?> id="enable-tw" name="enable_tw"> 		
													<label for="agree" class="form-check-label">Enable Twitter handle </label>
												</div>
												<div class="btn-wrapper <?php echo isset($team["enable_tw"])? ($team["enable_tw"] == '1'? '':'d-none') : "d-none";?> ">
													<div class="form-group">
														<label class="control-label" for="primary-title">Member Twitter handle</label>
														<input type="text" value="<?php echo $team["member_tw"] ?? ""; ?>" class="form-control" id="member-tw" name="member_tw" placeholder="Member Twitter handle">
													</div>
												</div>
												<?php if(!$editMode){?>
													<div class="form-group mb-4">
														<label class="control-label" for="file">Member Profile Image (300 X 300) </label>
														<input type="file" class="form-control" id="file" name="file" placeholder="Choose  image" />
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