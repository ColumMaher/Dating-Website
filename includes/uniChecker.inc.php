<?php
function universityChecker($university){
	if(strlen($university) < 5){
		$uni = strtolower($university);
		if($uni == "ul"){
			return "University Of Limerick";
		}
		if($uni == "nuig"){
			return "National University of Ireland, Galway";
		}
		if($uni == "ucd"){
			return "University College Dublin";
		}
		if($uni == "dcu"){
			return "Dublin City University";
		}
		if($uni == "tcd"){
			return "Trinity College Dublin";
		}
		if($uni == "ucd"){
			return "University College Cork";
		}
	}else{
		return $university;
	}
}