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
 * ************************************************************* */

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
	 * @var Tx_Alumnilist_Controller_AlumnusController
	 */
	protected $fixture;
	protected $mockAlumnusRepository;
	protected $mockYearRepository;
	protected $mockView;
	protected $mockFlashMessageContainer;

	public function setUp() {
		$proxyClassName = $this->buildAccessibleProxy('Tx_Alumnilist_Controller_AlumnusController');
		$emptyQuery = $this->getMock('Tx_Extbase_Persistence_QueryResultInterface');
		$this->fixture = $this->getMock($proxyClassName, array('redirect'));
		$this->mockAlumnusRepository = $this->getMock('Tx_Alumnilist_Domain_Repository_AlumnusRepository', array('findAllFiltered', 'add', 'update', 'remove'));
		$this->mockYearRepository = $this->getMock('Tx_Alumnilist_Domain_Repository_YearRepository');
		$this->mockView = $this->getMock('Tx_Fluid_Core_View_TemplateView', array('assign', 'assignMultiple'), array(), '', FALSE, FALSE, FALSE);
		$this->mockFlashMessageContainer = $this->getMock('Tx_Extbase_MVC_Controller_FlashMessages', array('add'), array(), '', FALSE, FALSE, FALSE);

		$this->mockAlumnusRepository->expects($this->any())
				->method('findAllFiltered')
				->will($this->returnValue($emptyQuery));
		$this->mockYearRepository->expects($this->any())
				->method('findAll')
				->will($this->returnValue($emptyQuery));

		$this->fixture->_set('alumnusRepository', $this->mockAlumnusRepository);
		$this->fixture->_set('yearRepository', $this->mockYearRepository);
		$this->fixture->_set('view', $this->mockView);
		$this->fixture->_set('flashMessageContainer', $this->mockFlashMessageContainer);
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function listActionWorksWithDefaultFilter() {
		$this->mockAlumnusRepository->expects($this->once())->method('findAllFiltered')->with(NULL, NULL);
		$this->mockYearRepository->expects($this->once())->method('findAll');
		$this->mockView->expects($this->exactly(4))->method('assign')->with(new PHPUnit_Framework_Constraint_PCREMatch(',(alumni|year|years|search),'));
		$this->fixture->listAction();
	}

	/**
	 * @test
	 */
	public function listActionWorksWithYearFilter() {
		$year = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Year');
		$year->setYear(2011);
		$this->mockAlumnusRepository->expects($this->once())->method('findAllFiltered')->with(new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($year)), NULL);
		$this->mockYearRepository->expects($this->once())->method('findAll');
		$this->mockView->expects($this->exactly(4))->method('assign')->with(new PHPUnit_Framework_Constraint_PCREMatch(',(alumni|year|years|search),'));
		$this->fixture->listAction($year);
	}

	/**
	 * @test
	 */
	public function listActionWorksWithSearchString() {
		$search = "Müller";
		$this->mockAlumnusRepository->expects($this->once())->method('findAllFiltered')->with(NULL, $search);
		$this->mockYearRepository->expects($this->once())->method('findAll');
		$this->mockView->expects($this->exactly(4))->method('assign')->with(new PHPUnit_Framework_Constraint_PCREMatch(',(alumni|year|years|search),'));
		$this->fixture->listAction(NULL, $search);
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
		$this->mockAlumnusRepository->expects($this->once())->method('remove')->with(new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($alumnus)));
		$this->fixture->deleteAction($alumnus);
	}

	/**
	 * @test
	 */
	public function newActionWorks() {
		$alumnus = new Tx_Alumnilist_Domain_Model_Alumnus();
		$this->mockYearRepository->expects($this->once())->method('findAll');
		$this->mockView->expects($this->once())->method('assignMultiple')->with(new PHPUnit_Framework_Constraint_And(new PHPUnit_Framework_Constraint_ArrayHasKey('newAlumnus'), new PHPUnit_Framework_Constraint_ArrayHasKey('years')));
		$this->fixture->newAction($alumnus);
	}

}

?>