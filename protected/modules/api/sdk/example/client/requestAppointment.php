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
                	<h1>Request Appointment</h1>
              	</div>
            <!--<h4></h4>-->            
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                                              
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <div class="controls">
                              <button class="btn" type="submit">Submit</button>
                          </div>
                      </div>
                      </fieldset>
                </form>
              </div>
            </div>
            <h2>Result</h2>                  
            <div class="well">                    
            <?php require_once('code/_requestAppointment.php') ?>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>