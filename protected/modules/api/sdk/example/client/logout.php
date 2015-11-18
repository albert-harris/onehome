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
                   
                       
                  <h2>Result</h2>
                  
                  <div class="well">
                    
                  <?php require_once('code/_logout.php') ?>
                  </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
      </div><!--/row-->

      <hr>

     <?php include_once('inc/footer.php') ?>

    </div><!--/.fluid-container-->

    <?php include_once('inc/foot.php') ?>
  

</body></html>