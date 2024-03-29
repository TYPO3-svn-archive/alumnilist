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
 * Alumnus controller class. Provides user interfaces for listing and
 * detail views of users and user registration.
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
class Tx_Alumnilist_Controller_AlumnusController extends Tx_Extbase_MVC_Controller_ActionController {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * An alumnus repository.
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface
	 */
	protected $alumnusRepository = NULL;


	/**
	 * A user group repository.
	 * @var Tx_Extbase_Domain_Repository_FrontendUserGroupRepository
	 */
	protected $userGroupRepository = NULL;


	/**
	 * A year repository.
	 * @var Tx_Alumnilist_Domain_Repository_YearRepositoryInterface
	 */
	protected $yearRepository = NULL;


	/**
	 * An alumnus checksum repository.
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface
	 */
	protected $alumnusChecksumRepository = NULL;



	/*
	 * DEPENDENCY INJECTORS
	 */



	/**
	 * Injects an alumni repository.
	 * @param Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface $alumnusRepository The alumnus repository.
	 * @return void
	 */
	public function injectAlumnusRepository(Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface $alumnusRepository) {
		$this->alumnusRepository = $alumnusRepository;
	}



	/**
	 * Injects a year repository.
	 * @param Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository The year repository.
	 * @return void
	 */
	public function injectYearRepository(Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository) {
		$this->yearRepository = $yearRepository;
	}



	/**
	 * Injects an alumnus-checksum repository.
	 * @param Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface $alumnusChecksumRepository The alumnus checksum repository.
	 * @return void
	 */
	public function injectAlumnusChecksumRepository(Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface $alumnusChecksumRepository) {
		$this->alumnusChecksumRepository = $alumnusChecksumRepository;
	}



	/**
	 * Injects a user group repository.
	 * @param Tx_Extbase_Domain_Repository_FrontendUserGroupRepository $userGroupRepository
	 */
	public function injectUserGroupRepository(Tx_Extbase_Domain_Repository_FrontendUserGroupRepository$userGroupRepository) {
		$this->userGroupRepository = $userGroupRepository;
	}



	/*
	 * INITIALIZATION
	 */



	/**
	 *
	 * Initializes the list action. Sets default parameters from settings. May
	 * be overridden using GET/POST parameters.
	 * @return void
	 *
	 */
	public function initializeListAction() {
		if (!$this->request->hasArgument('year') && $this->settings['parameters']['year'])
			$this->request->setArgument('year', $this->settings['parameters']['year']);
	}



	/**
	 * @return void
	 */
	public function initializeEditAction() {
		$this->request->setArgument('alumnus',
				(int) $GLOBALS['TSFE']->fe_user->user['uid']);
	}



	/* public function initializeCreateAction() {
	  $newAlumnus = $this->request->getArgument('newAlumnus');
	  if ($newAlmnus['password'] !== $this->request->getArgument('repeatPassword'))
	  $this->forward('new', NULL, NULL, $this->request->getArguments());
	  } */



	/*
	 * ACTION METHODS
	 */



	/**
	 *
	 * List action. Displays a list of alumni in a list. Can be filtered
	 * optionally.
	 *
	 * @param  Tx_Alumnilist_Domain_Model_Year $year
	 *                                 The year for which the alumni shall be
	 *                                 displayed. NULL to display all alumni.
	 * @param  string $search          The search filter.
	 * @return void
	 *
	 */
	public function listAction(Tx_Alumnilist_Domain_Model_Year $year = NULL,
			$search=NULL) {
		$alumni = $this->alumnusRepository->findAllFiltered($year, $search);
		$this->view->assign('alumni', $alumni);
		$this->view->assign('years',
				array_merge(array('' => 'Alle'), $this->yearRepository->findAll()->toArray()));
		$this->view->assign('year', $year);
		$this->view->assign('search', $search);
	}



	/**
	 *
	 * New action. Displays a form for user registration.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus
	 *                                 The new alumnus object.
	 * @dontvalidate $newAlumnus
	 * @return void
	 *
	 */
	public function newAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus = NULL) {
		$allYears = $this->yearRepository->findAll()->toArray();
		$this->view->assignMultiple(array(
			'newAlumnus' => $newAlumnus,
			'years' => array_merge(array('0' => ''), $allYears)
		));
	}



	/**
	 *
	 * Creates a new alumnus and stores it in the database.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus
	 *                                 The alumnus to be created.
	 * @return void
	 *
	 */
	public function createAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus) {
		$userGroup = $this->userGroupRepository->findByUid((int) $this->settings['alumniUserGroup']);
		$newAlumnus->addUsergroup($userGroup);
		$this->alumnusRepository->add($newAlumnus);
	}



	/**
	 *
	 * Displays a form for editing user data.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The alumnus to be edited.
	 * @return void
	 *
	 */
	public function editAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		if ((int) $GLOBALS['TSFE']->fe_user->user['uid'] !== $alumnus->getUid())
			throw new Tx_Extbase_Security_Exception('You have to be logged in for this!');
		$this->view->assignMultiple(array(
			'alumnus' => $alumnus,
			'courses' => $alumnus->getYear()->getCourses()
		));
	}



	/**
	 *
	 * Updates a user's values in the database.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The alumnus to be updated.
	 * @return void
	 *
	 */
	public function updateAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		if ((int) $GLOBALS['TSFE']->fe_user->user['uid'] !== $alumnus->getUid())
			throw new Tx_Extbase_Security_Exception('You have to be logged in for this!');
		$this->alumnusRepository->update($alumnus);
		$this->redirect('edit', NULL, NULL, array('alumnus' => $alumnus));
	}



	/**
	 *
	 * Deletes a user.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The user to be deleted.
	 * @return void
	 *
	 */
	public function deleteAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		if ((int) $GLOBALS['TSFE']->fe_user->user['uid'] !== $alumnus->getUid())
			throw new Tx_Extbase_Security_Exception('You have to be logged in for this!');
		$this->alumnusRepository->remove($alumnus);
		$this->flashMessageContainer->add('Your Alumnus was removed.');
		$this->redirect('list');
	}



	/**
	 *
	 * Displays a user's profile.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The user whose profile is to be displayed.
	 * @return void
	 *
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->view->assign('alumnus', $alumnus);
	}



}
