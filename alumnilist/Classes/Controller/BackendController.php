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
 * The controller for the alumnilist backend module. Provides an user
 * interface for Schild.NRW import.
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
class Tx_Alumnilist_Controller_BackendController extends Tx_Alumnilist_Controller_AbstractBackendController {



	/*
	 * ATTRIBUTES
	 */


	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface
	 */
	protected $alumnusChecksumRepository = NULL;


	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository
	 */
	protected $alumnusCsvRepository = NULL;


	/*
	 * DEPENDENCY INJECTORS
	 */



	/**
	 *
	 * Injects an alumnus checksum repository.
	 * @param Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface $alumnusChecksumRepository
	 * @return void
	 *
	 */
	public function injectAlumnusChecksumRepository(Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface $alumnusChecksumRepository) {
		$this->alumnusChecksumRepository = $alumnusChecksumRepository;
	}



	/**
	 *
	 * Injects an alumnus CSV repository.
	 * @param Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository $alumnusCsvRepository
	 * @return void
	 *
	 */
	public function injectAlumnusCsvRepository(Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository $alumnusCsvRepository) {
		$this->alumnusCsvRepository = $alumnusCsvRepository;
	}



	/*
	 * ACTION METHODS
	 */



	/**
	 *
	 * Displays the index view. Actually doesn't really do anything. Yum.
	 * @return void
	 *
	 */
	public function indexAction() {

	}



	/**
	 *
	 * Displays the initial import view. Just like the index action, this
	 * method doesn't do a thing.
	 * @return void
	 *
	 */
	public function importAction() {

	}



	/**
	 *
	 * Provides a form for configuring a user import.
	 * @param  boolean $firstLineIsHeading
	 *                                 TRUE, is the first line of the uploaded
	 *                                 CVS file is to be interpreted as a header
	 *                                 line.
	 * @param  string  $delimiter      The CSV delimiter.
	 * @param  string  $enclosure      The CSV enclosure character.
	 * @return void
	 *
	 */
	public function configureImportAction($firstLineIsHeading=FALSE, $delimiter=';', $enclosure=NULL) {
		$fileName = t3lib_div::upload_to_tempfile($_FILES['tx_alumnilist_web_alumnilistmod1']['tmp_name']['importFile']);
		print_r(file_get_contents($fileName));
		$fileHandle = fopen($fileName, 'r');
		if ($firstLineIsHeading)
			fgetcsv($fileHandle, 1024, $delimiter);
		$firstColumn = fgetcsv($fileHandle, 1024, $delimiter);

		$properties = $this->reflectionService->getClassPropertyNames('Tx_Alumnilist_Domain_Model_Alumnus');
		$newProperties = array_combine($properties, $properties);
		ksort($newProperties);
		array_unshift($newProperties, NULL);

		$this->view
				->assign('columnValues', $firstColumn)
				->assign('properties', $newProperties)
				->assign('filename', $fileName);
	}



	/**
	 *
	 * Performs the actual file import. Reads all alumni from a CSV repository,
	 * creates appropriate Checksum objects and persists these in the database.
	 *
	 * @param  array  $properties The property mapping configuration that was
	 *                            specified by the user in the previous step.
	 *                            Maps column numbers of the CSV file to domain
	 *                            object properties.
	 * @param  string $filename   The filename of the uploaded file.
	 * @return void
	 *
	 */
	public function performImportAction(array $properties, $filename) {
		$csvReader = $this->objectManager->create('Tx_Alumnilist_Service_CsvReader');
		$csvReader->loadCsvFile($filename);
		$this->alumnusCsvRepository
				->setCsvReader($csvReader)
				->setPropertyMapping($properties);
		$results = array();
		foreach ($this->alumnusCsvRepository->findAll() as $alumnus) {
			$checksum = $this->objectManager->create('Tx_Alumnilist_Domain_Model_AlumnusChecksum');
			$checksum->setChecksumFromUser($alumnus);
			$this->alumnusChecksumRepository->add($checksum);
			$results[] = array(
				'alumnus' => $alumnus,
				'checksum' => $checksum
			);
		}
		$this->view->assign('addedRows', $results);
	}



}