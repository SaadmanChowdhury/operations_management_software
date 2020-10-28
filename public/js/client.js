///====VARIABLES====////
let edit_btn=document.querySelector('.clients');
let modal=document.querySelector('#client-modal');
let cross=document.querySelector('#client-modal .cross');
let input_company=document.getElementsByName('company_name');
let input_contact=document.getElementsByName('contact_person');
let code=document.querySelector('.client-code')

///====EVENT LISTENER====////
edit_btn.addEventListener("click", client_modal_open);
cross.addEventListener("click", client_modal_close);

function client_modal_open(e){
    e.preventDefault();
    code.innerText="コード: ";
    
    const target=e.target;
    console.log(target);
    const target_parent=e.target.parentElement.parentElement.parentElement;
    console.log(target_parent);
    const target_code= target_parent.childNodes[1];
    const target_company= target_parent.childNodes[3];
    const target_contact= target_parent.childNodes[5];
    code.innerText=code.innerText+target_code.innerText;
    input_company[0].value=target_company.innerText;
    input_contact[0].value=target_contact.innerText;
    if(target.classList[0]==="edit")
        modal.style.display="block";
}



function client_modal_close(e){
    e.preventDefault();
    modal.style.display="none";




    const submitButton = document.getElementById('client-submit-button');
    const deleteButton = document.getElementById('client-delete-button');

    submitButton.addEventListener('click', saveData);
    deleteButton.addEventListener('click', deleteData);

    function deleteData(e) {
        e.preventDefault();
        var myobj = document.getElementById("client-row");
        myobj.remove();
    }

    function saveData(e) {
        e.preventDefault();
        const savedData = {
            company_name: input_company[0].value,
            contact_person: input_contact[0].value
        };
        console.log(savedData);
    }


}