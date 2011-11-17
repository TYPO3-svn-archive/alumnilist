<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Alumnus' => 'list, filteredList, new, create, edit, update, delete, show',
		'Year' => 'list, show',
		'Course' => 'list, show',
		'AlumnusChecksum' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Alumnus' => 'filteredList, create, update, delete, ',
		'Year' => '',
		'Course' => '',
		'AlumnusChecksum' => 'create, update, delete',
		
	)
);

?>