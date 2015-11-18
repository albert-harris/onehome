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
                	<h1>Add Time slot</h1>
              	</div>
            <!--<h4>Type in datetime (Format: 2013-01-02 12:09:01) to add time slot</h4>-->            
            <div class="navbar">
              <div class="navbar-inner">
<!--                  <form class="navbar-form pull-left" method="post">
                    <input name="datetime" type="text" class="span5">
                  <button class="btn" type="submit">Submit</button>
                </form>-->
                  
                  <form class="form-horizontal" method="post">
                      <fieldset>
                          <legend>Test POST Params</legend>
                      <div class="control-group">
                          <label class="control-label" for="datetime">datetime (Format: 2013-01-02 12:09:01)</label>
                          <div class="controls">
                              <input name="datetime" id="datetime" type="text" value="<?php if(isset($_POST['datetime'])) echo $_POST['datetime']; else echo ''; ?>" class="span10">
                          </div>
                      </div>
                          
                      <div class="control-group">
                          <label class="control-label" for="address_id">address_id</label>
                          <div class="controls">
                              <input name="address_id" id="address_id" type="text" value="<?php if(isset($_POST['address_id'])) echo $_POST['address_id']; else echo ''; ?>" class="span10">
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
            <?php require_once('code/_addTimeSlot.php') ?>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>