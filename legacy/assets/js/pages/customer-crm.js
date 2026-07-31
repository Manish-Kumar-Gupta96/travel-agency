document.addEventListener("DOMContentLoaded",()=>{


const search=document.getElementById("customerSearch");

const filter=document.getElementById("customerFilter");

const cards=document.querySelectorAll(".customer-card");



function filterCustomers(){


const searchValue=search.value.toLowerCase();

const filterValue=filter.value;



cards.forEach(card=>{


const name=card.querySelector("h3").textContent.toLowerCase();

const type=card.dataset.type;



const matchName=name.includes(searchValue);

const matchType=
filterValue==="all" || type===filterValue;



if(matchName && matchType){

card.style.display="block";

}

else{

card.style.display="none";

}


});


}



search.addEventListener("keyup",filterCustomers);

filter.addEventListener("change",filterCustomers);





document.querySelectorAll(".customer-view").forEach(button=>{


button.addEventListener("click",()=>{


const customer=
button.closest(".customer-card")
.querySelector("h3")
.textContent;



alert(
"Customer Profile: "+customer
);


});


});





if(typeof gsap!=="undefined"){


gsap.from(".hero-content",{

opacity:0,

y:60,

duration:1

});


gsap.from(".crm-stat",{

opacity:0,

y:40,

stagger:.15,

duration:.7

});


gsap.from(".customer-card",{

opacity:0,

scale:.9,

stagger:.15,

delay:.5

});


}


});
