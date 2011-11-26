<?php



class Tx_Alumnilist_Controller_BackendController extends Tx_Alumnilist_Controller_AbstractBackendController {



	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface
	 */
	protected $alumnusChecksumRepository = NULL;


	/**
	 * @var Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository
	 */
	protected $alumnusCsvRepository = NULL;



	public function injectAlumnusChecksumRepository(Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface $alumnusChecksumRepository) {
		$this->alumnusChecksumRepository = $alumnusChecksumRepository;
	}



	public function injectAlumnusCsvRepository(Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository $alumnusCsvRepository) {
		$this->alumnusCsvRepository = $alumnusCsvRepository;
	}



	public function indexAction() {

	}



	public function importAction() {

	}



	/**
	 * @param bool $firstLineIsHeading
	 * @param string $delimiter
	 */
	public function configureImportAction($firstLineIsHeading=FALSE, $delimiter=';') {
		echo $_FILES['tx_alumnilist_web_alumnilistmod1']['tmp_name']['importFile'];
		t3lib_div::debug($_FILES);
		$fileName = t3lib_div::upload_to_tempfile($_FILES['tx_alumnilist_web_alumnilistmod1']['tmp_name']['importFile']);
		$fileHandle = fopen($fileName, 'r');
		if ($firstLineIsHeading)
			fgetcsv($fileHandle, 1024, $delimiter);
		$firstColumn = fgetcsv($fileHandle, 1024, $delimiter);

		$properties = $this->reflectionService->getClassPropertyNames('Tx_Alumnilist_Domain_Model_Alumnus');
		sort($properties);
		array_unshift($properties, NULL);

		$this->view
				->assign('columnValues', $firstColumn)
				->assign('properties', $properties)
				->assign('filename', $fileName);
	}



	/**
	 * @param array $properties
	 * @param string $filename
	 */
	public function performImportAction(array $properties, $filename) {
		echo $filename."<br>";
		t3lib_div::debug($properties);
		$this->alumnusCsvRepository
			->setCsvReader($this->objectManager->create('Tx_Alumnilist_Service_CsvReader', $filename))
			->setPropertyMapping($properties);
		/*$results = array();
		foreach($this->alumnusCsvRepository->findAll() as $alumnus) {
			$checksum = $this->alumnusChecksumRepository->findByUser($alumnus);
			$this->alumnusChecksumRepository->add($checksum);
			$results[] = array(
				'alumnus' => $alumnus,
				'checksum' => $checksum
			);
		}*/
	}



}