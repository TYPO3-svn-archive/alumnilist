<?php



class Tx_Alumnilist_Service_CsvReader implements Iterator {



	protected $fileHandle = NULL;
	protected $rows = NULL;
	protected $delimiter = ';';
	protected $enclosure = NULL;



	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}



	public function setEnclosure($enclosure) {
		$this->enclosure = $enclosure;
	}



	public function loadCsvFile($filename) {
		$this->fileHandle = fopen($filename, 'r');
		$this->rows = array();

		while ($row = fgetcsv($this->fileHandle, 1024, $delimiter, $enclosure)) {
			$this->rows[] = $row;
		}
	}



	public function next() {
		return next($this->rows);
	}



	public function current() {
		return current($this->rows);
	}



	public function key() {
		return key($this->rows);
	}



	public function rewind() {
		reset($this->rows);
	}



	public function valid() {
		return current($this->rows) === FALSE;
	}



}
