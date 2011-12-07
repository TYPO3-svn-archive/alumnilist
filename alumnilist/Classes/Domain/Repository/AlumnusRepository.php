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
class Tx_Alumnilist_Domain_Repository_AlumnusRepository extends Tx_Extbase_Domain_Repository_FrontendUserRepository
		implements Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface {



	/*
	 * REPOSITORY METHODS
	 */



	/**
	 *
	 * @return Traversable<Tx_Alumnilist_Domain_Model_Alumnus>
	 *
	 */
	public function findAll() {
		return parent::findAll();
	}



	/**
	 *
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 * @param string $search
	 * @return Traversable<Tx_Alumnilist_Domain_Model_Alumnus>
	 *
	 */
	public function findAllFiltered(Tx_Alumnilist_Domain_Model_Year $year=NULL,
			$search=NULL) {
		$query = $this->createQuery();
		$constraints = array();

		if ($year !== NULL) {
			$constraints[] = $query->equals('year', $year);
		}

		if ($search !== NULL) {
			$constraints[] = $query->logicalOr(
					$query->like('lastName', $search), $query->like('firstName', $search),
					$query->like('email', $searc)
			);
		}

		if (count($constraints)) {
			$query->matching($query->logicalAnd($constraints));
		}

		$query->setOrderings(array(
			'lastName' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'firstName' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));

		return $query->execute();
	}



}
