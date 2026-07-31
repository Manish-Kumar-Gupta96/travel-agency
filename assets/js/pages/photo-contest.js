document.addEventListener("DOMContentLoaded",()=>{

const form=document.getElementById("photoContestForm");

const countdown=document.getElementById("countdown");

const target=new Date("December 31, 2026 23:59:59").getTime();

function updateCountdown(){

const now=new Date().getTime();

const distance=target-now;

if(distance<=0){

countdown.textContent="Contest Closed";

return;

}

const days=Math.floor(distance/(1000*60*60*24));

const hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));

const minutes=Math.floor((distance%(1000*60*60))/(1000*60));

const seconds=Math.floor((distance%(1000*60))/1000);

countdown.textContent=`${days}d ${hours}h ${minutes}m ${seconds}s Remaining`;

}

setInterval(updateCountdown,1000);

updateCountdown();

form.addEventListener("submit",function(e){

e.preventDefault();

alert("Demo Version: Photo upload will be connected after backend integration.");

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".contest-card",{

duration:.8,

opacity:0,

x:-60,

delay:.3

});

gsap.from(".rules-card",{

duration:.8,

opacity:0,

x:60,

delay:.5

});

gsap.from(".prize-card",{

duration:.6,

opacity:0,

y:40,

stagger:.15,

delay:.8

});

gsap.from(".gallery-grid img",{

duration:.8,

opacity:0,

scale:.9,

stagger:.12,

delay:1.1

});

}

});
✅ Required Images
assets/images/photo-contest/winner-1.jpg

assets/images/photo-contest/winner-2.jpg

assets/images/photo-contest/winner-3.jpg
