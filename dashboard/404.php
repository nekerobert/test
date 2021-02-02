<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once(INCLUDES_PATH.'/admin/head.inc.php'); ?>

<body class="bg_darck">
  <div class="container body">
    <div class="main_container">
      <!-- page content -->
      <div class="col-md-12">
        <div class="col-middle">
          <div class="text-center">
            <h1 class="error-number">404</h1>
            <h2 class="color_white">Sorry but we couldn't find this page</h2>
            <p class="color_white">This page you are looking for does not exist
              <a href="#">Report this?</a>
            </p>
            <p>You may wish to logout and signin again to continue!
              <a href="<?php echo DASHBOARD_PATH.'logout'?>"> Click here to Logout.</a>
          </p>
            <div class="mid_center">
              <h3 class="color_white">Search</h3>
              <form>
                <div class="col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
    </div>
  </div>
  <!-- jQuery -->
  <?php require_once(INCLUDES_PATH.'/admin/scripts.inc.php'); ?>
</body>


</html>
