<h2>Create Receipt For Transaction: <?php echo $mTrans->transactions_no; ?></h2>

<?php echo $this->renderPartial('receipt/_form', array('model'=>$model, 'mTrans'=>$mTrans)); ?>