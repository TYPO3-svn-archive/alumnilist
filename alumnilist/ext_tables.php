<?php



/*                                                                    - *
 *  COPYRIGHT NOTICE                                                    *
 *                                                                      *
 *  (c) 2011 Martin Helmich                                             *
 *      <typo3@martin-helmich.de>                                       *
 *      http://www.martin-helmich.de                                    *
 *                                                                      *
 *  All rights reserved                                                 *
 *                                                                      *
 *  This script is part of the TYPO3 project. The TYPO3 project is      *
 *  free software; you can redistribute it and/or modify it under       *
 *  the terms of the GNU General Public License as published by the     *
 * Free Software Foundation; either version 3 of the License, or        *
 *  (at your option) any later version.                                 *
 *                                                                      *
 *  The GNU General Public License can be found at                      *
 *  http://www.gnu.org/copyleft/gpl.html.                               *
 *                                                                      *
 *  This script is distributed in the hope that it will be useful,      *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of      *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the       *
 *  GNU General Public License for more details.                        *
 *                                                                      *
 *  This copyright notice MUST APPEAR in all copies of the script!      *
 *                                                                      */


if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
		$_EXTKEY, 'Pi1', 'Alumni List'
);

$pluginSignature = strtolower(t3lib_div::underscoredToUpperCamelCase($_EXTKEY)) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature,
		'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Pi1.xml');




if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
			$_EXTKEY, 'web', // Make module a submodule of 'web' 'mod1', // Submodule key
			'', // Position
			array(
		'Backend' => 'index,import,configureImport,performImport',
			),
			array(
		'access' => 'user,group',
		'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
		'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod1.xml',
			)
	);
}


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Alumni List');


t3lib_extMgm::addLLrefForTCAdescr('tx_alumnilist_domain_model_year',
		'EXT:alumnilist/Resources/Private/Language/locallang_csh_tx_alumnilist_domain_model_year.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_alumnilist_domain_model_year');
$TCA['tx_alumnilist_domain_model_year'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_year',
		'label' => 'year',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Year.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_alumnilist_domain_model_year.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_alumnilist_domain_model_course',
		'EXT:alumnilist/Resources/Private/Language/locallang_csh_tx_alumnilist_domain_model_course.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_alumnilist_domain_model_course');
$TCA['tx_alumnilist_domain_model_course'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_course',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Course.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_alumnilist_domain_model_course.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_alumnilist_domain_model_alumnuschecksum',
		'EXT:alumnilist/Resources/Private/Language/locallang_csh_tx_alumnilist_domain_model_alumnuschecksum.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_alumnilist_domain_model_alumnuschecksum');
$TCA['tx_alumnilist_domain_model_alumnuschecksum'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_alumnuschecksum',
		'label' => 'checksum',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/AlumnusChecksum.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_alumnilist_domain_model_alumnuschecksum.gif'
	),
);

$tempColumns = array(
	'crdate' => array(
		'exclude' => 1,
		'config' => array('type' => 'passthrough')
	),
	'tx_alumnilist_unmarried_name' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_alumnus.unmarried_name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'tx_alumnilist_year' => array(
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
	'tx_alumnilist_courses' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_generic.courses',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_alumnilist_domain_model_course',
			'MM' => 'tx_alumnilist_course_alumnus_mm',
			'size' => 3,
			'multiple' => TRUE,
			'maxitems' => 9999,
			'minitems' => 0
		),
	),
	'tx_alumnilist_birthday' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_alumnus.birthday',
		'config' => array(
			'type' => 'input',
			'eval' => 'date,required'
		),
	),
);
t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users', $tempColumns, 1);
$TCA['fe_users']['types']['Tx_Alumnilist_Domain_Model_Alumnus'] = $TCA['fe_users']['types']['0'];
t3lib_extMgm::addToAllTCAtypes('fe_users',
		'--div--;LLL:EXT:alumnilist/Resources/Private/Language/locallang_db.xml:tx_alumnilist_domain_model_alumnus.tabname, tx_alumnilist_unmarried_name, tx_alumnilist_year, tx_alumnilist_courses, tx_alumnilist_birthday');

$TCA['fe_users']['columns']['tx_extbase_type']['config']['items'][] = array(
	'Tx_Alumnilist_Domain_Model_Alumnus', 'Tx_Alumnilist_Domain_Model_Alumnus'
);