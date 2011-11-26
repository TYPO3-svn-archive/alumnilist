<?php



class Tx_Alumnilist_Domain_Validator_AlumnusValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {



	public function isValid($alumnus) {
		if (!$alumnus instanceof Tx_Alumnilist_Domain_Model_Alumnus) {
			$this->addError('Objekt ist keine Instanz der Klasse Tx_Alumnilist_Domain_Model_Alumnus!',
					1322147574);
			return FALSE;
		}

		$hasErrors = FALSE;
		$year = $alumnus->getYear();
		foreach ($alumnus->getCourses() as $course) {
			if ($course->getYear()->getYear() != $year->getYear()) {
				$hasErrors = TRUE;
				$this->addError('Der Kurs ' . $coure->getName() . ' gehört nicht zum Jahrgang ' . $year->getYear(),
						1322147575);
			}
		}

		return!$hasErrors;
	}



}