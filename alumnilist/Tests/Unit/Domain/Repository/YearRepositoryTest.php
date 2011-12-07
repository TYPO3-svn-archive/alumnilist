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
class Tx_Alumnilist_Domain_Repository_YearRepositoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @var Tx_Alumnilist_Domain_Repository_YearRepository
	 */
	protected $fixture;

	/**
	 * @var Tx_Phpunit_Framework
	 */
	protected $testingFramework;

	public function setUp() {
		$this->testingFramework = new Tx_Phpunit_Framework('tx_alumnilist', array('fe'));
		$this->fixture = $this->objectManager->get('Tx_Alumnilist_Domain_Repository_YearRepository');

		$this->yearUids[] = $this->testingFramework->createRecord('tx_alumnilist_domain_model_year', array(
			'year' => '2007',
				));
		$this->yearUids[] = $this->testingFramework->createRecord('tx_alumnilist_domain_model_year', array(
			'year' => '2008',
				));
	}

	public function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->fixture, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function allYearsAreFound() {
		$all = $this->fixture->findAll();
		$this->assertEquals('2008', $all[0]->getYear());
		$this->assertEquals($this->yearUids[1], $all[0]->getUid());

		$this->assertEquals('2007', $all[1]->getYear());
		$this->assertEquals($this->yearUids[0], $all[1]->getUid());
	}

	/**
	 * @test
	 */
	public function oneYearIsFoundByNumber() {
		$myYear = $this->fixture->findOneByYear(2007);
		$this->assertTrue($myYear instanceof Tx_Alumnilist_Domain_Model_Year);
		$this->assertEquals(2007, $myYear->getYear());
	}

	/**
	 * @test
	 */
	public function notExistingYearIsCreated() {
		$myYear = $this->fixture->findOrCreateOneByYear(2009);
		$this->assertEquals(2009, $myYear->getYear());
	}

}

?>