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
 * @subpackage Domain\Validator
 * @license    GNU Lesser General Public License, version 3 or later
 *             http://www.gnu.org/licenses/lgpl.html
 *
 */
class Tx_Alumnilist_Domain_Validator_AlumnusValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {



	/**
	 *
	 * @param  Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 * @return boolean
	 *
	 */
	public function isValid($alumnus) {
		if (!$alumnus instanceof Tx_Alumnilist_Domain_Model_Alumnus) {
			$this->addError('Objekt ist keine Instanz der Klasse Tx_Alumnilist_Domain_Model_Alumnus!',
					1322147574);
			return FALSE;
		}

		$hasErrors = FALSE;
		$year = $alumnus->getYear();
		foreach ($alumnus->getCourses() as $course) {
			if ($course->getYear()->getYear() != $year->getYear()) {
				$hasErrors = TRUE;
				$this->addError('Der Kurs ' . $coure->getName() . ' gehört nicht zum Jahrgang ' . $year->getYear(),
						1322147575);
			}
		}

		return!$hasErrors;
	}



}