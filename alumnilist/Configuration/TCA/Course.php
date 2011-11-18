<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_alumnilist_domain_model_course'] = array(
	'ctrl' => $TCA['tx_alumnilist_domain_model_course']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, members, year, page',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, year, name, members, page, --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_alumnilist_domain_model_course',
				'foreign_table_where' => 'AND tx_alumnilist_domain_model_course.pid=###CURRENT_PID### AND tx_alumnilist_domain_model_course.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_course.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'members' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_course.members',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'MM' => 'tx_alumnilist_course_alumnus_mm',
				'MM_opposite_field' => 'tx_alumnilist_courses',
				'multiple' => TRUE,
				'size' => 10,
				'maxitems' => 9999,
				'minitems' => 0
			),
		),
		'year' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.year',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_alumnilist_domain_model_year',
				'multiple' => FALSE,
				'maxitems' => 1,
				'minitems' => 1
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
				'minitems' => 1,
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