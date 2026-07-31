document.addEventListener("DOMContentLoaded",()=>{

const progress=document.getElementById("rewardProgress");

setTimeout(()=>{

progress.style.width="78%";

},500);

document.getElementById("redeemBtn").addEventListener("click",()=>{

alert("Demo Version: Reward redemption will be connected after backend integration.");

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".reward-card",{

duration:.8,

opacity:0,

x:-50,

delay:.3

});

gsap.from(".history-card",{

duration:.8,

opacity:0,

x:50,

delay:.5

});

gsap.from(".badge-card",{

duration:.6,

opacity:0,

y:30,

stagger:.12,

delay:.8

});

}

});
✅ Required Images
No additional images required.
