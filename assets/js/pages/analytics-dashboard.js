document.addEventListener("DOMContentLoaded",()=>{


if(typeof gsap!=="undefined"){



gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});



gsap.from(".analytics-card",{

duration:.7,

opacity:0,

y:40,

stagger:.15

});



gsap.from(".chart-card",{

duration:.8,

opacity:0,

x:-50,

delay:.5

});



gsap.from(".performance-card",{

duration:.8,

opacity:0,

x:50,

delay:.7

});



gsap.from(".report-card",{

duration:.8,

opacity:0,

y:40,

delay:1

});



}





document.querySelectorAll(".analytics-card h2").forEach(counter=>{


const text=counter.textContent;


counter.addEventListener("mouseenter",()=>{


counter.style.transform="scale(1.08)";


});


counter.addEventListener("mouseleave",()=>{


counter.style.transform="scale(1)";


});


});



});
