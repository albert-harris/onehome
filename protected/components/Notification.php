<?php
/**
 * Show error/success message
 *
 * @author Lam Huynh
 */
class Notification extends CWidget {

	public function run() {
		if ($flashes = Yii::app()->user->getFlashes()): ?>
			<?php foreach($flashes as $type => $message): ?>
			<?php $type = $type=='error' ? 'danger' : $type ?>
			<div class="text-center alert alert-<?= $type ?>" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<?= $message ?>
			</div>			
			<?php endforeach; ?>
		<?php endif;
	}
}
