document.addEventListener("DOMContentLoaded",()=>{

document.querySelectorAll(".tour-item").forEach(item=>{

item.addEventListener("click",()=>{

alert("Demo Version: Tour details will be available after backend integration.");

});

});

document.querySelectorAll(".customers-card tr").forEach((row,index)=>{

if(index===0) return;

row.addEventListener("click",()=>{

alert("Demo Version: Customer profile will open after authentication.");

});

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".stat-card",{

duration:.7,

opacity:0,

y:40,

stagger:.15,

delay:.3

});

gsap.from(".commission-card",{

duration:.8,

opacity:0,

x:-50,

delay:.6

});

gsap.from(".customers-card",{

duration:.8,

opacity:0,

x:50,

delay:.8

});

gsap.from(".tour-card",{

duration:.8,

opacity:0,

y:40,

delay:1

});

}

});
✅ Required Images
No additional images required.
