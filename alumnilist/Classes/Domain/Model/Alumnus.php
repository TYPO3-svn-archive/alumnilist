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
class Tx_Alumnilist_Domain_Model_Alumnus extends Tx_Extbase_Domain_Model_FrontendUser {

	/**
	 * unmarriedName
	 * @var string
	 */
	protected $unmarriedName;

	/**
	 * @var Tx_Alumnilist_Domain_Model_Year
	 */
	protected $year;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course>
	 */
	protected $courses;

	/**
	 * @var DateTime
	 */
	protected $birthday;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		$this->courses = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the unmarriedName
	 *
	 * @return string $unmarriedName
	 */
	public function getUnmarriedName() {
		return $this->unmarriedName;
	}

	/**
	 * Sets the unmarriedName
	 *
	 * @param string $unmarriedName
	 * @return void
	 */
	public function setUnmarriedName($unmarriedName) {
		$this->unmarriedName = $unmarriedName;
	}

	public function getYear() {
		return $this->year;
	}

	public function setYear(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->year = $year;
	}

	public function getCourses() {
		return $this->courses;
	}

	public function addCourse(Tx_Alumnilist_Domain_Model_Course $course) {
		if($course->getYear()->getYear() != $this->getYear()->getYear())
			throw new Tx_Alumnilist_Domain_Exception_WrongYearException();
		$this->courses->attach($course);
	}

	public function removeCourse(Tx_Alumnilist_Domain_Model_Course $courseToRemove) {
		$this->courses->detach($courseToRemove);
	}

	public function getBirthday() {
		return $this->birthday;
	}

	public function setBirthday(DateTime $birthday) {
		echo "set birthday"; var_dump($birthday);
		$this->birthday = $birthday;
	}





}