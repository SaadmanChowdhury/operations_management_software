///====VARIABLES====////
const edit_btn=document.querySelector('.clients');
const modal=document.querySelector('#client-modal'); //client modal
const cross=document.querySelector('#client-modal .cross'); //cross button
const input_company=document.getElementsByName('company_name'); //company input field name
const input_contact=document.getElementsByName('contact_person'); //contact person field name
const code=document.querySelector('.client-code') // client code
const order=document.querySelector('.client-order') // client code
const profit=document.querySelector('.client-profit') // client code

///====EVENT LISTENER====////
// edit_btn.addEventListener("click", client_modal_open);
// cross.addEventListener("click", client_modal_close);


///====MODAL OPEN ACTION====////
function client_modal_open(e){
    e.preventDefault();
    code.innerText="コード: ";
    order.innerText="受注顧合計: ";
    profit.innerText="実績粗利: ";

    const target=e.target;
    //console.log(target);
    const target_parent=e.target.parentElement.parentElement.parentElement;
    //console.log(target_parent);
    const child=Array.prototype.slice.call(target_parent.children);
    const target_code= child[0]; //client-code
    const target_company= child[1]; //company name
    const target_contact= child[2] //contact person
    const target_orders= child[3] //orders
    const target_profit= child[4]; //profit
    code.innerText=code.innerText+target_code.innerText;
    order.innerText=order.innerText+target_orders.innerText;
    profit.innerText=profit.innerText+target_profit.innerText; 

    input_company[0].value=target_company.innerText; //Initial company input value from list
    input_contact[0].value=target_contact.innerText; //Initial contact input value from list

    //Opening modal 
    if(target.classList[0]==="edit")
        modal.style.display="block";
}


///====MODAL CLOSE ACTION====////
function client_modal_close(e){
    e.preventDefault();
    modal.style.display="none";

    const submitButton = document.getElementById('client-submit-button'); //submit button
    const deleteButton = document.getElementById('client-delete-button'); //delete button

    //event listeners in modal
    submitButton.addEventListener('click', saveData);
    deleteButton.addEventListener('click', deleteData);
    
    //Delete function
    function deleteData(e) {
        e.preventDefault();
        var myobj = document.getElementById("client-row");
        myobj.remove();
    }

    //Save function
    function saveData(e) {
        e.preventDefault();
        const savedData = {
            company_name: input_company[0].value,
            contact_person: input_contact[0].value
        };
        console.log(savedData);
    }

}

function fetchClientList_AJAX() {
    $.ajax({
        type: "post",
        url: "/API/fetchClientList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response) {
            if (response["resultStatus"]["isSuccess"]) {
                renderClientHTML(response);
            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}

function renderClientHTML(response){




    rowClientHTML=`<div class="card _client" id="client-row-${response.clientID}">`+
    `<div class="card-header">`+
        `<div class="display list-unstyled">`+
            `<li>${response.clientID}</li>`+
            `<li>${response.clientName}</li>`+
            `<li>
                <img src="img/pro_icon.png" class="smallpic">
                <div class="user-name">
                    ${response.clientID}
                </div>
                
            </li>`+

            
                `<li>${response.totalSales} 円</li>`+
                `<li>${response.totalProfit} 円</li>`+

                `<li>
                    <div class="edit" onclick="clientEditModalHandler(${response.clientID})">
                        <span style="font-size: 11px; margin:6px;width:auto"
                            class="fa fa-pencil"></span>編集
                    </div>
                </li>`+
            
                `<li class="transparent">円</li>
                <li class="transparent">円</li>`+

                `<li>
                    <div class="edit transparent">
                        <span style="font-size: 11px; margin:6px;width:auto"
                            class="fa fa-pencil"></span>編集
                    </div>
                </li>`+
            
            
        `</div>
    </div>
</div>`;


}