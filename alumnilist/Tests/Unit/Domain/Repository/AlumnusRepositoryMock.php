<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of AlumnusRepositoryMock
 *
 * @author mhelmich
 */
class Tx_Alumnilist_Domain_Repository_AlumnusRepositoryMock extends PHPUnit_Framework_MockObject_InvocationMocker
		implements Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface {



	public function findAll() {
		$result = new ArrayObject();
		return $result;
	}



	public function findAllFiltered(Tx_Alumnilist_Domain_Model_Year $year=NULL, $search=NULL) {
		$result = new ArrayObject();
		return $result;
	}



}
