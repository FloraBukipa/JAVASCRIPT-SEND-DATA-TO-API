
const btnSubmit = document.getElementById("register");

let success = document.getElementById("alertSuccess");

btnSubmit.addEventListener('click',async function(e){
e.preventDefault();
let name = document.getElementById('name');
let email = document.getElementById('email');
let password = document.getElementById('password');
const formData = new FormData();
formData.append('name', name.value); 
formData.append('email', email.value);//
formData.append("password",password.value);
try{
let result ='';
const response = await fetch('http://localhost/api-demo/register.php',{
method:'POST',
body:formData,
});
 result = await response.text();
if(result){ 
   alert("Success"+ result);
  success.textContent = 'Congratulation, Registration succesful';
  success.style.display ='block';
}
else{
alert("Submission Failed"+ result);
}
}catch(error){
  alert("Error"+ error);
console.log(error);
}
})
