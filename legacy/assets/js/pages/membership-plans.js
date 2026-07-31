document.addEventListener("DOMContentLoaded",()=>{

const toggle=document.getElementById("priceToggle");

const prices=document.querySelectorAll(".price");

toggle.addEventListener("change",()=>{

prices.forEach(price=>{

price.textContent=toggle.checked
?price.dataset.year
:price.dataset.month;

});

});

document.querySelectorAll(".buyPlan").forEach(button=>{

button.addEventListener("click",()=>{

alert("Demo Version: Membership purchase will be available after backend/payment integration.");

});

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".plan-card",{

duration:.8,

opacity:0,

y:50,

stagger:.15,

delay:.4

});

}

});
✅ Required Images
No additional images required.
