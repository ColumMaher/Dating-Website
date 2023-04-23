function validateInput(input, inputName){
  if(input == null || input == ""){
    inputError(inputName);
  }else{
    inputNormal(inputName);
  }
}

export function add(){
  return 1 + 2;
}

function inputError(input){
    document.getElementById(input).style.opacity = "1";          
    document.getElementById(input).style.boxShadow = "2px 2px 20px red";
}

function inputNormal(input){
  document.getElementById(input).style.opacity = ".7";          
  document.getElementById(input).style.boxShadow = "1px 1px 10px #323232";
}

