<?php

class Tx_Alumnilist_Domain_Repository_AlumnusCsvRepository implements Tx_Alumnilist_Domain_Repository_AlumnusRepositoryInterface {

	/**
	 * @var Iterator
	 */
	protected $reader = NULL;

	/**
	 * @var array
	 */
	protected $propertyMap = NULL;

	/**
	 * @var Tx_Alumnilist_Domain_Repository_YearRepositoryInterface
	 */
	protected $yearRepository = NULL;

	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager = NULL;

	/**
	 * Injects a year repository.
	 * @param Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository
	 */
	public function injectYearRepository(Tx_Alumnilist_Domain_Repository_YearRepositoryInterface $yearRepository) {
		$this->yearRepository = $yearRepository;
	}

	/**
	 * Injects the Extbase object manager.
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * Injects a data reader. Can be anything, as long as its iterable.
	 * @param Iterator $reader The data reader.
	 */
	public function setCsvReader(Iterator $reader) {
		$this->reader = $reader;
	}

	/**
	 * Sets the property map. Maps columns of a numeric array (e.g. originating from
	 * a CSV import file) to property names.
	 * @param array $propertyMap The property name.
	 */
	public function setPropertyMapping($propertyMap) {
		$this->propertyMap = $propertyMap;
	}

	/**
	 * Finds all alumni.
	 * @todo   Ensure that the ArrayObject interface is compatible to QueryInterface!
	 * @return ArrayAccess All alumni read from the data reader.
	 */
	public function findAll() {
		$all = new ArrayObject();
		foreach ($this->reader as $row) {
			$all->append($this->mapPropertiesOnObject($row));
		}
		return $all;
	}

	/**
	 * Finds all alumni, filtered by a certain filter.
	 * @todo Implement this method!
	 * @param Tx_Alumnilist_Domain_Model_Year $year The year
	 * @param type $search A filter term. First and last name are filtered.
	 * @return ArrayAccess All Alumni matching the filter criteria.
	 */
	public function findAllFiltered(Tx_Alumnilist_Domain_Model_Year $year = NULL, $search = NULL) {
		throw new BadMethodCallException("Not yet implemented!");
	}

	/**
	 * Maps properties read from a numeric array onto a new alumnus object.
	 * @param array $row The array
	 * @return Tx_Alumnilist_Domain_Model_Alumnus The new alumnus.
	 */
	protected function mapPropertiesOnObject(array $row) {
		$alumnus = $this->objectManager->create('Tx_Alumnilist_Domain_Model_Alumnus');
		foreach ($this->propertyMap as $index => $propertyName) {
			$value = $row[$index];
			$setterMethodName = 'set' . ucfirst($propertyName);
			switch ($propertyName) {
				case 'year':
					$value = $this->yearRepository->findByYear($value);
					break;
				case 'birthday':
					$value = new DateTime($value);
					break;
				default:
					break;
			}
			$alumnus->{$setterMethodName}($value);
		}
		return $alumnus;
	}

}