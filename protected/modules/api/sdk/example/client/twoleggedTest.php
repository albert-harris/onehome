<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('inc/head.php'); ?>

  <body>

    <?php include_once('inc/header.php'); ?>

    <div class="container-fluid">
      <div class="row-fluid">
        <?php include_once('inc/sidebar.php'); ?>
        
        <div class="span9">
        		<div class="page-header">
                	<h1>65doctor Two-legged Test</h1>
              	</div>
            <?php if(!empty($_GET['action']) && $_GET['action'] == 'doctorInfo')
{ ?>
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id"  value="<?php if(isset($_POST['doctor_id'])) echo $_POST['doctor_id']; else echo '532'; ?>" type="text" class="span10">
                          </div>
                      </div>                          
                     
                      <div class="control-group">
                          <label class="control-label" for="lang">lang (language)</label>
                          <div class="controls">
                              <input name="lang" id="lang" type="text" class="span10" value="<?php if(isset($_POST['lang'])) echo $_POST['lang']; else echo 'en'; ?>">
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
<?php } ?>
            
            <?php if(!empty($_GET['action']) && $_GET['action'] == 'timslots')
{ ?>
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id"  value="<?php if(isset($_POST['doctor_id'])) echo $_POST['doctor_id']; else echo '532'; ?>" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="date">date (format: 2013-05-24)</label>
                          <div class="controls">
                              <input name="date" id="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; else echo '2013-05-24'; ?>" type="text" class="span10">
                          </div>
                      </div>                       
                   
                              
                      <div class="control-group">
                          <label class="control-label" for="lang">lang (language)</label>
                          <div class="controls">
                              <input name="lang" id="lang" type="text" class="span10" value="<?php if(isset($_POST['lang'])) echo $_POST['lang']; else echo 'en'; ?>">
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
<?php } ?>
            <?php if(!empty($_GET['action']) && $_GET['action'] == 'timeslotsinrange')
{ ?>
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                      <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id"  value="<?php if(isset($_POST['doctor_id'])) echo $_POST['doctor_id']; else echo '532'; ?>" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="date_from">date from (format: 2013-07-24)</label>
                          <div class="controls">
                              <input name="date_from" id="date" value="<?php if(isset($_POST['date_from'])) echo $_POST['date_from']; else echo '2013-07-24'; ?>" type="text" class="span10">
                          </div>
                      </div>           
                          
                      <div class="control-group">
                          <label class="control-label" for="date_to">date to (format: 2013-08-24)</label>
                          <div class="controls">
                              <input name="date_to" id="date" value="<?php if(isset($_POST['date_to'])) echo $_POST['date_to']; else echo '2013-08-24'; ?>" type="text" class="span10">
                          </div>
                      </div>                       
                   
                              
                      <div class="control-group">
                          <label class="control-label" for="lang">lang (language)</label>
                          <div class="controls">
                              <input name="lang" id="lang" type="text" class="span10" value="<?php if(isset($_POST['lang'])) echo $_POST['lang']; else echo 'en'; ?>">
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
<?php } ?>
            
                        <?php if(!empty($_GET['action']) && $_GET['action'] == 'search')
{ ?>
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                          
                          <div class="control-group">
                          <label class="control-label" for="doctor_id">doctor_id</label>
                          <div class="controls">
                              <input name="doctor_id" id="doctor_id"  value="<?php if(isset($_POST['doctor_id'])) echo $_POST['doctor_id']; else echo '532'; ?>" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="specialty">specialty</label>
                          <div class="controls">
                              <input name="specialty" id="specialty"  value="<?php if(isset($_POST['specialty'])) echo $_POST['specialty']; else echo '45'; ?>" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="hospital">hospital</label>
                          <div class="controls">
                              <input name="hospital" id="hospital" value="<?php if(isset($_POST['hospital'])) echo $_POST['hospital']; else echo ''; ?>" type="text" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="insurance">insurance</label>
                          <div class="controls">
                              <input name="insurance" id="insurance" type="text" class="span10" value="<?php if(isset($_POST['insurance'])) echo $_POST['insurance']; else echo ''; ?>">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="appointment_today">appointment_today (1 or null)</label>
                          <div class="controls">
                              <input name="appointment_today" id="appointment_today" type="text" class="span10" value="<?php if(isset($_POST['appointment_today'])) echo $_POST['appointment_today']; else echo ''; ?>">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="male_doctor">male_doctor (1 or null)</label>
                          <div class="controls">
                              <input name="male_doctor" id="male_doctor" type="text" class="span10" value="<?php if(isset($_POST['male_doctor'])) echo $_POST['male_doctor']; else echo ''; ?>">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="female_doctor">female_doctor (1 or null)</label>
                          <div class="controls">
                              <input name="female_doctor" id="female_doctor" type="text" class="span10" value="<?php if(isset($_POST['female_doctor'])) echo $_POST['female_doctor']; else echo ''; ?>">
                          </div>
                      </div>
                          
                              
                      <div class="control-group">
                          <label class="control-label" for="doctor_clinic">doctor_clinic</label>
                          <div class="controls">
                              <input name="doctor_clinic" id="doctor_clinic" type="text" class="span10" value="<?php if(isset($_POST['doctor_clinic'])) echo $_POST['doctor_clinic']; else echo ''; ?>">
                          </div>
                      </div>
                              
                      <div class="control-group">
                          <label class="control-label" for="lang">lang (language)</label>
                          <div class="controls">
                              <input name="lang" id="lang" type="text" class="span10" value="<?php if(isset($_POST['lang'])) echo $_POST['lang']; else echo 'en'; ?>">
                          </div>
                      </div>
                              
                    
                        <h3>Time slot Date</h3>
                        
                         
                      <div class="control-group">
                          <label class="control-label" for="date">date (format: 2013-05-24)</label>
                          <div class="controls">
                              <input name="date" id="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; else echo '2013-05-24'; ?>" type="text" class="span10">
                          </div>
                      </div>   
                          
                      <div class="control-group">
                          <label class="control-label" for="date_from">date from (format: 2013-07-24)</label>
                          <div class="controls">
                              <input name="date_from" id="date" value="<?php if(isset($_POST['date_from'])) echo $_POST['date_from']; else echo '2013-07-24'; ?>" type="text" class="span10">
                          </div>
                      </div>           
                          
                      <div class="control-group">
                          <label class="control-label" for="date_to">date to (format: 2013-08-24)</label>
                          <div class="controls">
                              <input name="date_to" id="date" value="<?php if(isset($_POST['date_to'])) echo $_POST['date_to']; else echo '2013-08-24'; ?>" type="text" class="span10">
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
<?php } ?>
                  <h2>Result</h2>
                  
                  <div class="well">
                    
                  <?php require_once('code/_twoleggedTest.php'); ?>
                  </div>
        </div>
        
        
        