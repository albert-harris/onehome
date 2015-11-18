<?php

/**
 * Sync listing from remote site
 *
 * @author Lam
 */
class CrawlCommand extends CConsoleCommand {

	public function run($args) {
		$m = new ListingSynchronizer();
		$m->run();
	}

}
