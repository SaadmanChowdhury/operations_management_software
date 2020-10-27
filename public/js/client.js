var edit_btn=document.querySelector('.clients .edit');
var modal=document.querySelector('#client-modal');
var cross=document.querySelector('#client-modal .cross');

edit_btn.addEventListener("click", client_modal_open);
cross.addEventListener("click", client_modal_close);

function client_modal_open(e){
    e.preventDefault();
    modal.style.display="block";
}

function client_modal_close(e){
    e.preventDefault();
    modal.style.display="none";
}