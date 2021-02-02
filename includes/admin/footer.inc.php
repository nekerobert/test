<!-- Footer -->
		<footer class="footer ptb-20">
			<div class="row">
				<div class="col-md-12 text-center">
					  <!-- setting auto update copyright -->
					    <div class="copy_right">
					    <p>&copy;
					      <?php 
					        ini_set('date.timezone', 'Europe/London');
					        $startYear = 2020; //get start year
					        $thisYear = date('Y');//get the current year
					        if ($startYear == $thisYear) {
					          echo $startYear;
					        }else{
					          echo "{$startYear}-{$thisYear}";
					        }
					      ?> Admin by <a href="#"> Cleveland</a></p>
					    </div>
<!-- 					<div class="copy_right">
						<p>
							2018 © Dashboard By
							<a href="#">Cleveland</a>
						</p>
					</div> -->
					<a id="back-to-top" href="#"> <i class="ion-android-arrow-up"></i> </a>
				</div>
			</div>
		</footer>
		<!-- Footer_End -->
	</div>

	<?php require_once(INCLUDES_PATH.'/admin/scripts.inc.php'); ?>

	<script>
        $(document).ready(function () {
			console.log("Hello world");
			$("#bs4-table").DataTable();
			$('[data-toggle="tooltip"]').tooltip();
        });
	
    </script>

<!-- ckeditor script -->
<script>
    ClassicEditor
        .create( document.querySelector( '.editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>