var correct;
function validateInputFields() {
  alert("Soemthing");
  correct = true;
  var firstname = document.forms["CreateUser"]["firstname"].value;
  var lastname = document.forms["CreateUser"]["lastname"].value;
  var city = document.forms["CreateUser"]["city"].value;
  var job = document.forms["CreateUser"]["job"].value;
  var hobbies = document.forms["CreateUser"]["hobbies"].value;
  var bio = document.forms["CreateUser"]["bio"].value;
  console.log(correct);
  validateField(firstname, "firstname");
  console.log(correct);
  validateField(lastname, "lastname");
  validateField(city, "city");
  validateField(job,"job");
  validateField(hobbies,"hobbies");
  validateField(bio, "bio");
  console.log(correct);

  if(correct == false){
    alert("Some errors with your inputs, they are highlighted in red");
    return false;
  }else{
    alert("User Created!");
    return false;
  }

}


function validateField(input, inputName){
  if(inputName == "bio" || inputName == "hobbies" || inputName = 'img'){
    if(input == null || input == ""){
      inputError(inputName);
      correct = false;
    }else{
      inputNormal(inputName);
    }
    return;
  }
  if(input == null || !(/^[a-zA-Z]+$/.test(input)) || input == ""){
    inputError(inputName);
    correct = false;
  }else{
    inputNormal(inputName);
  }
}


function inputError(input){
    document.getElementById(input).style.opacity = "1";          
    document.getElementById(input).style.boxShadow = "2px 2px 20px red";
}

function inputNormal(input){
  document.getElementById(input).style.opacity = ".7";          
  document.getElementById(input).style.boxShadow = "1px 1px 10px #323232";
}
//Input is empty or just space 
// function empty(input){
//   return input.trim().length === 0;
// }
