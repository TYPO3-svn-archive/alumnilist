<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlumnusChecksumServiceInterface
 *
 * @author mhelmich
 */
interface Tx_Alumnilist_Domain_Service_AlumnusChecksumServiceInterface {
	public function calculateChecksumForUserData($firstName, $lastName, DateTime $birthDay);
}
