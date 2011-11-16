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
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package alumnilist
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Alumnilist_Domain_Model_Year extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * year
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $year;

	/**
	 * courses
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course>
	 */
	protected $courses;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus>
	 */
	protected $alumni;

	/**
	 * @var int
	 */
	protected $page;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->courses = new Tx_Extbase_Persistence_ObjectStorage();
		$this->alumni = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the year
	 *
	 * @return integer $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Sets the year
	 *
	 * @param integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * Adds a Course
	 *
	 * @param Tx_Alumnilist_Domain_Model_Course $course
	 * @return void
	 */
	public function addCourse(Tx_Alumnilist_Domain_Model_Course $course) {
		$this->courses->attach($course);
	}

	/**
	 * Removes a Course
	 *
	 * @param Tx_Alumnilist_Domain_Model_Course $courseToRemove The Course to be removed
	 * @return void
	 */
	public function removeCourse(Tx_Alumnilist_Domain_Model_Course $courseToRemove) {
		$this->courses->detach($courseToRemove);
	}

	/**
	 * Returns the courses
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course> $courses
	 */
	public function getCourses() {
		return $this->courses;
	}

	public function getAlumni() {
		return $this->alumni;
	}

	public function addAlumnus(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumni->attach($alumnus);
	}

	public function removeAlumnus(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumni->detach($alumnus);
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = (int) $page;
	}

}