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
 * Test case for class Tx_Alumnilist_Controller_CourseController.
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
class Tx_Alumnilist_Controller_CourseControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Alumnilist_Controller_CourseController
	 */
	protected $fixture;

	protected $mockView;

	public function setUp() {
		$proxyClassName = $this->buildAccessibleProxy('Tx_Alumnilist_Controller_CourseController');
		$this->mockView = $this->getMock('Tx_Fluid_Core_View_TemplateView', array('assign', 'assignMultiple'), array(), '', FALSE, FALSE, FALSE);
		$this->fixture = $this->getMock($proxyClassName, array('redirect'));
		$this->fixture->_set('view', $this->mockView);
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function listActionWorks() {
		$year = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Year');
		$year->setYear(2011);
		$this->mockView->expects($this->once())->method('assign')->with('year', new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($year)));
		$this->fixture->listAction($year);
	}

	/**
	 * @test
	 */
	public function showActionWorks() {
		$course = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Course');
		$this->mockView->expects($this->once())->method('assign')->with('course', new PHPUnit_Framework_Constraint_IsInstanceOf(get_class($course)));
		$this->fixture->showAction($course);
	}

}
?>