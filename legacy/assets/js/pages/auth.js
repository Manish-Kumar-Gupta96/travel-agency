document.addEventListener("DOMContentLoaded",()=>{


const forms=document.querySelectorAll("form");



forms.forEach(form=>{


form.addEventListener("submit",(e)=>{


e.preventDefault();



if(form.id==="loginForm"){


alert("Demo Login Successful");


}



if(form.id==="registerForm"){


alert("Demo Account Created");


}



if(form.id==="resetForm"){


alert("Password reset link sent");


}



});


});



});
