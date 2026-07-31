document.addEventListener("DOMContentLoaded",()=>{

document.getElementById("forumSearch").addEventListener("submit",e=>{

e.preventDefault();

alert("Demo Version: Forum search will be connected after backend integration.");

});

document.getElementById("newPostBtn").addEventListener("click",()=>{

alert("Demo Version: Create post feature will be available after user authentication.");

});

document.querySelectorAll(".tags span").forEach(tag=>{

tag.addEventListener("click",()=>{

alert("Showing posts for "+tag.textContent);

});

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".forum-sidebar",{

duration:.8,

opacity:0,

x:-50,

delay:.3

});

gsap.from(".thread-card",{

duration:.7,

opacity:0,

y:35,

stagger:.15,

delay:.5

});

}

});
✅ Required Images
No additional images required.
