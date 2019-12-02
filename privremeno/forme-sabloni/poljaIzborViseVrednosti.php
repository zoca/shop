<?php

	if (isset($formData["fieldName"])) {
        //Filtering 		
		//Filtering 2
		//Filtering 3
		//Filtering 4
		$fieldNamePossibleValues = array("key1" => "value1", "key2" => "value2", "key3" => "value3");
		
		//Validation - if required
		if (count($formData["fieldName"]) === 0) {
			$formErrors["fieldName"][] = "Morate odabrati jednu od vrednosti polja fieldName";
		}
		
		//Validation - validate selected options
        if(count($formData["fieldName"]) > 0){
            foreach ($formData["fieldName"] as $value) {
                if(!array_key_exists($value, $fieldNamePossibleValues)){
                    $formErrors["fieldName"][] = "Izabrali ste neodgovarajuce vrednosti za polje fieldName i vrednost $value";
                }
            }
        }
		
		
		//Validation 2
		//Validation 3
		//...
	} else {
        //if required
		$formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}
