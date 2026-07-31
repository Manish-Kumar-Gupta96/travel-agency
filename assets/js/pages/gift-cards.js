document.addEventListener("DOMContentLoaded",()=>{


/*=========================================
GIFT CARD CATEGORY SELECT
=========================================*/


document.querySelectorAll(".gift-select").forEach(button=>{


button.addEventListener("click",()=>{


const card=button.closest(".gift-card-box");

const title=card.querySelector("h3").textContent;


alert(

title+" selected. Please complete the purchase form."

);


document.querySelector(".purchase-card").scrollIntoView({

behavior:"smooth"

});


});


});





/*=========================================
GIFT CARD PURCHASE FORM
=========================================*/


const giftForm=document.getElementById("giftForm");


giftForm.addEventListener("submit",(event)=>{


event.preventDefault();


alert(

"Demo Version: Gift card purchase will be processed after payment gateway integration."

);


});





/*=========================================
BALANCE CHECKER
=========================================*/


document.getElementById("checkBalance").addEventListener("click",()=>{


const code=document.getElementById("giftCode").value.trim();



if(code===""){


alert("Please enter your gift card code.");


return;


}



alert(

"Demo Balance: ₹25,000 available for "+code

);


});






/*=========================================
ORDER TABLE INTERACTION
=========================================*/


document.querySelectorAll(".orders-card tbody tr").forEach(row=>{


row.addEventListener("click",()=>{


const customer=row.children[0].textContent;


alert(

"Gift card details for "+customer

);


});


});






/*=========================================
GSAP ANIMATION
=========================================*/


if(typeof gsap!=="undefined"){



gsap.from(".hero-content",{


duration:1,

opacity:0,

y:60


});





gsap.from(".gift-card-box",{


duration:.7,

opacity:0,

y:40,

stagger:.15,

delay:.3


});





gsap.from(".preview-card",{


duration:.8,

opacity:0,

x:-50,

delay:.7


});





gsap.from(".purchase-card",{


duration:.8,

opacity:0,

x:50,

delay:.9


});





gsap.from(".balance-card",{


duration:.8,

opacity:0,

y:40,

delay:1.1


});





gsap.from(".orders-card",{


duration:.8,

opacity:0,

y:40,

delay:1.3


});


}



});
