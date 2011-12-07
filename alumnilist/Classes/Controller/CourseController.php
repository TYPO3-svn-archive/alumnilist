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
 * A controller providing course specifiv views.
 *
 * @author     Martin Helmich <typo3@martin-helmich.de>
 * @copyright  2011/12 Martin Helmich
 *
 * @version    $Id$
 * @package    Alumnilist
 * @subpackage Controller
 * @license    GNU Lesser General Public License, version 3 or later
 *             http://www.gnu.org/licenses/lgpl.html
 *
 */
class Tx_Alumnilist_Controller_CourseController extends Tx_Extbase_MVC_Controller_ActionController {



	/*
	 * INITIALIZATION METHODS
	 */



	/**
	 * Initializes the list action. Sets default parameters from settings. May
	 * be overridden using GET/POST parameters.
	 * @return void
	 */
	public function initializeListAction() {
		if (!$this->request->hasArgument('year'))
			$this->request->setArgument('year', (int) $this->settings['parameters']['year']);
	}



	/**
	 * Initializes the show action. Sets default parameters from settings. May
	 * be overridden using GET/POST parameters.
	 * @return void
	 */
	public function initializeShowAction() {
		if (!$this->request->hasArgument('course') && $this->settings['parameters']['course'])
			$this->request->setArgument('course', (int) $this->settings['parameters']['year']);
	}



	/*
	 * ACTION METHODS
	 */



	/**
	 *
	 * Lists all courses of a specific year.
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 *                                 The year for which to list all courses.
	 * @return void
	 *
	 */
	public function listAction(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->view->assign('year', $year);
	}



	/**
	 *
	 * Displays details for a specific course.
	 * @param Tx_Alumnilist_Domain_Model_Course $course
	 *                                 The course for which to display details.
	 * @return void
	 * 
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Course $course) {
		$this->view->assign('course', $course);
	}



}