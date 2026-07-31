document.addEventListener("DOMContentLoaded",()=>{

const amount=document.getElementById("voucherAmount");

const custom=document.getElementById("customAmount");

const form=document.getElementById("voucherForm");

amount.addEventListener("change",()=>{

if(amount.value==="custom"){

custom.style.display="block";

}else{

custom.style.display="none";

}

});

form.addEventListener("submit",e=>{

e.preventDefault();

const recipient=document.getElementById("recipientName").value;

const message=document.getElementById("giftMessage").value;

let value=amount.value;

if(value==="custom"){

value=custom.value||0;

}

document.getElementById("previewRecipient").textContent="Recipient: "+recipient;

document.getElementById("previewAmount").textContent="₹"+Number(value).toLocaleString("en-IN");

document.getElementById("previewMessage").textContent=message||"Best wishes for your next adventure.";

alert("Voucher Preview Generated Successfully.");

});

document.getElementById("downloadVoucher").addEventListener("click",()=>{

alert("Demo Version: PDF download will be available after backend integration.");

});

document.getElementById("printVoucher").addEventListener("click",()=>{

window.print();

});

if(typeof gsap!=="undefined"){

gsap.from(".hero-content",{

duration:1,

opacity:0,

y:60

});

gsap.from(".voucher-form-card",{

duration:.8,

opacity:0,

x:-60,

delay:.3

});

gsap.from(".voucher-preview-card",{

duration:.8,

opacity:0,

x:60,

delay:.5

});

}

});
✅ Required Images
No additional images required.
