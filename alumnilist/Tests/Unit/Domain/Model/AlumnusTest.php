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
 * Test case for class Tx_Alumnilist_Domain_Model_Alumnus.
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
class Tx_Alumnilist_Domain_Model_AlumnusTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Alumnilist_Domain_Model_Alumnus
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Alumnus');
	}

	public function tearDown() {
		unset($this->fixture);
	}


	/**
	 * @test
	 */
	public function initialValueOfUnmarriedNameIsNull() {
		$this->assertSame($this->fixture->getUnmarriedName(), NULL);
	}

	/**
	 * @test
	 */
	public function initialValueOfYearIsNull() {
		$this->assertSame($this->fixture->getYear(), NULL);
	}

	/**
	 * @test
	 */
	public function initialValueOfCoursesIsEmptySet() {
		$this->assertEquals(new Tx_Extbase_Persistence_ObjectStorage(), $this->fixture->getCourses());
	}

	/**
	 * @test
	 */
	public function canSetUnmarriedName() {
		$this->fixture->setUnmarriedName('Conceived at T3CON10');
		$this->assertSame('Conceived at T3CON10', $this->fixture->getUnmarriedName());
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
	 */
	public function canAddCourse() {
		$course = new Tx_Alumnilist_Domain_Model_Course();
		$course->setYear($this->createYear(2011));
		$container = new Tx_Extbase_Persistence_ObjectStorage();
		$container->attach($course);

		$this->fixture->setYear($this->createYear(2011));
		$this->fixture->addCourse($course);

		$this->assertEquals($container, $this->fixture->getCourses());
	}

	/**
	 * @test
	 * @depends canAddCourse
	 */
	public function canRemoveCourse() {
		$course = new Tx_Alumnilist_Domain_Model_Course();
		$course->setYear($year = $this->createYear(2011));
		$container = new Tx_Extbase_Persistence_ObjectStorage();
		$container->attach($course);
		$container->detach($course);

		$this->fixture->setYear($year);
		$this->fixture->addCourse($course);
		$this->fixture->removeCourse($course);

		$this->assertEquals($container, $this->fixture->getCourses());
	}

	/**
	 * @test
	 * @depends canAddCourse
	 * @expectedException Tx_Alumnilist_Domain_Exception_WrongYearException
	 */
	public function cannotAddCourseWithWrongYear() {
		$course = new Tx_Alumnilist_Domain_Model_Course();
		$course->setYear($this->createYear(2011));
		$container = new Tx_Extbase_Persistence_ObjectStorage();
		$container->attach($course);

		$this->fixture->setYear($this->createYear(2010));
		$this->fixture->addCourse($course);
	}

	protected function createYear($year) {
		$yearObject = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Year');
		$yearObject->setYear($year);
		return $yearObject;
	}

}