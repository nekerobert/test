<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	/* Set Main usercontact Routes*/
    	$route = "pages/contact-us/sections/usercontact";
   /* usercontact Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$formUrl = generate_route($route, "manage");
	$formTitle = "Create A New User Contact";
	if(isset($_GET['usercontact_id'])){
		$id = h(u($_GET["usercontact_id"]));
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
		$usercontact = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					// validate Data
                    $valResult = validate_data($usercontact, ['user_firstname'=>'title'], 'csrf_token');
					// Id to used for updating record
					if(!$valResult){
						// No Errors Continue with Updating
						$data = find_data('page_datas',['id'],null," WHERE id =".merge_and_escape([$id],$db).' AND page_datas.title = "main_usercontact" ');
						// Confirm if record exist
						if($data){
                            $data["content"] = array_to_json($usercontact,"csrf_token");
                            $data["id"] = $id;
                            $status = update_data('page_datas',$data,'id');
							$msg = "User Contact Updated Successfully";
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
						$usercontacts = find_data('page_datas',['id','title','content','date_created']);

					}
					
					break;

				case 'delete':
					// validate the existence of a record tied to the Id
                    $data = find_data('page_datas',['id'],null," WHERE id =".merge_and_escape([$id],$db).' AND page_datas.title = "main_usercontact" ');
					if($data){
						$status = delete_data('page_datas', [$id]);
						$msg = "Usercontact deleted successfully";
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
					# code...
					break;
			}
		}else{
			// Creating a new Fusercontact is handle here
			// validate Data
			$valResult = validate_data($usercontact, ['user_firstname'=>'title'], 'csrf_token');
			if(!$valResult){
				// No errors continue with insertion of data
                $data["content"] = array_to_json($usercontact,'csrf_token');
                $data["title"] = "main_usercontact";
                $status = insert_data('page_datas', $data);
				$msg = "Usercontact was created successfully";
				// Retrieve record to be displayed on the table again
				$usercontacts  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_usercontact" ORDER BY id desc');
			}else{
				// There is errors
				$errors = $valResult;
				// Retrieve record to be displayed on the table again
				$usercontacts  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_usercontact" ORDER BY id desc');
			}

		}

	}else{
		//Get Request
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					$data = find_data_by_id('page_datas',['content'],$id);
					if($data){
                        $usercontact = sanitize_html(json_to_array($data["content"]));
						$formUrl = generate_route($route, "edit",$id);
						$formTitle = "Edit Selected Usercontact";
						// repopulate table again
                        $usercontacts  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_usercontact" ORDER BY id desc', false);
					}else{
						cookie_message("Sorry request Failed. Try again", false);
						redirect_to(generate_route($route, "manage"));
					}
					
					# code...
                    break;
                default:
                redirect_to(generate_route($route, "manage"));
			}
			
		}else{
			//display all usercontacts if any
            $usercontacts  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_usercontact" ORDER BY id desc', false);
            
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
				<!--usercontact title start-->
				<div class="usercontact-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="usercontact-breadcrumb">
									<h1 class="mb-3">User Conact</h1>
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
											Contact Us
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--usercontact title end-->

				<div class="container-fluid">
					<?php echo display_status_message($status, $msg); ?>
					<!-- state start-->
					<div class="row">
						<!-- table starts -->
						<div class="col-sm-12 col-md-12 col-lg-8 col-xs-12 col-xl-8">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-shadow mb-4">
										<div class="card-header bg-info ">
											<div class="card-title text-white">
												Manage User Contact (<i class="fa fa-book"></i>) 
											</div>
										</div>
							            <div class="card-body table-responsive">
                                        	<table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email Address</th>
                                                    <th>Message</th>
													<th>Date Added</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email Address</th>
                                                    <th>Message</th>
													<th>Date Added</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                              	<?php echo usercontact_table_component($usercontacts); ?>
                                            </tbody>
                                        </table>
                                    </div>
									</div>
								</div>
							</div>
						</div>
						<!-- table ends -->

						<!-- form statrts -->

						<div class="col-sm-12 col-md-12 col-lg-4 col-xs-12 col-xl-4">
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
											<label class="control-label" for="user-firstname">First Name</label>
											<input type="text" value="<?php echo $usercontact["user_firstname"] ?? ""; ?> " class="form-control" id="user-firstname" name="user_firstname" placeholder="Enter First Name">
											<?php 	// Display validation error if available  
												echo form_error_component($errors,'user_firstname')
											?>
										</div>
                                        <div class="form-group mb-3">
											<label class="control-label" for="user-emailaddr">Email Address</label>
											<input type="email" value="<?php echo $usercontact["user_emailaddr"] ?? ""; ?> " class="form-control" id="user-emailaddr" name="user_emailaddr" placeholder="Eg: johndoe@gmail.com">
										</div>
                                        <div class="form-group">
                                            <label for="feedback-msg">Message</label>
                                            <textarea id="feedback-msg" class="form-control" name="feedback_msg" rows="5">
                                                <?php echo $usercontact["feedback_msg"] ?? ""; ?>
                                            </textarea>
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
			<?php echo display_delete_modal('User Contact'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>
<!-- include footer stops