<?php require_once($_SERVER['DOCUMENT_ROOT'].'/cleveland/private/init.php'); ?>
<?php
   /* Set Main Page Routes*/
    $route = "pages/about-us/sections/challenge";
   /* Page Route Ends Here*/
   
   /* variables Initialization  begins*/
   $errors = []; $status = false; $msg = ""; 
	$editMode = false;
	$formUrl = generate_route($route, "create");
	$formTitle = "Create New Challenge";
    // $challenge = '';
      /*variables Initialization ends*/
	if(isset($_GET['c_id'])){
        $id = h(u($_GET["c_id"]));
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
		$challenge = sanitize_html($_POST);

		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			$formTitle = "Edit About Us Challenge";
			switch ($_GET["mode"]) {
				case 'edit':
					//Editing a new Advert
                    // Rearrange data values
					$formUrl = generate_route($route, "edit", $id);
					$editMode = true;
					// N/B: validation is done only on the title if the advert section is checked
					$valResult =  validate_data(regenerate_with_required($challenge,"challenge_title"), ['challenge_title'=>'title']);
					// This is because they are optional
                    if(!$valResult){
						// No errors
						// Confirm if advert already exist by retrieving the image mapped to the advert
					    $file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "about-challenge-item" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
                        if($file){
                            // File Exist
                            // Prepare data values to be inserted
                            $data["content"] = array_to_json($challenge,'csrf_token');
                            $data["date_updated"] = date('Y-m-d h:i:s');
                            $data["id"] = $id;
                            $status = update_data('page_datas',$data,'id');
                            $msg = "Challenge information updated successfully";
                            $editMode = true;
                            $challenge["file_id"] = $file["id"];
                            $challenge["image"] = $file["path"];
                        }else{
                                // Record Id was tempered with
                            $msg = "Sorry request was not successful. Please try again";
                            $status = false;
                            cookie_message($msg, $status);
                            redirect_to(generate_route($route, "manage"));
                        }
                    }else{
                       	// Error occured
						$errors = $valResult;
						// Retrieve the file data to be redisplayed on the file form
						$file = find_data('files',['files.id','path'],'INNER JOIN page_datas ON files.id = page_datas.file_id','WHERE page_datas.title = "about-challenge-item" AND page_datas.id ='.merge_and_escape([$id],$db).' LIMIT 1');
						$challenge["file_id"] = $file["id"];
						$challenge["image"] = $file["path"];
                    }
					break;
					
				case 'editFile':
					$editMode = true;
					$msg = "Challenge Image Update failed. Please try again"; //Default message to be displayed if update fails
					// Retrieve record to be deleted, and advert data to be render again on the form
					$data  = find_data('page_datas',['page_datas.id','content','path'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE files.id = ".merge_and_escape([$id],$db).' AND page_datas.title = "about-challenge-item" LIMIT 1 ',false);
					if($data){
						$result = upload_file($_FILES["file"]);
						if($result["mode"]){
							$challenge = sanitize_html(json_to_array($data["content"]));
							$result["id"] = $id;
							$result["date_updated"] = date('Y-m-d H:i:s');
							$challenge["image"] = $data["path"];
							if(!unlink(UPLOAD_PATH.'/'.$data["path"])){// Delete the previous file
                                cookie_message($msg, $status);
								redirect_to(generate_route($route, "edit",$data["id"]));
                            }    
                            // Update data
							update_data('files',$result,'id,mode');
							$status = true;
							// update the previous challenge path to the updated food path
							// $challenge["image"] = $result["path"];
							// $challenge["file_id"] = $result["id"];
							$msg = "Challenge Image was updated succesfully";
							cookie_message($msg, $status);
							redirect_to(generate_route($route, "edit",$data["id"]));
						
						}else{
							// Errors occured while uploading file
							// Display Errors to the user
							$errors = $result;
							// Retrieve record to be displayed again on the form
							$challenge = sanitize_html(json_to_array($data["content"]));
							$challenge["image"] = h($data["path"]);
							$challenge["id"] = h($data["id"]);
							$challenge["file_id"] = $id;
							$editMode = true; 
							$formUrl = generate_route($route, "edit", $tip["id"]);
						}

					}else{
						// User tempered with the record Id 
						$msg = "Sorry file update was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route, "manage"));
					}
					break;
                default:
					// Mode has no specified case under the request type
					redirect_to(generate_route($route,"manage"));
			}
		}else{
			// validate Data
			// N/B: validation is done only on the advert title if the advert section is selected
			$valResult = validate_data(regenerate_with_required($challenge,"challenge_title"), ['challenge_title'=>'title']);
			//Creating a new Health tip
			if(!$valResult){
				// Rearrange data values
				$file = $_FILES["file"];
				$result = upload_file($file);
				if($result["mode"]){
						// No errors
					insert_data('files',$result,'mode');
						// Prepare slider values to be inserted
					$data["file_id"] = get_id($db);
					$data["content"] = array_to_json($challenge,'csrf_token');
					$data["title"] = "about-challenge-item";
					$data["date_created"] = date('Y-m-d h:i:s');
					$status = insert_data('page_datas',$data);
					$msg = "New Challenge Item was created successfully";
					cookie_message($msg, true);
					redirect_to(generate_route($route, "create"));
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
					$data  = find_data('page_datas',['page_datas.id','content','path','file_id'],'INNER JOIN files ON page_datas.file_id = files.id',"WHERE page_datas.title='about-challenge-item' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						$challenge = json_to_array($data["content"]);
						$challenge["image"] = $data["path"];
                        $challenge["file_id"] = $data["file_id"];
						$formUrl = generate_route($route, "edit",$id);
						$formTitle = "Edit Challenge Item";
						$editMode = true;
					}else{
						//User tempered with the query string parameter
						$msg = "Sorry request failed. Try again";
						$status = false;
						cookie_message($status, $msg);
						redirect_to(generate_route($route, "manage"));
					}
					# code...
					break;
				
				default:
					// Mode has no specified case under the request type
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
									<h1>About Us Challenge Section</h1>
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
											Challenge Section
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
											Edit Challenge Image
										</div>
										<div class="card-body">
											<form method="post" id="editFile" action="<?php echo DASHBOARD_PATH.'pages/about-us/sections/challenge/file/'.u($challenge["file_id"]).'/edit'?>" enctype="multipart/form-data">
												<div class="slider-img mb-2">
													<img class="img-fluid" src="<?php echo full_upload_url($challenge["image"]); ?>" alt="Health Tip Image">
													<span title="Change Challenge Image" data-toggle="tooltip" class="update-icon"><i class="fa fa-pencil"></i></span>
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
											<div class="card-header bg-info d-flex justify-content-between">
												<div class="card-title text-white">
													<?php echo $formTitle; ?>
                                                </div>
                                                <div class="card-title text-white">
													<a class="btn btn-dark" href="<?php echo generate_route($route, "manage")?>"><i class="fa fa-cogs"></i> Manage challenge item</a>
												</div>
											</div>
										<div class="card-body container">
											<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl; ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
														<label class="control-label" for="challenge-title">Challenge title</label>
														<input type="text" value="<?php echo $challenge["challenge_title"] ?? ""; ?>" class="form-control" id="challenge-title" name="challenge_title" placeholder="Enter challenge title">
														<?php echo form_error_component($errors, 'challenge_title');?>
													</div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="challenge-description">Challenge description</label>
                                                        <textarea id="challenge-description" class="form-control" name="challenge_desc" rows="8" cols="4"><?php echo $challenge["challenge_desc"] ?? ""; ?></textarea>
                                                    </div>
													<?php if(!$editMode){?>
														<div class="form-group mb-4">
															<label class="control-label" for="file">Featured Image</label>
															<input type="file" class="form-control" id="file" name="file" placeholder="Choose Challenge image" />
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