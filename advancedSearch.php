<?php

function advancedSearch($firstname, $lastname, $con){
	$query = "SELECT userId FROM userdetails where firstname like '$firstname' AND lastname like '$lastname'";

	$advancedSearch = [];
	if($stmt = $con->prepare($query)){
			$stmt->execute();
			$stmt->bind_result($userId);
			while($stmt->fetch()){
				array_push($advancedSearch, $userId);
		}
			$stmt->close();
	}
	return $advancedSearch;	

}

