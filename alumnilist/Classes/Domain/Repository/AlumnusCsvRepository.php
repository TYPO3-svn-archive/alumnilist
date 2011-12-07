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
 * @author     Martin Helmich <typo3@martin-helmich.de>
 * @copyright  2011/12 Martin Helmich
 *
 * @version    $Id$
 * @package    Alumnilist
 * @subpackage Domain\Repository
 * @license    GNU Lesser General Public License, version 3 or later
 *             http://www.gnu.org/licenses/lgpl.html
 *
 */
class Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository implements Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * @var Iterator
	 */
	protected $reader = NULL;


	/**
	 * @var array
	 */
	protected $propertyMap = NULL;


	/**
	 * @var Tx_Alumnilist_Domain_Repository_YearRepositoryInterface
	 */
	protected $yearRepository = NULL;


	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager = NULL;



	/*
	 * DEPENDENCY INJECTORS
	 */



	/**
	 * Injects a year repository.
	 * @param Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository
	 */
	public function injectYearRepository(Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository) {
		$this->yearRepository = $yearRepository;
	}



	/**
	 * Injects the Extbase object manager.
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}



	/**
	 * Injects a data reader. Can be anything, as long as its iterable.
	 * @param Iterator $reader The data reader.
	 */
	public function setCsvReader(Iterator $reader) {
		$this->reader = $reader;
		return $this;
	}



	/**
	 * Sets the property map. Maps columns of a numeric array (e.g. originating from
	 * a CSV import file) to property names.
	 * @param array $propertyMap The property name.
	 */
	public function setPropertyMapping($propertyMap) {
		$this->propertyMap = $propertyMap;
		return $this;
	}



	/*
	 * REPOSITORY METHODS
	 */



	/**
	 * Finds all alumni.
	 *
	 * @override
	 * @todo   Ensure that the ArrayObject interface is compatible to QueryInterface!
	 * @return ArrayAccess All alumni read from the data reader.
	 */
	public function findAll() {
		$all = new ArrayObject();
		foreach ($this->reader as $row) {
			$all->append($this->mapPropertiesOnObject($row));
		}
		return $all;
	}



	/**
	 * Finds all alumni, filtered by a certain filter.
	 * @todo Implement this method!
	 * @param Tx_Alumnilist_Domain_Model_Year $year The year
	 * @param type $search A filter term. First and last name are filtered.
	 * @return ArrayAccess All Alumni matching the filter criteria.
	 */
	public function findAllFiltered(Tx_Alumnilist_Domain_Model_Year $year = NULL, $search = NULL) {
		throw new BadMethodCallException("Not yet implemented!");
	}



	/**
	 * Maps properties read from a numeric array onto a new alumnus object.
	 * @param array $row The array
	 * @return Tx_Alumnilist_Domain_Model_Alumnus The new alumnus.
	 */
	protected function mapPropertiesOnObject(array $row) {
		$alumnus = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Alumnus');
		foreach ($this->propertyMap as $index => $propertyName) {
			if (!$propertyName)
				continue;
			$value = $row[$index];
			$setterMethodName = 'set' . ucfirst($propertyName);
			switch ($propertyName) {
				case 'year':
					$value = $this->yearRepository->findOrCreateOneByYear($value);
					break;
				case 'birthday':
					$value = new DateTime($value);
					break;
				default:
					break;
			}
			$alumnus->{$setterMethodName}($value);
		}
		return $alumnus;
	}



}