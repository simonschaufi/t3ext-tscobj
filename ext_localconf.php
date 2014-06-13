<?php
	if (!defined ('TYPO3_MODE')) {
		die ('Access denied.');
	}
	
	// Add plugin
	t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_tscobj_pi1.php','_pi1','list_type',1);
?>
