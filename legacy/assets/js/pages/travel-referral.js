document.addEventListener("DOMContentLoaded",()=>{

const copyBtn=document.getElementById("copyCode");

const code=document.getElementById("referralCode").textContent;

copyBtn.addEventListener("click",()=>{

navigator.clipboard.writeText(code);

copyBtn.innerHTML='<i class="fa-solid fa-check"></i> Copied';

setTimeout(()=>{

copyBtn.innerHTML='<i class="fa-solid fa-copy"></i> Copy';

},2000);

});

document.querySelectorAll(".share-buttons button").forEach(button=>{

button.addEventListener("click",()=>{

alert("Demo Version: Social sharing will be connected after backend integration.");

});

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".referral-card",{

duration:.8,

opacity:0,

x:-50,

delay:.3

});

gsap.from(".stats-card",{

duration:.8,

opacity:0,

x:50,

delay:.5

});

gsap.from(".history-card",{

duration:.8,

opacity:0,

y:40,

delay:.8

});

}

});
✅ Required Images
No additional images required.
