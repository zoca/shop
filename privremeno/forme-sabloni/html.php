<!-- Tekstualna polja -->

<input type="text" name="fieldName" value="<?php echo isset($formData["fieldName"]) ? htmlspecialchars($formData["fieldName"]) : "";?>">

<textarea name="fieldName"><?php echo isset($formData["fieldName"]) ? htmlspecialchars($formData["fieldName"]) : "";?></textarea>



<!-- Polja sa izborom jedne vrednosti -->
<!-- SELECT - OPTIONS -->
<?php
    $fieldNamePossibleValues = array("key1" => "value1", "key2" => "value2", "key3" => "value3");
?>
<select name="fieldName">
    <?php
    foreach ($fieldNamePossibleValues as $key => $value) {
        ?>
            <option value="<?php echo $key; ?>"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == $key ? " selected=\"\"" : "";?>><?php echo $value; ?></option>
        <?php
    }
    ?>
</select>

<!-- RADIO -->
<?php
    $fieldNamePossibleValues = array("key1" => "value1", "key2" => "value2", "key3" => "value3");
?>
<?php
    foreach ($fieldNamePossibleValues as $key => $value) {
        ?>
            <label><input type="radio" name="fieldName" value="<?php echo $key; ?>"<?php echo isset($formData["fieldName"]) && $formData["fieldName"] == $key ? " checked=\"\"" : "";?>> <?php echo $value; ?></label>
        <?php
    }
?>



<!-- Polja sa izborom vise vrednosti -->
<!-- CHECK BOX -->
<?php
    $fieldNamePossibleValues = array("key1" => "value1", "key2" => "value2", "key3" => "value3");
?>
<?php
    foreach ($fieldNamePossibleValues as $key => $value) {
        ?>
            <label><input type="checkbox" name="fieldName[]" value="<?php echo $key; ?>"<?php echo isset($formData["fieldName"]) && in_array($key, $formData["fieldName"]) ? " checked=\"\"" : "";?>> <?php echo $value; ?></label>
        <?php
    }
?>

<!-- Ispisivanje gresaka za jedno polje -->

<?php 
    if (isset($formErrors["fieldName"])) {
        foreach($formErrors["fieldName"] as $errorMessage) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage;?>
                </div>
            <?php
        }
    }
?>
