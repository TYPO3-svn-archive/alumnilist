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
	 * @return void
	 */
	public function listAction() {
		$this->view->assign('years', $this->yearRepository->findAll());
	}



}