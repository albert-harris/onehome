<?php
/* @var $current int */
?>
<div class="row service-reg-steps">
	<div class="col-md-4 reg-step <?= $current==1 ? 'active' : '' ?>">
		<div class="step-no">1</div> <h2>GET STARTED</h2>
		<p>Enter your personal &amp; property information</p>
	</div>
	
	<div class="col-md-4 reg-step <?= $current==2 ? 'active' : '' ?>">
		<div class="step-no">2</div> <h2>SERVICES</h2>
		<p>Show default they are in and let them</p>
	</div>
	
	<div class="col-md-4 reg-step <?= $current==3 ? 'active' : '' ?>">
		<div class="step-no">3</div> <h2>CONFIRMATION</h2>
		<p>Review your summary</p>
	</div>
</div>
