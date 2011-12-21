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



/**
 *
 * The alumnus domain model. Inherits most of its properties and methods
 * from the Extbase FrontendUser class.
 *
 * @author     Martin Helmich <typo3@martin-helmich.de>
 * @copyright  2011/12 Martin Helmich
 *
 * @version    $Id$
 * @package    Alumnilist
 * @subpackage Domain\Model
 * @license    GNU Lesser General Public License, version 3 or later
 *             http://www.gnu.org/licenses/lgpl.html
 *
 */
class Tx_Alumnilist_Domain_Model_Alumnus extends Tx_Extbase_Domain_Model_FrontendUser {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * The alumnus' unmarried name.
	 * @var string
	 */
	protected $unmarriedName;


	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $firstName;


	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $lastName;


	/**
	 * @var string
	 * @validate EmailAddress
	 */
	protected $email;


	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $password;


	/**
	 * The year
	 * @var Tx_Alumnilist_Domain_Model_Year
	 * @validate NotEmpty
	 */
	protected $year;


	/**
	 * Courses done by this user.
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course>
	 */
	protected $courses;


	/**
	 * The user's birthday.
	 * @var DateTime
	 * @validate DateTime
	 */
	protected $birthday;



	/**
	 *
	 * Creates a new alumnus.
	 * @return void
	 *
	 */
	public function __construct() {
		$this->courses = new Tx_Extbase_Persistence_ObjectStorage();
	}



	/*
	 * GETTER METHODS
	 */



	/**
	 *
	 * Returns the unmarried name
	 * @return string $unmarriedName The unmarried name.
	 *
	 */
	public function getUnmarriedName() {
		return $this->unmarriedName;
	}



	/**
	 *
	 * Returns the user's birthday.
	 * @return DateTime The user's birthday
	 *
	 */
	public function getBirthday() {
		return $this->birthday;
	}



	/**
	 *
	 * Returns the user's year.
	 * @return Tx_Alumnilist_Domain_Model_Year
	 *
	 */
	public function getYear() {
		return $this->year;
	}



	/**
	 *
	 * Returns the user's courses.
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course>
	 *
	 */
	public function getCourses() {
		return $this->courses;
	}



	/**
	 *
	 * Returns the user's full name.
	 * @override
	 * @return string
	 *
	 */
	public function getName() {
		$name = $this->getFirstName() . ' ' . $this->getLastName();
		if ($this->unmarriedName)
			$name .= ' (geb. ' . $this->unmarriedName . ')';
		return $name;
	}



	/**
	 *
	 * Returns city and country in a combined string. Convenience method.
	 * @return string
	 *
	 */
	public function getCityAndCountry() {
		if ($this->city && $this->country)
			return $this->city . ', ' . $this->country;
		else
			return $this->city . $this->country;
	}



	/*
	 * SETTER METHODS
	 */



	/**
	 * Sets the unmarried name.
	 * @param string $unmarriedName
	 * @return void
	 */
	public function setUnmarriedName($unmarriedName) {
		$this->unmarriedName = $unmarriedName;
	}



	/**
	 *
	 * Sets the year.
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 *
	 */
	public function setYear(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->year = $year;
	}



	/**
	 *
	 * Adds an additional course.
	 * @param Tx_Alumnilist_Domain_Model_Course $course
	 *
	 */
	public function addCourse(Tx_Alumnilist_Domain_Model_Course $course) {
		if ($course->getYear()->getYear() != $this->getYear()->getYear())
			throw new Tx_Alumnilist_Domain_Exception_WrongYearException();
		$this->courses->attach($course);
	}



	/**
	 *
	 * Removes a course.
	 * @param Tx_Alumnilist_Domain_Model_Course $courseToRemove
	 *
	 */
	public function removeCourse(Tx_Alumnilist_Domain_Model_Course $courseToRemove) {
		$this->courses->detach($courseToRemove);
	}

	public function setCourses(Tx_Extbase_Persistence_ObjectStorage $courses) {
		$this->courses = $courses;
	}



	/**
	 *
	 * Sets the user's birthday
	 * @param DateTime $birthday
	 *
	 */
	public function setBirthday(DateTime $birthday) {
		$this->birthday = $birthday;
	}



	/**
	 *
	 * Sets the user's email address. In addition to the parent class' method,
	 * this one also sets the username to the email address.
	 * @param string $email
	 *
	 */
	public function setEmail($email) {
		parent::setEmail($email);
		$this->setUsername($email);
	}



}