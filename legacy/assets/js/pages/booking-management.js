document.addEventListener("DOMContentLoaded",()=>{


/*=========================================
BOOKING SEARCH
=========================================*/


const searchInput=document.getElementById("bookingSearch");

const rows=document.querySelectorAll("#bookingTable tr");



searchInput.addEventListener("keyup",()=>{


const value=searchInput.value.toLowerCase();



rows.forEach(row=>{


const text=row.textContent.toLowerCase();



if(text.includes(value)){


row.style.display="";


}

else{


row.style.display="none";


}


});


});






/*=========================================
STATUS FILTER
=========================================*/


const statusFilter=document.getElementById("statusFilter");



statusFilter.addEventListener("change",()=>{


const selected=statusFilter.value;



rows.forEach(row=>{


const status=row.dataset.status;



if(selected==="all" || status===selected){


row.style.display="";


}

else{


row.style.display="none";


}



});


});






/*=========================================
BOOKING DETAILS
=========================================*/


rows.forEach(row=>{


row.addEventListener("click",()=>{


const bookingId=row.children[0].textContent;

const customer=row.children[1].textContent;



alert(

"Booking Details\n\nID: "

+bookingId+

"\nCustomer: "

+customer

);



});


});






/*=========================================
STAT COUNTER ANIMATION
=========================================*/


const counters=document.querySelectorAll(".booking-stat-card h2");



counters.forEach(counter=>{


const target=parseInt(counter.textContent.replace(",",""));

let count=0;



const interval=setInterval(()=>{


count+=Math.ceil(target/80);



if(count>=target){


count=target;

clearInterval(interval);


}



counter.textContent=count.toLocaleString();



},20);



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





gsap.from(".booking-stat-card",{


duration:.7,

opacity:0,

y:40,

stagger:.15,

delay:.3


});





gsap.from(".booking-tools",{


duration:.8,

opacity:0,

y:30,

delay:.8


});





gsap.from(".booking-table-card",{


duration:.8,

opacity:0,

x:-50,

delay:1


});





gsap.from(".trip-card",{


duration:.8,

opacity:0,

y:40,

delay:1.2


});



}



});
