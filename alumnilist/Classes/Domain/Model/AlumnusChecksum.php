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
 * An alumnus checksum. Is computed from the user's name, first name and
 * birthday.
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
class Tx_Alumnilist_Domain_Model_AlumnusChecksum extends Tx_Extbase_DomainObject_AbstractEntity {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * The checksum.
	 * @var string
	 * @validate NotEmpty
	 */
	protected $checksum;


	/**
	 * The year
	 * @var Tx_Alumnilist_Domain_Model_Year
	 */
	protected $year;


	/**
	 * The extbase object manager.
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;

	/*
	 * LIFECYCLE METHODS
	 */



	/**
	 *
	 * Creates a new checksum.
	 * @return void
	 *
	 */
	public function __construct() {

	}



	/**
	 *
	 * Injects the extbase object manager.
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 *
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}



	/*
	 * GETTER METHODS
	 */



	/**
	 *
	 * Returns the checksum.
	 * @return string $checksum
	 *
	 */
	public function getChecksum() {
		return $this->checksum;
	}



	/**
	 *
	 * Returns the year
	 * @return Tx_Alumnilist_Domain_Model_Year $year
	 *
	 */
	public function getYear() {
		return $this->year;
	}



	/**
	 *
	 * Sets the checksum
	 * @param string $checksum
	 *
	 */
	public function setChecksum($checksum) {
		$this->checksum = $checksum;
	}



	/**
	 *
	 * Sets the checksum from user data.
	 * @param string   $firstName
	 * @param string   $lastName
	 * @param DateTime $birthDay
	 *
	 */
	public function setChecksumFromUserData($firstName, $lastName, DateTime $birthDay) {
		$service = $this->objectManager->get('Tx_Alumnilist_Domain_Service_AlumnusChecksumServiceInterface');
		$this->setChecksum($service->calculateChecksumForUserData($firstName, $lastName, $birthDay));
	}



	/**
	 *
	 * Sets the checksum from a specific user.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $user
	 *
	 */
	public function setChecksumFromUser(Tx_Alumnilist_Domain_Model_Alumnus $user) {
		$this->setChecksumFromUserData($user->getFirstName(), $user->getLastName(), $user->getBirthday());
	}



	/**
	 *
	 * Sets the year
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 * @return void
	 *
	 */
	public function setYear(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->year = $year;
	}



}
