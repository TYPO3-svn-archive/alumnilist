<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_alumnilist_domain_model_year'] = array(
	'ctrl' => $TCA['tx_alumnilist_domain_model_year']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, year, courses, alumni, page',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, year, courses, alumni, page,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_alumnilist_domain_model_year',
				'foreign_table_where' => 'AND tx_alumnilist_domain_model_year.pid=###CURRENT_PID### AND tx_alumnilist_domain_model_year.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'year' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.year',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'courses' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.courses',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_alumnilist_domain_model_course',
				'foreign_field' => 'year',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'alumni' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.alumni',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'fe_users',
				'foreign_field' => 'tx_alumnilist_year',
				'foreign_table_where' => 'ORDER BY last_name ASC',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'page' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.page',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'pages',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest'
					)
				)
			)
		),
	),
);
?>