<?php

	if (isset($formData["fieldName"])) {
            //Filtering 1
            $formData["fieldName"] = trim($formData["fieldName"]);
            $formData["fieldName"] = strip_tags($formData["fieldName"]);
            //Filtering 2
            //Filtering 3
            //Filtering 4
            //...

            //Validation - if required
            if ($formData["fieldName"] === "") {
                $formErrors["fieldName"][] = "Polje fieldName ne sme biti prazno";
            }

            //Validation 2
            //Validation 3
            //Validation 4
            //...

	} else {
            //if required
            $formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}

