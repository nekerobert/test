
<!-- include headers starts-->
<?php 
include('includes/header.inc.php');
include('includes/sidebar.inc.php');
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
                                        <h1>Manage Gallery</h1>
                                    </div>
                                </div>
                                <div class="col-md-6 justify-content-md-end d-flex">
                                    <div class="breadcrumb_nav">
                                        <ol class="breadcrumb">
                                            <li>
                                                <i class="fa fa-image"></i>
                                                <a class="parent-item" href="#">Gallery</a>
                                                <i class="fa fa-angle-right"></i>
                                            </li>
                                            <li class="active">
                                                Manage Gallery
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
                            <div class=" col-sm-12">
                                <div class="card card-shadow mb-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            Gallery Tables
                                        </div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGalleryModal" data-whatever="@mdo">Add Gallery</button>
                                    </div>
                                    <div class="card-body">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Image Title</th>
                                                    <th>Section</th>
                                                    <th>Date Added</th>
                                                    <th>Date Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Title</th>
                                                    <th>Section</th>
                                                    <th>Date Added</th>
                                                    <th>Date Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info">View</button>
                                                        <button type="button" class="btn btn-success">Edit</button>
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- state end-->
                    </div>

                </main>
                <!--main contents end-->
            <!-- </div> -->
        
        <!-- Content_right_End -->


        <!-- modal starts -->
                        <div class="col-xl-4  col-lg-6">
                            <div class="card card-shadow mb-4">
                                <div class="card-body">

                                    <div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Gallery: </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form >
<!--                                         <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="fname" name="fname">Image Title: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Provide image title" />
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="fname" name="fname">Section: </label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="inputGroupSelect01">
                                                <option selected>Select Section</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                </select>
                                                </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="gimg" class="col-form-label">Gallery Image:</label>
                                                <input type="file" multiple class="form-control" id="gimg" name="gimg" placeholder="Choose gallery image" />
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Add Gellery</button>
                                        </div>
                                            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        <?php include('includes/footer.inc.php'); ?>