<?php

interface Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface {

	public function findAll();

	public function findAllFiltered(Tx_Alumnilist_Domain_Model_Year $year=NULL, $search=NULL);

}