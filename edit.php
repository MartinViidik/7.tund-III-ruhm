<?php 

	require_once("edit_functions.php");
	

	// edit.php
	// aadressireal on ?edit_id siis trükin välja selle väärtuse
	if(isset($_GET["edit_id"])){
		echo $_GET["edit_id"];
	
		// id oli aadressireal
		// ühte rida kõige uuemaid andmeid kus id on $_GET["edit_id"]
		
		$car = getEditData($_GET["edit_id"]);
		var_dump($car);
		
	}else{
		// ei olnud aadressireal	
		echo "VIGA";
		// die - edasi lehte ei laeta
		//die();
		
		//suuname kasutaja table.php lehele
		header("Locaton: table.php");
	}


?>



<h2>Edit car details</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="number_plate" >Car license plate</label><br>
	<input id="number_plate" name="number_plate" type="text" value=""<br><br>
	<label for="color">Color</label><br>
	<input id="color" name="color" type="text" value=""<br><br>
	<input type="submit" name="add_plate" value="Salvesta">
</form>