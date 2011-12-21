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
 * The "year" domain object.
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
class Tx_Alumnilist_Domain_Model_Year extends Tx_Extbase_DomainObject_AbstractEntity {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * The year
	 * @var integer
	 */
	protected $year;


	/**
	 * Courses that took place in this year.
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course>
	 */
	protected $courses;


	/**
	 * Alumni in this year.
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus>
	 */
	protected $alumni;


	/**
	 * The TYPO3 page id.
	 * @var int
	 */
	protected $page;

	/*
	 * LIFECYCLE METHODS
	 */



	/**
	 *
	 * Creates a new year.
	 * @return void
	 *
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}



	/**
	 *
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 * @return void
	 *
	 */
	protected function initStorageObjects() {
		$this->courses = new Tx_Extbase_Persistence_ObjectStorage();
		$this->alumni = new Tx_Extbase_Persistence_ObjectStorage();
	}



	/*
	 * GETTER METHODS
	 */



	/**
	 *
	 * Returns the year
	 * @return integer $year
	 *
	 */
	public function getYear() {
		return $this->year;
	}



	/**
	 *
	 * Sets the year
	 * @param integer $year
	 * @return void
	 *
	 */
	public function setYear($year) {
		$this->year = $year;
	}



	/**
	 *
	 * Returns the courses
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Course> $courses
	 *
	 */
	public function getCourses() {
		return $this->courses;
	}



	/**
	 *
	 * Return all alumni in this year.
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus>
	 *
	 */
	public function getAlumni() {
		return $this->alumni;
	}



	/**
	 *
	 * Returns the TYPO3 page id.
	 * @return integer
	 *
	 */
	public function getPage() {
		return $this->page;
	}



	/**
	 * @return string
	 */
	public function getDecade() {
		$year = $this->getYear()."";
		$year{3} = 'x';
		return $year;
	}



	/*
	 * SETTER METHODS
	 */


	/**
	 * @return void
	 */
	public function setAlumni(Tx_Extbase_Persistence_ObjectStorage $alumni) {
		$this->alumni = $alumni;
	}

	/**
	 *
	 * Adds an alumnus.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *
	 */
	public function addAlumnus(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumni->attach($alumnus);
	}



	/**
	 *
	 * Removes an alumnus.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *
	 */
	public function removeAlumnus(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumni->detach($alumnus);
	}



}