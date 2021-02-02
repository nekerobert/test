
<!-- include headers starts-->
<?php 
include('includes/header.inc.php');
include('includes/sidebar.inc.php');
?>
<!-- include headers stops -->


                <!--main contents start-->
                <main class="content_wrapper">
                <!-- session message starts -->
                
                    <!--page title start-->
                    <div class="page-heading">
                        <div class="container-fluid">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="page-breadcrumb">
                                        <h1>Manage Contact</h1>
                                    </div>
                                </div>
                                <div class="col-md-6 justify-content-md-end d-flex">
                                    <div class="breadcrumb_nav">
                                        <ol class="breadcrumb">
                                            <li>
                                                <i class="fa fa-question-circle"></i>
                                                <a class="parent-item" href="#">Contact Us</a>
                                                <i class="fa fa-angle-right"></i>
                                            </li>
                                            <li class="active">
                                                Manage Contact
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
                                    <div class="card-body">
                                        <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Date Submitted</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Date Submitted</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php 
                                                $query = "SELECT * FROM tb_faq ORDER BY Id DESC;";
                                                $result = mysqli_query($conn, $query);
                                                confirmQuery($result);
                                                $count = 1;
                                                // loop through the faq result set
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['Question']; ?></td>
                                                    <td><?php echo $row['Answer']; ?></td>
                                                    <td><?php echo $row['DateUploaded']; ?></td>
                                                    <td><?php echo $row['DateUploaded']; ?></td>
                                                    <td>

                                              
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewContactModal" data-whatever="@mdo">View</button>
                                                 <!--    <button type="submit" class="btn btn-info editcontactbtn" name="editfaq" id="editId">Edit</button> -->

                                                     <button type="submit" class="btn btn-danger confirmDelete" name="delete">Delete</button>

                                                         <!--     <a href="includes/faq.inc.php?delete=<?php echo urlencode($row['Id']); ?>" onclick = "return confirm('Are you sure you want to permanently delete this record?')">
                                                            <button type="submit" class="btn btn-danger" name="delete" >Delete</button></a> -->
                                             
                                                             <!-- <button type="button" class="btn btn-danger confirm_delete"> Delete</button> -->
                                                            <!--   <button type="button" class="btn btn-danger confirm_delete" data-toggle="modal" data-target="#confirm_delete"> Delete</button> -->
                                                    </td>
                                                </tr>
                                            <?php $count++;
                                            endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- state end-->
                    </div>

                </main>

<!-- modal starts -->
                        <div class="col-xl-4  col-lg-6">
                            <div class="card card-shadow mb-4">
                                <div class="card-body">

                                    <div class="modal fade" id="viewContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Contact Us</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                         <form method="POST" action="includes/faq.inc.php">
                                            <input type="hidden" name="editId" value="<?php echo $editId; ?>">
                                        <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="ques" name="ques">First Name: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="question" name="question" value="<?php echo $question; ?>" placeholder="Provide your name here" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="ques" name="ques">Email: </label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="question" name="question" value="<?php echo $question; ?>" placeholder="Provide your email address here" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="answer" name="answer">Message</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="answer" name="answer" placeholder="Provide your messasge here"><?php echo $answer; ?></textarea>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="addfaq" value="addfaq">Delete</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!-- modal ends -->


                            <!-- Prepare to delete Modal -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <form method="POST" action="includes/faq.inc.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="deleteId" id="deleteId">
                                          <h3 class="danger" style="color: red">CAUSION!!</h3><br>
                                          <p>Are you sure you want to permanently delete this record?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <!--   <button type="button" class="btn btn-danger" name="delete_record">Delete Record</button> -->
                                            <!-- <a href="includes/faq.inc.php?delete=<?php echo $row['Id']; ?>"> -->
                                            <button type="submit" class="btn btn-danger" name="deletefaq">Delete Record</button><!-- </a> -->
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                <!-- prepare to delete modal ends -->
                <!--main contents end-->
            <!-- </div> -->

<!-- jQuery hide message alert -->
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.alert').hide();
        },3000);
    })
</script>

<!-- <script>
        setTimeout(function(){
          let alert = document.querySelector('.alert');
          alert.remove();
        },3000);
</script> -->

<!-- jQuery Edit record -->
<!-- <script>
    $(document).ready(function(){
        // e.preventDefault();
        $('.editbtn').on('click', function(){
            // this.update = true;
            $('#faqModal').modal('show');
            $tr = $(this).closest('tr');
           var data = $tr.children("td").map(function(){
            return $(this).text();
           }).get();

            console.log(data);
            // var result = data.keys();
            // $.each(result, function(key, value){
            $('#editId').val(data[0]);
            $('#question').val(data[1]);
            $('#answer').val(data[2]);
            // $('#dataUpdated').val(data[3]);
            // });
        });
    });
</script> -->

<!-- jQuery Delete Record Starts -->
<script>
    $(document).ready(function() {
        $('.confirmDelete').on('click', function() {
            $('#confirmDeleteModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
            return $(this).text();
           }).get();

            console.log(data);
            $('#deleteId').val(data[0]);
        });
    });

</script>
        <!-- jQuery Delete Record ends -->
        <!-- Content_right_End -->
<?php include('includes/footer.inc.php'); ?>