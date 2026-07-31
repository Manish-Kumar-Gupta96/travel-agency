document.addEventListener("DOMContentLoaded",()=>{

const sos=document.getElementById("sosButton");

sos.addEventListener("click",e=>{

e.preventDefault();

alert("Demo Version: SOS service will be connected with emergency support after backend/API integration.");

});

document.querySelectorAll(".contact-card a").forEach(link=>{

link.addEventListener("click",e=>{

e.preventDefault();

alert("Demo Version: Contact details will be loaded dynamically.");

});

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".contact-card",{

duration:.8,

opacity:0,

y:40,

stagger:.15,

delay:.4

});

gsap.from(".tips-card",{

duration:1,

opacity:0,

y:50,

delay:.9

});

}

});
✅ Required Images
No additional images required.
