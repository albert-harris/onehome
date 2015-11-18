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
                	<h1>Login with 65doctor</h1>
              	</div>
                   
            <div class="navbar">
              <div class="navbar-inner">
                  <form class="navbar-form pull-left" method="post">
                            <label>Email</label>
                            <input name="email" type="text" class="span6" style="width: 200px">
                            <label>Password</label>
                            <input name="password" type="password" class="span6" style="width: 200px">
                            <br>
                  <button class="btn" type="submit">Submit</button>
                        <br>
                      <br>
                </form>
              </div>
            </div>
            
                  <h2>Result</h2>
                  
                  <div class="well">
                    
                  <?php require_once('code/_login.php') ?>
                  </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>