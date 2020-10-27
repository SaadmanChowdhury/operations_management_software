var edit_btn=document.querySelector('.clients');
var modal=document.querySelector('#client-modal');
var cross=document.querySelector('#client-modal .cross');

edit_btn.addEventListener("click", client_modal_open);
cross.addEventListener("click", client_modal_close);

function client_modal_open(e){
    e.preventDefault();
    const target=e.target;
    console.log(target);
    const target_parent=e.target.parentElement.parentElement.parentElement;
    console.log(target_parent);
    const target_row= target.childNodes[3];
    console.log(target_row);
    if(target.classList[0]==="edit")
        modal.style.display="block";
}

function client_modal_close(e){
    e.preventDefault();
    modal.style.display="none";
}