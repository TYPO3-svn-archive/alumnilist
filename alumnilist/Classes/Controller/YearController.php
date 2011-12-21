<?php



class Tx_Alumnilist_Controller_YearController extends Tx_Extbase_MVC_Controller_ActionController {



	/**
	 * @var Tx_Alumnilist_Domain_Repository_YearRepositoryInterface
	 */
	protected $yearRepository = NULL;



	public function injectYearRepository(Tx_Alumnilist_Domain_Repository_YearRepositoryInterface$yearRepository) {
		$this->yearRepository = $yearRepository;
	}



	/**
	 *
	 * Initializes the show action. Sets default parameters from settings. May
	 * be overridden using GET/POST parameters.
	 * @return void
	 *
	 */
	public function initializeShowAction() {
		if (!$this->request->hasArgument('year') && $this->settings['parameters']['year'])
			$this->request->setArgument('year', $this->settings['parameters']['year']);
	}



	/**
	 * @return void
	 */
	public function listAction() {
		$this->view->assign('years', $this->yearRepository->findAll());
	}



	/**
	 * @return void
	 */
	public function showAction(Tx_Alumnilist_Domain_Model_Year $year) {
		$this->view->assign('year', $year);
	}



}