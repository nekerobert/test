

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
                                        <h1>Manage News</h1>
                                    </div>
                                </div>
                                <div class="col-md-6 justify-content-md-end d-flex">
                                    <div class="breadcrumb_nav">
                                        <ol class="breadcrumb">
                                            <li>
                                                <i class="fa fa-question-circle"></i>
                                                <a class="parent-item" href="#">News</a>
                                                <i class="fa fa-angle-right"></i>
                                            </li>
                                            <li class="active">
                                                Manage News
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
                                            Manage News Tables
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>News Title</th>
                                                    <th>News Body</th>
                                                    <th>Image</th>
                                                    <th>Date Uploaded</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                   <th>S/N</th>
                                                    <th>News Title</th>
                                                    <th>News Body</th>
                                                    <th>Image</th>
                                                    <th>Date Uploaded</th>
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
                                                        <a href="#">
                                                            <button type="submit" class="btn btn-info" name="edit">View</button></a>
                                                            <button type="submit" class="btn btn-success" name="edit">Edit</button></a>
                                                             <a href="#">
                                                            <button type="submit" class="btn btn-danger" name="delete" >Delete</button></a>
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

                            <!-- Prepare to delete Modal -->
                            <div class="modal fade" id="confirm_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <input type="hidden" name="delet_id" id="delet_id"> -->
                                          <h3 class="danger" style="color: red">CAUSION!!</h3><br>
                                          <p>Are you sure you want to permanently delete this record?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" name="delete_record">Delete Record</button>
                                             <a href="includes/faq.inc.php?delete=<?php echo $row['Id']; ?>">
                                            <button type="button" class="btn btn-danger" id="delete" name="delete">Delete Record</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <!-- prepare to delete modal ends -->
                <!--main contents end-->
            <!-- </div> -->
        
        <!-- jQuery Delete Record Starts -->
<script>
    $(document).ready(function() {
        $('.confirm_delete').on('click', function() {
            $('#confirm_delete_modal').modal('show');

            // $tr = $(this).closest('tr');

            // var data = $tr.children("td").map(function()).get();

            // console.log(data);
            // $('#delete'.val(data[0]));
        });
    });

</script>
        <!-- jQuery Delete Record ends -->
        <!-- Content_right_End -->
<?php include('includes/footer.inc.php'); ?>