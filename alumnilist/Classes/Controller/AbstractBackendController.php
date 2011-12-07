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
 * Abstract backend controller class. Provides basic functions for
 * initialising the backend rendering engine. Obviously, Extbase was NOT
 * meant to be used for backend modules... :(
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
abstract class Tx_Alumnilist_Controller_AbstractBackendController extends Tx_Extbase_MVC_Controller_ActionController {



	/**
	 * Key of the extension this controller belongs to.
	 * @var string
	 */
	protected $extensionName = 'Alumnilist';


	/**
	 * The TYPO3 page renderer
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;


	/**
	 * The current page ID.
	 * @var integer
	 */
	protected $pageId;



	/**
	 *
	 * Initializes the controller (borrowed from "workspaces" extension).
	 * @return void
	 *
	 */
	protected function initializeAction() {
		$this->pageId = intval(t3lib_div::_GP('id'));
		$this->pageRenderer->addInlineLanguageLabelFile('EXT:workspaces/Resources/Private/Language/locallang.xml');
	}



	/**
	 *
	 * Processes a web request (borrowed from "workspaces" extension).
	 * @param  Tx_Extbase_MVC_RequestInterface $request
	 *                                 The web request.
	 * @param  Tx_Extbase_MVC_ResponseInterface $response
	 *                                 The web response.
	 * @return void
	 * 
	 */
	public function processRequest(Tx_Extbase_MVC_RequestInterface $request, Tx_Extbase_MVC_ResponseInterface $response) {
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
