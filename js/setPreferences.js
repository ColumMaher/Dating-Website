function validateAge() {
  console.log("Age Checked");
  correct = true;
  var age_from = document.forms["setPreferences"]["age_from"].value;
  var age_to = document.forms["setPreferences"]["age_to"].value;


  if(age_from > age_to){
    alert("Invalid Age Range!");
    console.log(age_from);
    console.log(age_to);
    return false;
  }else{
    return true;
  }

}