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
 * The "course" domain object.
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
class Tx_Alumnilist_Domain_Model_Course extends Tx_Extbase_DomainObject_AbstractEntity {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * The course name
	 * @var string
	 */
	protected $name;


	/**
	 * Members of this course.
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus>
	 */
	protected $members;


	/**
	 * The year this course took place in.
	 * @var Tx_Alumnilist_Domain_Model_Year
	 */
	protected $year;


	/**
	 * The corresponding TYPO3 page id.
	 * @var int
	 */
	protected $page;

	/*
	 * LIFECYCLE METHODS
	 */



	/**
	 *
	 * Create a new course.
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
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->members = new Tx_Extbase_Persistence_ObjectStorage();
	}



	/*
	 * GETTER METHODS
	 */



	/**
	 *
	 * Returns the name
	 * @return string $name
	 *
	 */
	public function getName() {
		return $this->name;
	}



	/**
	 *
	 * Returns the members
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus> $members
	 *
	 */
	public function getMembers() {
		return $this->members;
	}



	/**
	 *
	 * Gets the year.
	 * @return Tx_Alumnilist_Domain_Model_Year
	 *
	 */
	public function getYear() {
		return $this->year;
	}



	/**
	 *
	 * Gets the TYPO3 page id.
	 * @return integer
	 *
	 */
	public function getPage() {
		return $this->page;
	}



	/*
	 * SETTER METHODS
	 */



	/**
	 *
	 * Sets the name.
	 * @param string $name
	 * @return void
	 *
	 */
	public function setName($name) {
		$this->name = $name;
	}



	/**
	 *
	 * Adds an Alumnus
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $member
	 * @return void
	 *
	 */
	public function addMember(Tx_Alumnilist_Domain_Model_Alumnus $member) {
		if ($member->getYear()->getYear() != $this->getYear()->getYear())
			throw new Tx_Alumnilist_Domain_Exception_WrongYearException();
		$this->members->attach($member);
	}



	/**
	 *
	 * Removes an Alumnus
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $memberToRemove The Alumnus to be removed
	 * @return void
	 *
	 */
	public function removeMember(Tx_Alumnilist_Domain_Model_Alumnus $memberToRemove) {
		$this->members->detach($memberToRemove);
	}



	/**
	 *
	 * Sets the members
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Alumnilist_Domain_Model_Alumnus> $members
	 * @return void
	 *
	 */
	public function setMembers(Tx_Extbase_Persistence_ObjectStorage $members) {
		$this->members = $members;
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



	public function __toString() {
		return $this->getName();
	}



}