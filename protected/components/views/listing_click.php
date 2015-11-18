<?php
/* @var $model Listing */
$users = $model->getContactClickedUsers();
?>
<?php if (count($users)): ?>
<a href="#listing-click-<?= $model->id ?>" role="button" class="" data-toggle="modal"><?= $model->owner_contact_click ?></a>
 
<!-- Modal -->
<div id="listing-click-<?= $model->id ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-body">
		<ol>
			<?php foreach($users as $user): ?>
			<li><?= $user->name_for_slug ?></li>
			<?php endforeach ?>
		</ol>
	</div>
</div>
<?php endif ?>