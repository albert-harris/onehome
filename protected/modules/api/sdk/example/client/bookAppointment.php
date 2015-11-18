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
                	<h1>Book Appointment</h1>
              	</div>
            <!--<h4></h4>-->            
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                      <div class="control-group">
                          <label class="control-label" for="id">id (Time slot ID)</label>
                          <div class="controls">
                              <input name="id" id="id" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="i_am_the_patient">i_am_the_patient</label>
                          <div class="controls">
                              <input name="i_am_the_patient" id="i_am_the_patient" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">patient_name</label>
                          <div class="controls">
                              <input name="patient_name" id="patient_name" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="use_my_contact">use_my_contact</label>
                          <div class="controls">
                              <input name="use_my_contact" id="use_my_contact" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="country_code">country_code</label>
                          <div class="controls">
                              <input name="country_code" id="country_code" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="patient_mobile">patient_mobile</label>
                          <div class="controls">
                              <input name="patient_mobile" id="patient_mobile" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="patient_email">patient_email</label>
                          <div class="controls">
                              <input name="patient_email" id="patient_email" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="i_am_a_new_patient">i_am_a_new_patient</label>
                          <div class="controls">
                              <input name="i_am_a_new_patient" id="i_am_a_new_patient" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="note_to_doctor">note_to_doctor</label>
                          <div class="controls">
                              <input name="note_to_doctor" id="note_to_doctor" type="text" class="span10">
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
            <?php require_once('code/_bookAppointment.php') ?>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>