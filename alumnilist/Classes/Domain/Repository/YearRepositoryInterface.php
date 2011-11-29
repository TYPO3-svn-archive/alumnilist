<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 *
 * @author mhelmich
 */
interface Tx_Alumnilist_Domain_Repository_YearRepositoryInterface {



	public function findAll();

	public function findOneByYear($year);

	public function findOrCreateOneByYear($year);



}
