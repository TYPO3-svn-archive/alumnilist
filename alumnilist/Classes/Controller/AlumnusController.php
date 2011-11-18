<?php

/* * *************************************************************
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
 * ************************************************************* */



/**
 *
 *
 * @package alumnilist
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
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



	/*
	 * INITIALIZATION
	 */



	/**
	 * Initializes the list action. Sets default parameters from settings. May
	 * be overridden using GET/POST parameters.
	 * @return void
	 */
	public function initializeListAction() {
		if (!$this->request->hasArgument('year') && $this->settings['parameters']['year'])
			$this->request->setArgument('year', $this->settings['parameters']['year']);
	}



	/*
	 * ACTION METHODS
	 */



	/**
	 * List action. Displays a list of alumni in a list. Can be filtered
	 * optionally.
	 * @param Tx_Alumnilist_Domain_Model_Year $year
	 *                                 The year for which the alumni shall be
	 *                                 displayed. NULL to display all alumni.
	 * @param string $search           The search filter.
	 * @return void
	 */
	public function listAction(Tx_Alumnilist_Domain_Model_Year $year = NULL, $search=NULL) {
		$alumni = $this->alumnusRepository->findAllFiltered($year, $search);
		$this->view
				->assign('alumni', $alumni)
				->assign('years',
						array_merge(array('' => 'Alle'), $this->yearRepository->findAll()->toArray()))
				->assign('year', $year)
				->assign('search', $search);
	}



	/**
	 * New action. Displays a form for user registration.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus
	 *                                 The new alumnus object.
	 * @dontvalidate $newAlumnus
	 * @return void
	 */
	public function newAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus = NULL) {
		$this->view
				->assign('newAlumnus', $newAlumnus)
				->assign('years', $this->yearRepository->findAll());
	}



	/**
	 * Creates a new alumnus and stores it in the database.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus
	 *                                 The alumnus to be created.
	 * @return void
	 */
	public function createAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus) {
		$checksum = $this->alumnusChecksumRepository->findByUser($newAlumnus);
		if ($checksum === NULL)
			throw new Exception("Das geht so nicht!");

		$this->alumnusRepository->add($newAlumnus);
		$this->flashMessageContainer->add('Your new Alumnus was created.');
		$this->redirect('list');
	}



	/**
	 * Displays a form for editing user data.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The alumnus to be edited.
	 * @return void
	 */
	public function editAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->view->assign('alumnus', $alumnus);
	}



	/**
	 * Updates a user's values in the database.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The alumnus to be updated.
	 * @return void
	 */
	public function updateAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumnusRepository->update($alumnus);
		$this->flashMessageContainer->add('Your Alumnus was updated.');
		$this->redirect('list');
	}



	/**
	 * Deletes a user.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The user to be deleted.
	 * @return void
	 */
	public function deleteAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumnusRepository->remove($alumnus);
		$this->flashMessageContainer->add('Your Alumnus was removed.');
		$this->redirect('list');
	}



	/**
	 * Displays a user's profile.
	 * @param Tx_Alumnilist_Domain_Model_Alumnus $alumnus
	 *                                 The user whose profile is to be displayed.
	 * @return void
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->view->assign('alumnus', $alumnus);
	}



}
