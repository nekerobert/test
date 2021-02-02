<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
	/* Set Main Faq Routes*/
    	$route = "pages/faq";
   /* Faq Route Ends Here*/
	$errors = []; $status = false; $msg = ""; 
	$formUrl = generate_route($route, "manage");
	$formTitle = "Create New FAQ";
	if(isset($_GET['faq_id'])){
		$id = h(u($_GET["faq_id"]));
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
		$faq = sanitize_html($_POST);
		// N/B : Delete and Edit operation is handle using post request method also
		if(isset($_GET["mode"]) && isset($id)){
			// Mode is for performing either edit or delete operation
			switch ($_GET["mode"]) {
				case 'edit':
					// validate Data
                    $valResult = validate_data($faq, ['faq_title'=>'title'], 'csrf_token');
					// Id to used for updating record
					if(!$valResult){
						// No Errors Continue with Updating
						$data = find_data('page_datas',['id'],null," WHERE id =".merge_and_escape([$id],$db).' AND page_datas.title = "main_faq" ');
						// Confirm if record exist
						if($data){
                            $data["content"] = array_to_json($faq,"csrf_token");
                            $data["id"] = $id;
                            $status = update_data('page_datas',$data,'id');
							$msg = "FAQ Updated Successfully";
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
						$faqs = find_data('faqs',['id','title','date_created']);

					}
					
					break;

				case 'delete':
					// validate the existence of a record tied to the Id
                    $data = find_data('page_datas',['id'],null," WHERE id =".merge_and_escape([$id],$db).' AND page_datas.title = "main_faq" ');
					if($data){
						$status = delete_data('page_datas', [$id]);
						$msg = "FAQ deleted successfully";
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
			// Creating a new Faq is handle here
			// validate Data
			$valResult = validate_data($faq, ['faq_title'=>'title'], 'csrf_token');
			if(!$valResult){
				// No errors continue with insertion of data
                $data["content"] = array_to_json($faq,'csrf_token');
                $data["title"] = "main_faq";
                $status = insert_data('page_datas', $data);
				$msg = "Faq was created successfully";
				// Retrieve record to be displayed on the table again
				$faqs  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_faq" ORDER BY id desc');
			}else{
				// There is errors
				$errors = $valResult;
				// Retrieve record to be displayed on the table again
				$faqs  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_faq" ORDER BY id desc');
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
                        $faq = sanitize_html(json_to_array($data["content"]));
						$formUrl = generate_route($route, "edit",$id);
						$formTitle = "Edit Selected Faq";
						// repopulate table again
                        $faqs  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_faq" ORDER BY id desc', false);
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
			//display all faqs if any
            $faqs  = find_data('page_datas',["id","title","content","date_created"],null, 'WHERE title = "main_faq" ORDER BY id desc', false);
            
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
				<!--faq title start-->
				<div class="faq-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<div class="faq-breadcrumb">
									<h1 class="mb-3">FAQS Section</h1>
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
											Faqs
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--faq title end-->

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
												Manage Faqs (<i class="fa fa-book"></i>) 
											</div>
										</div>
							            <div class="card-body table-responsive">
                                        	<table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Questions</th>
                                                    <th>Answers</th>
													<th>Date Added</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Questions</th>
                                                    <th>Answers</th>
													<th>Date Added</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                              	<?php echo faq_table_component($faqs); ?>
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
											<label class="control-label" for="faq-title">Question Title</label>
											<input type="text" value="<?php echo $faq["faq_title"] ?? ""; ?> " class="form-control" id="faq-title" name="faq_title" placeholder="Enter new question">
											<?php 	// Display validation error if available  
												echo form_error_component($errors,'faq_title')
											?>
										</div>

                                        <div class="form-group">
                                            <label for="faq-answer">Answer Text</label>
                                            <textarea id="faq-answer" class="form-control" name="faq_answer" rows="5">
                                                <?php echo $faq["faq_answer"] ?? ""; ?>
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
			<?php echo display_delete_modal('FAQ Item'); ?>

<!-- include footer starts-->
<?php require_once(INCLUDES_PATH.'/admin/footer.inc.php');?>
<!-- include footer stops