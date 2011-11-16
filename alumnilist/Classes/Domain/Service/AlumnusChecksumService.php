<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlumnusChecksumService
 *
 * @author mhelmich
 */
class Tx_Alumnilist_Domain_Service_AlumnusChecksumService implements Tx_Alumnilist_Domain_Service_AlumnusChecksumServiceInterface {

	public function calculateChecksumForUserData($firstName, $lastName, DateTime $birthDay) {
		$checksum = sha1("$firstName::$lastName::{$birthDay->format('U')}");
		return $checksum;
	}

}
