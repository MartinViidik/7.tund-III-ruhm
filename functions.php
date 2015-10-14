<?php 

	require_once("../config_global.php");
	$database = "if15_martin";
	
	// annan vaikev��rtuse
	function getCarData($keyword=""){
		
			$search = "%%";
			
			//kas otsis�na on t�hi
			if($keyword == ""){
				// ei otsi midagi
				echo "Not looking";
				
			}else{
				// otsin
				echo "Finding ".$keyword;
				$search = "%".$keyword."%";
			}
			
			//echo "Finding ".$keyword;
		
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
			
			$stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color from car_plates WHERE deleted IS NULL AND (number_plate LIKE ? OR color LIKE ?)");
			$stmt->bind_param("ss", $search, $search);
			$stmt->bind_result($id, $user_id_from_database, $number_plate, $color);
			$stmt->execute();
			
			// tekitan (t�hja) massiivi, kus edasipidi hoian objekte
			$car_array = array();
			
			
			// tee midagi seni, kuni saame andmebaasist �he rea andmeid
			while($stmt->fetch()){
				// seda siin sees tehakse 
				// nii mitu korda kui on ridu
				
				// tekitan objekti kus hakkan hoidma v��rtusi
				$car = new StdClass();
				$car->id = $id;
				$car->plate = $number_plate;
				$car->user_id = $user_id_from_database;
				$car->color = $color;
				
				//lisan massiivi �he rea juurde
				array_push($car_array, $car);
				// var dump �tleb muutuja t��bi ja sisu
				//echo "<pre>";
				//var_dump ($car_array);
				//echo "</pre><br>";
				
				
			}
			
			//tagastan massiivi, kus k�ik read sees
			return $car_array;
			
			$stmt->close();
			$mysqli->close();
			
	}
	
		function deleteCar($id){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			// sai kustutatud
			// kustutame aadressirea t�hjaks
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		
		
	}
	
?>