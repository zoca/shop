<?php

	if (isset($_FILES["fieldName"]) && is_file($_FILES["fieldName"]["tmp_name"])) {
		
		if (empty($_FILES["fieldName"]["error"])) {
			//filtering
			$fieldNameFileTmpPath = $_FILES["fieldName"]["tmp_name"];
			$fieldNameFileName = basename($_FILES["fieldName"]["name"]);
			$fieldNameFileMime = mime_content_type($_FILES["fieldName"]["tmp_name"]);
			$fieldNameFileSize = $_FILES["fieldName"]["size"];
			
			//validation
			$fieldNameFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
			$fieldNameFileMaxSize = 1 * 1024 * 1024;// 1 MB
			
			if (!in_array($fieldNameFileMime, $fieldNameFileAllowedMime)) {
				$formErrors["fieldName"][] = "Fajl fieldName je u neispravnom formatu";
			}
			
			if ($fieldNameFileSize > $fieldNameFileMaxSize) {
				$formErrors["fieldName"][] = "Fajl fieldName prelazi maksimalnu dozvoljenu velicinu";
			}
			
		} else {
			$formErrors["fieldName"][] = "Doslo je do greske prilikom uploada fajla fieldName";
		}
	} else {//if required
		$formErrors["fieldName"][] = "Polje fieldName mora biti prosledjeno";
	}
	
	







	//kasnije prilikom provere da li ima gresaka u formi
	if (empty($formErrors)) {
		
            $destinationPath = $uploadsDirectory . DIRECTORY_SEPARATOR . $fieldNameFileName;

            if (!move_uploaded_file($fieldNameFileTmpPath, $destinationPath)) {
                $formErrors["fieldName"][] = "Doslo je do greske prilikom snimanja fajla fieldName";
            } else {
                //akcija
            }
	}

