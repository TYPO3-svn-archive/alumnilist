<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 *
 * @author mhelmich
 */
interface Tx_Alumnilist_Domain_Repository_AlumnusChecksumRepositoryInterface {



	public function findByUser(Tx_Alumnilist_Domain_Model_Alumnus $alumnus);



	public function findByUserData($firstName, $lastName, DateTime $birthDay);



	public function add($alumnusChecksum);



}
