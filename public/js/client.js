var reg_btn=document.querySelector('#client-list .register-btn');
var modal=document.querySelector('#client-modal');
var cross=document.querySelector('#client-modal .cross');

console.log(modal);
reg_btn.addEventListener("click", client_modal_open);
cross.addEventListener("click", client_modal_close);

function client_modal_open(e){
    e.preventDefault();
    modal.style.display="block";
}

function client_modal_close(e){
    e.preventDefault();
    modal.style.display="none";
}