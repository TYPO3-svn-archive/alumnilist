<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Martin Helmich <typo3@martin-helmich.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Test case for class Tx_Alumnilist_Controller_CourseController.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Alumni List
 *
 * @author Martin Helmich <typo3@martin-helmich.de>
 */
class Tx_Alumnilist_Domain_Repository_AlumnusRepositoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusRepository
	 */
	protected $fixture;

	/**
	 * @var Tx_Phpunit_Framework
	 */
	protected $testingFramework;

	public function setUp() {
		$this->testingFramework = new Tx_Phpunit_Framework('tx_alumnilist', array('fe'));
		$this->fixture = $this->objectManager->get('Tx_Alumnilist_Domain_Repository_AlumnusRepository');

		/*$yearUids[] = $this->testingFramework->createRecord('tx_alumnilist_domain_model_year', array(
			'year' => '2007',
				));
		$yearUids[] = $this->testingFramework->createRecord('tx_alumnilist_domain_model_year', array(
			'year' => '2008',
				));
		$userUids[] = $this->testingFramework->createRecord('fe_users', array(
			'last_name' => 'Helmich',
			'first_name' => 'Martin',
			'tx_alumnilist_birthday' => time(),
			'tx_alumnilist_year' => $yearUids[0],
			'tx_extbase_type' => 'Tx_Alumnilist_Domain_Model_Alumnus'
				));
		$userUids[] = $this->testingFramework->createRecord('fe_users', array(
			'last_name' => 'Müller',
			'first_name' => 'Max',
			'tx_alumnilist_birthday' => time(),
			'tx_alumnilist_year' => $yearUid[1],
			'tx_extbase_type' => 'Tx_Alumnilist_Domain_Model_Alumnus'
				));*/
	}

	public function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->fixture, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function allAlumniAreFound() {
		$this->markTestIncomplete('Call me, when you figure out how to test operations on inherited system core objects... :(');
		#$all = $this->fixture->findAll();
		#$this->assertEquals('Helmich', $all[0]->getLastName());
	}

	/**
	 * @test
	 */
	public function filteredAlumniAreFound() {
		$this->markTestIncomplete('Call me, when you figure out how to test operations on inherited system core objects... :(');
		#$all = $this->fixture->findAll();
		#$this->assertEquals('Helmich', $all[0]->getLastName());
	}

}

?>