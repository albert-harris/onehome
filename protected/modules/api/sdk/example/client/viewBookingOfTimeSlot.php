<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('inc/head.php') ?>
  <body>
    <?php include_once('inc/header.php') ?>
    <div class="container-fluid">
      <div class="row-fluid">
        <?php include_once('inc/sidebar.php') ?>        
        <div class="span9">
        		<div class="page-header">
                	<h1>Booking Of Time slot</h1>
              	</div>
            <h4>Type in appointment ID to view booking of timeslot OR leave blank to list all my time slots</h4>            
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="navbar-form pull-left" method="post">
                      <input name="appt_id" type="text" class="span5" value="<?php echo isset($_POST['appt_id']) ? $_POST['appt_id'] : '' ?>">
                  <button class="btn" type="submit">Submit</button>
                </form>
              </div>
            </div>
            <h2>Result</h2>                  
            <div class="well">                    
            <?php require_once('code/_viewBookingOfTimeSlot.php') ?>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>