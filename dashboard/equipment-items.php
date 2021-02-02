<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	 /* Set Main Page Routes*/
	 $route = "pages/home/sections/equipment-items";
	 /* Page Route Ends Here*/
	 /* variables Initialization  begins*/
	 $errors = []; $status = false; $msg = ""; 
	  $editMode = false;
	  $formUrl = generate_route($route, "manage");
	  $formTitle = "Upload Equipment File(s)";

	   /*variables Initialization ends*/
	if(isset($_GET['item_id'])){
        $id = h(u($_GET["item_id"]));
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
		$item = sanitize_html($_POST);

		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			$formTitle = "Edit Equipment Item";
			switch ($_GET["mode"]) {
				case 'editFile':
					
					// User issued a delete request when the url is still carrying edit endpoint
					if(!isset($_FILES["file"])){
						cookie_message("Error occured. Please try again", false);
						redirect_to(generate_route($route,"manage"));
					}
					
					$editMode = true;
					$msg = "Equipment file update failed. Please try again"; //Default message to be displayed if update fails
					// Retrieve record to be deleted, and advert data to be render again on the form
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE  page_datas.title = 'home-equipment-item' AND page_datas.id = ".merge_and_escape([$id],$db).'LIMIT 1 ',false);
					if($data){
						$result = upload_file($_FILES["file"]);
						if($result["mode"]){
							$data = json_to_array($data["content"]); 
							$result["id"] = $id;
							$result["date_updated"] = date('Y-m-d H:i:s');
							$item["image"] = $data["path"];
							if(!unlink(UPLOAD_PATH.'/'.$data["path"])){// Delete the previous file
								// Error occured while deleting file
								cookie_message($msg, $status);
								redirect_to(generate_route($route,"manage"));
							}
							
							$result["content"] = array_to_json(["path"=> $result["path"]]); 
							$result = regenerate_with_required($result, 'id,content,date_updated');
								// Update data
							update_data('page_datas', $result,'id');
							$status = true;
							// update the previous slider path to the updated food path
							// $item["image"] = $result["path"];
							// $item["file_id"] = $result["id"];
							$msg = "Equipment was updated succesfully";
							cookie_message($msg, $status);
							redirect_to(generate_route($route,"manage"));
						}else{
							// Errors occured while uploading file
							// Display Errors to the user
							$errors = $result;
							$path = json_to_array($data["content"]); 
							$item["image"] = h($path["path"]);
							$item["id"] = h($data["id"]);
							$item["file_id"] = $id;
							$editMode = true; 
							$formUrl = generate_route($route, "edit", $item["id"]);
							$items  = find_data('page_datas',['page_datas.id','content','page_datas.date_created'],' WHERE  page_datas.title = "home-equipment-item" ORDER BY id desc', false);
						}

					}else{
						// User tempered with the record Id 
						$msg = "Sorry file update was not successful. Please try again";
						$status = false;
						cookie_message($msg, $status);
						redirect_to(generate_route($route, "manage"));
					}
					
				break;

				case "deleteFile":
					// Retrieve the file to be delete
					$msg = "Error occured while deleting file. Please try again";
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE page_datas.title ='home-equipment-item' AND page_datas.id = ".merge_and_escape([$id],$db)." LIMIT 1",false);
					if($data){
						// Delete the file from directory
						$path = json_to_array($data["content"]);
						if(!unlink(UPLOAD_PATH.'/'.$path["path"])){
							cookie_message($msg,false);
							redirect_to(generate_route($route,"manage"));
						}
						$status = delete_data('page_datas', [$id]);
						$msg = "Equipment File deleted successfully";
						// Set cookie message here
						cookie_message($msg, true);
						redirect_to(generate_route($route,"manage"));
					}else{
						$msg = "Sorry request failed. Please Try again ";
						// Set cookie message
						cookie_message($status, false);
						redirect_to(generate_route($route, "manage"));
					}
					break;
					
					default:
					// Mode has no specified case under the request type
					redirect_to(generate_route($route,"manage"));
			}
		}else{

			// validate Data
			//Upload new files File
				$files = $_FILES["file"];

				$result = upload_file($files, true,"home-equipment-item");

				if($result["mode"]){
					// No errors and remove the mode key
					unset($result["mode"]);
					insert_multiple_data("page_datas",$result);
					$msg = "Equipment files uploaded successfully";
					cookie_message($msg, true);
					redirect_to(generate_route($route, "manage"));
				
				}else{
					// Errors occured while uploading file
					$errors = $result;
					$items  = find_data('page_datas',['page_datas.id','content','page_datas.date_created'],' WHERE  page_datas.title = "home-equipment-item" ORDER BY id desc', false);
				}
			}
	}else{
		//display all Files on the table
		// home-equipment-item
		if(isset($_GET["mode"]) && isset($id)){
			switch ($_GET["mode"]) {
				case "editFile":
					$editMode = true;
					$data  = find_data('page_datas',['page_datas.id','content']," WHERE  page_datas.title = 'home-equipment-item' AND page_datas.id = ".merge_and_escape([$id],$db).'LIMIT 1 ',false);
					if($data){
						$data = json_to_array($data["content"]); 
						$item["file_id"] = $id;
						$item["image"] = $data["path"];
						$formUrl = generate_route($route, "edit", $id);
						$formTitle = "Edit Equipment File";
					}else{
						$msg = "Sorry Request failed. Please select equipment and try again";
						cookie_message($msg, false);
						redirect_to(generate_route($route, "manage"));
					}
					break;

				default:
					redirect_to(generate_route($route, "manage"));
			}

		}


		$items  = find_data('page_datas',['page_datas.id','content','page_datas.date_created'],' WHERE  page_datas.title = "home-equipment-item" ORDER BY id desc', false);
	}


?>

<?php 
	require_once(INCLUDES_PATH.'/admin/header.inc.php');
	require_once(INCLUDES_PATH.'/admin/sidebar.inc.php');
?>

<!-- include headers stops -->

			<!--main contents start-->
			<main class="content_wrapper" >
				<!--page title start-->
				<div class="page-heading">
					<div class="container-fluid">
						<?php 
							echo display_status_message($status, $msg); //Display status success/failure message
							
							echo display_multiple_errors($errors); //Display errors while uploading files
						
						?>
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="page-breadcrumb">
									<h1>Manage Home Equipment</h1>
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
											Home Equipment
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
						<!-- table starts -->
						<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 col-xl-6">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Home Equipment Image Table
											</div>
										</div>
							          <div class="card-body table-responsive">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Equipment Image</th>
                                                    <th>Date Added</th>
                                                    <th></th>
													<th></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                     <th>S/N</th>
                                                    <th>Equipment Image</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
													<th></th>
													<th></th>
                                                </tr>
                                            </tfoot>
											<tbody>
												<?php echo equipment_table_component($items);?>
											</tbody>
                                            
                                        </table>
                                    </div>
									</div>
								</div>
							</div>
						</div>
						<!-- table ends -->

						<!-- form statrts -->
						<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 col-xl-6">
							<div class="row">
								<div class="col-md-12">
									<div class="card  border-info lobicard-custom-control lobi-light  mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												<?php echo $formTitle; ?>
											</div>
										</div>
										<div class="card-body">
											<form id="form" method="post" class=" right-text-label-form feedback-icon-form" action="<?php echo $formUrl?>" enctype="multipart/form-data">
												<?php if($editMode){ ?>
													<div class="slider-img mb-2">
														<img class="img-fluid" src="<?php echo full_upload_url($item["image"]); ?>" alt="Health item Image">
														<span title="Change Health item Image" data-toggle="toolitem" class="update-icon"><i class="fa fa-pencil"></i></span>
													</div>
												<?php } ?>
												<div class="form-group <?php echo ($editMode) ? "d-none":"";?> mt-3" id="fileBox">
													<input id="file" <?php echo ($editMode) ? "":"multiple";?> class="form-control mb-3" type="file" name="<?php echo ($editMode) ? 'file':'file[]';?>">
													<?php if($editMode){?>
														<div class="control row d-flex justify-content-between">
															<button type="button" class="btn btn-danger btn-md text-white"><i class="fa fa-times"> Cancel</i></button>
															<button type="submit" class="btn btn-info btn-md"><i class="fa fa-rocket"> Update Image</i></button>
														</div>
													<?php } ?>
												</div>
												<?php if(!$editMode){ //Upload Files?>
													<div class="form-group text-center form-row">
														<div class="col-sm-4 mb-sm-2"><button type="submit" class="btn btn-block p-3 btn-info">Submit</button></div>
														<div class="col-sm-4"><input id="reset" type="reset" value="Reset" class="btn p-3 btn-block btn-danger"/></div>
													</div>
												<?php } ?>
												<?php echo csrf_token_tag();?>
											</form>
										</div>
									</div>
								</div>
								</div>
								</div>
								</div>
							</div>
						</div>
						<!-- form ends -->
					</div>
					<!-- state end-->

				</div>
			</main>
			<!--main contents end-->
	
	<?php echo display_delete_modal("Equpiment Item");?>

<!-- include footer starts-->
<?php 
 require_once(INCLUDES_PATH.'/admin/footer.inc.php');
?>
<!-- include footer stops