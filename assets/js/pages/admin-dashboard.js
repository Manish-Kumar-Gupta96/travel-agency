document.addEventListener("DOMContentLoaded",()=>{


document.querySelectorAll(".quick-actions button")
.forEach(button=>{


button.addEventListener("click",()=>{


alert(

button.textContent.trim()+" action selected"

);


});


});





document.querySelectorAll(".admin-sidebar li")
.forEach(item=>{


item.addEventListener("click",()=>{


document.querySelectorAll(".admin-sidebar li")
.forEach(li=>li.classList.remove("active"));


item.classList.add("active");


});


});





if(typeof gsap!=="undefined"){


gsap.from(".admin-sidebar",{

x:-80,

opacity:0,

duration:.8

});



gsap.from(".dashboard-card",{

y:40,

opacity:0,

stagger:.15,

duration:.7

});



gsap.from(".admin-grid",{

y:40,

opacity:0,

duration:.8,

delay:.5

});



gsap.from(".notification-panel",{

y:30,

opacity:0,

duration:.8,

delay:.8

});


}


});
