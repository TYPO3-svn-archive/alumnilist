<?php



abstract class Tx_Alumnilist_Controller_AbstractBackendController extends Tx_Extbase_MVC_Controller_ActionController {



	/**
	 * Key of the extension this controller belongs to
	 * @var string
	 */
	protected $extensionName = 'Alumnilist';


	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;


	/**
	 * @var integer
	 */
	protected $pageId;



	protected function initializeAction() {
		// @todo Evaluate how the intval() call can be used with Extbase validators/filters
		$this->pageId = intval(t3lib_div::_GP('id'));
		$this->pageRenderer->addInlineLanguageLabelFile('EXT:workspaces/Resources/Private/Language/locallang.xml');
	}



	/**
	 *
	 * @param Tx_Extbase_MVC_RequestInterface $request
	 * @param Tx_Extbase_MVC_ResponseInterface $response
	 */
	public function processRequest(Tx_Extbase_MVC_RequestInterface $request,
			Tx_Extbase_MVC_ResponseInterface $response) {
		$this->template = t3lib_div::makeInstance('template');
		$this->pageRenderer = $this->template->getPageRenderer();

		$GLOBALS['SOBE'] = new stdClass();
		$GLOBALS['SOBE']->doc = $this->template;

		parent::processRequest($request, $response);

		$pageHeader = $this->template->startpage(
				$GLOBALS['LANG']->sL('LLL:EXT:workspaces/Resources/Private/Language/locallang.xml:module.title')
		);
		$pageEnd = $this->template->endPage();

		$response->setContent($pageHeader . $response->getContent() . $pageEnd);
	}



}
