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
class Tx_Alumnilist_Controller_AlumnusController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * alumnusRepository
	 *
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusRepository
	 */
	protected $alumnusRepository;

	/**
	 * @var Tx_Alumnilist_Domain_Repository_YearRepository
	 */
	protected $yearRepository;

	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepository
	 */
	protected $alumnusChecksumRepository;

	/**
	 * injectAlumnusRepository
	 *
	 * @param Tx_Alumnilist_Domain_Repository_AlumnusRepository $alumnusRepository
	 * @return void
	 */
	public function injectAlumnusRepository(Tx_Alumnilist_Domain_Repository_AlumnusRepository $alumnusRepository) {
		$this->alumnusRepository = $alumnusRepository;
	}

	public function injectYearRepository(Tx_Alumnilist_Domain_Repository_YearRepository $yearRepository) {
		$this->yearRepository = $yearRepository;
	}

	public function injectAlumnusChecksumRepository(Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepository $alumnusChecksumRepository) {
		$this->alumnusChecksumRepository = $alumnusChecksumRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction(Tx_Alumnilist_Domain_Model_Year $year = NULL) {
		$alumni = $this->alumnusRepository->findAll();
		$this->view->assign('alumni', $alumni);
	}

	/**
	 * action new
	 *
	 * @param $newAlumnus
	 * @dontvalidate $newAlumnus
	 * @return void
	 */
	public function newAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus = NULL) {
		$this->view
			->assign('newAlumnus', $newAlumnus)
			->assign('years', $this->yearRepository->findAll());
	}

	/**
	 * action create
	 *
	 * @param $newAlumnus
	 * @return void
	 */
	public function createAction(Tx_Alumnilist_Domain_Model_Alumnus $newAlumnus) {
		$checksum = $this->alumnusChecksumRepository->findByUser($newAlumnus);
		if($checksum === NULL)
			throw new Exception("Das geht so nicht!");

		$this->alumnusRepository->add($newAlumnus);
		$this->flashMessageContainer->add('Your new Alumnus was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $alumnus
	 * @return void
	 */
	public function editAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->view->assign('alumnus', $alumnus);
	}

	/**
	 * action update
	 *
	 * @param $alumnus
	 * @return void
	 */
	public function updateAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumnusRepository->update($alumnus);
		$this->flashMessageContainer->add('Your Alumnus was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $alumnus
	 * @return void
	 */
	public function deleteAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->alumnusRepository->remove($alumnus);
		$this->flashMessageContainer->add('Your Alumnus was removed.');
		$this->redirect('list');
	}

	/**
	 * action show
	 *
	 * @param $alumnus
	 * @return void
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Alumnus $alumnus) {
		$this->view->assign('alumnus', $alumnus);
	}

}
?>