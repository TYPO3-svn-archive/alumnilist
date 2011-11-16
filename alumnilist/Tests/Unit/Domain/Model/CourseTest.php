<?php

/***************************************************************
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
 ***************************************************************/

/**
 * Test case for class Tx_Alumnilist_Domain_Model_Course.
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
class Tx_Alumnilist_Domain_Model_CourseTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Alumnilist_Domain_Model_Course
	 */
	protected $fixture;

	public function setUp() {
		$year = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Year');
		$year->setYear(2011);

		$this->fixture = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Course');
		$this->fixture->setYear($year);
	}

	public function tearDown() {
		unset($this->fixture);
	}


	/**
	 * @test
	 */
	public function initialValueOfNameIsNull() {
		$this->assertEquals(NULL, $this->fixture->getName());
	}

	/**
	 * @test
	 */
	public function initialValueOfMembersIsEmptySet() {
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getMembers()
		);
	}

	/**
	 * @test
	 */
	public function initialValueOfYearIsAPredefinedYear() {
		$this->assertInstanceOf('Tx_Alumnilist_Domain_Model_Year', $this->fixture->getYear());
	}

	/**
	 * @test
	 */
	public function canSetName() {
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}

	/**
	 * @test
	 */
	public function canSetMembers() {
		$member = new Tx_Alumnilist_Domain_Model_Alumnus();
		$objectStorageHoldingExactlyOneMembers = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneMembers->attach($member);
		$this->fixture->setMembers($objectStorageHoldingExactlyOneMembers);

		$this->assertSame(
			$objectStorageHoldingExactlyOneMembers,
			$this->fixture->getMembers()
		);
	}

	/**
	 * @test
	 */
	public function canAddMember() {
		$member = new Tx_Alumnilist_Domain_Model_Alumnus();
		$member->setYear($this->fixture->getYear());
		$objectStorageHoldingExactlyOneMember = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneMember->attach($member);
		$this->fixture->addMember($member);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneMember,
			$this->fixture->getMembers()
		);
	}

	/**
	 * @test
	 */
	public function canRemoveMember() {
		$member = new Tx_Alumnilist_Domain_Model_Alumnus();
		$member->setYear($this->fixture->getYear());
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($member);
		$localObjectStorage->detach($member);
		$this->fixture->addMember($member);
		$this->fixture->removeMember($member);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getMembers()
		);
	}

	/**
	 * @test
	 */
	public function canSetYear() {
		$year = new Tx_Alumnilist_Domain_Model_Year();
		$year->setYear(2011);
		$this->fixture->setYear($year);
		$this->assertSame($year, $this->fixture->getYear());
	}

	/**
	 * @test
	 * @depends canAddMember
	 * @expectedException Tx_Alumnilist_Domain_Exception_WrongYearException
	 */
	public function cannotAddMemberWithWrongYear() {
		$year2010 = new Tx_Alumnilist_Domain_Model_Year();
		$year2010->setYear(2010);

		$member = new Tx_Alumnilist_Domain_Model_Alumnus();
		$member->setYear($year2010);
		$this->fixture->addMember($member);
	}

}
?>