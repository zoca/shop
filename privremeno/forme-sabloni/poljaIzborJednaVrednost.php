<?php


	if (isset($formData["fieldName"])) {
            //Filtering 1
            $formData["fieldName"] = trim($formData["fieldName"]);
            $formData["fieldName"] = strip_tags($formData["fieldName"]);
		
		
            $fieldNamePossibleValues = array("key1" => "value1", "key2" => "value2", "key3" => "value3");

            //Validation - if required
            if ($formData["fieldName"] === "") {
                $formErrors["fieldName"][] = "Morate odabrati jednu od vrednosti polja fieldName";
            }

            if (!array_key_exists($formData["fieldName"], $fieldNamePossibleValues)) {
                $formErrors["fieldName"][] = "Izabrali ste neodgovarajucu vrednost za polje fieldName";
            }

            //Validation 2
            //Validation 3
            //...
	} else {
            //if required
            $formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}
