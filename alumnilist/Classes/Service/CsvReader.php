<?php



/*                                                                    - *
 *  COPYRIGHT NOTICE                                                    *
 *                                                                      *
 *  (c) 2011 Martin Helmich                                             *
 *      <typo3@martin-helmich.de>                                       *
 *      http://www.martin-helmich.de                                    *
 *                                                                      *
 *  All rights reserved                                                 *
 *                                                                      *
 *  This script is part of the TYPO3 project. The TYPO3 project is      *
 *  free software; you can redistribute it and/or modify it under       *
 *  the terms of the GNU General Public License as published by the     *
 * Free Software Foundation; either version 3 of the License, or        *
 *  (at your option) any later version.                                 *
 *                                                                      *
 *  The GNU General Public License can be found at                      *
 *  http://www.gnu.org/copyleft/gpl.html.                               *
 *                                                                      *
 *  This script is distributed in the hope that it will be useful,      *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of      *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the       *
 *  GNU General Public License for more details.                        *
 *                                                                      *
 *  This copyright notice MUST APPEAR in all copies of the script!      *
 *                                                                      */



/**
 *
 * @author     Martin Helmich <typo3@martin-helmich.de>
 * @copyright  2011/12 Martin Helmich
 *
 * @version    $Id$
 * @package    Alumnilist
 * @subpackage Service
 * @license    GNU Lesser General Public License, version 3 or later
 *             http://www.gnu.org/licenses/lgpl.html
 *
 */
class Tx_Alumnilist_Service_CsvReader implements Iterator {



	/**
	 * @var resource
	 */
	protected $fileHandle = NULL;


	/**
	 * @var array
	 */
	protected $rows = NULL;


	/**
	 * @var char
	 */
	protected $delimiter = ';';


	/**
	 * @var char
	 */
	protected $enclosure = NULL;



	/**
	 *
	 * @param string $delimiter
	 *
	 */
	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}



	/**
	 *
	 * @param string $enclosure
	 *
	 */
	public function setEnclosure($enclosure) {
		$this->enclosure = $enclosure;
	}



	/**
	 *
	 * @param string $filename
	 *
	 */
	public function loadCsvFile($filename) {
		$this->fileHandle = fopen($filename, 'r');
		$this->rows = array();

		while ($row = fgetcsv($this->fileHandle, 1024, $this->delimiter)) {
			$this->rows[] = $row;
		}
	}



	/**
	 *
	 * @return array
	 *
	 */
	public function next() {
		return next($this->rows);
	}



	/**
	 *
	 * @return array
	 *
	 */
	public function current() {
		return current($this->rows);
	}



	/**
	 *
	 * @return integer
	 *
	 */
	public function key() {
		return key($this->rows);
	}



	/**
	 *
	 * @return void
	 *
	 */
	public function rewind() {
		reset($this->rows);
	}



	/**
	 *
	 * @return boolean
	 *
	 */
	public function valid() {
		return current($this->rows) !== FALSE;
	}



}
