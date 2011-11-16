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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Alumnilist_Controller_AlumnusController.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Alumni List
 *
 * @author Martin Helmich <typo3@martin-helmich.de>
 */
class Tx_Alumnilist_Controller_AlumnusControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @var Tx_Alumnilist_Domain_Model_Alumnus
	 */
	protected $fixture;

	protected $mockRepository;

	protected $mockView;

	protected $mockFlashMessageContainer;

	public function setUp() {
		$this->fixture = $this->getMock(
            $this->buildAccessibleProxy('Tx_Alumnilist_Controller_AlumnusController'),
            array('redirect'),array(), '', FALSE);
		$this->mockRepository = $this->getMock(
            'Tx_Alumni_Domain_Repository_AlumnusRepository',
            array('findAll','add','update','remove'), array(), '', FALSE, FALSE, FALSE);
		$this->mockView = $this->getMock(
            'Tx_Fluid_Core_View_TemplateView',
            array('assign'), array(), '', FALSE, FALSE, FALSE);
		$this->mockFlashMessageContainer = $this->getMock(
			'Tx_Extbase_MVC_Controller_FlashMessages',
			array('add'), array(), '', FALSE, FALSE, FALSE);

		$this->fixture->_set('alumnusRepository', $this->mockRepository);
        $this->fixture->_set('view', $this->mockView);
        $this->fixture->_set('flashMessageContainer', $this->mockFlashMessageContainer);
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function listActionWorks() {
        $this->mockRepository->expects($this->once())->method('findAll');
        $this->mockView->expects($this->once())->method('assign')->with('alumni');
		$this->fixture->listAction();
	}

	/**
	 * @test
	 */
	public function showActionWorks() {
		$alumnus = new Tx_Alumnilist_Domain_Model_Alumnus();
        $this->mockView->expects($this->once())->method('assign')->with('alumnus', new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($alumnus)));
		$this->fixture->showAction($alumnus);
	}

	/**
	 * @test
	 */
	public function deleteActionWorks() {
		$alumnus = new Tx_Alumnilist_Domain_Model_Alumnus();
        $this->mockRepository->expects($this->once())->method('remove')->with(new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($alumnus)));
		$this->fixture->expects($this->once())->method('redirect')->with('list');
		$this->fixture->deleteAction($alumnus);
	}

}
?>