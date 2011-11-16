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
class Tx_Alumnilist_Controller_CourseController extends Tx_Extbase_MVC_Controller_ActionController {

	public function initializeListAction() {
		if(!$this->request->hasArgument('year'))
			$this->request->setArgument('year', $this->settings['parameters']['year']);
	}

	/**
	 * Lists all courses of a specific year.
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 *                                 The year for which to list all courses.
	 * @return void
	 */
	public function listAction(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->view->assign('year', $year);
	}

	/**
	 * action show
	 *
	 * @param $course
	 * @return void
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Course $course) {
		$this->view->assign('course', $course);
	}

}