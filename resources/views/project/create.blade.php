<div class="modal-container" id="project-create-modal">

    <div class="modal-title primary">
        <span class="form-ht">クライアント登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('project-create-modal')"></span>
    </div>

    <div class="modal-form-container _project">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/project_dp.png') }}" class="dp _project" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="createProject()"><i class="fa fa-floppy-o"
                                aria-hidden="true"></i>
                            登録</button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('project-create-modal')"><i
                                class="fa fa-times" aria-hidden="true"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right _project">

                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">案件名</label></div>
                            <div><input type="text" id="project_create_name_Input" name="name" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container _dark">
                        <div class="_half">
                            <div><label for="client_id">顧客</label></div>
                            <div><input type="number" id="project_create_clientID_Input" name="client_id" required>
                            </div>
                        </div>
                        <div class="_half">
                            <div><label for="manager_id">担当</label></div>
                            <div><input type="number" id="project_create_managerID_Input" name="manager_id" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_third">
                            <div><label>見込</label></div>
                            <div class="custom-select">
                                <select id="project_create_order_status_Input" required>
                                    @foreach (config('constants.Order_Status') as $status => $value)
                                        <option>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label>営業状況</label></div>
                            <div class="custom-select">
                                <select id="project_create_business_situation_Input" required>
                                    @foreach (config('constants.Business_situation') as $situation => $value)
                                        <option>{{ $situation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="development_stage">作業工程</label></div>
                            <div class="custom-select">
                                <select id="project_create_development_stage_Input" required>
                                    @foreach (config('constants.Development_stage') as $stage => $value)
                                        <option>{{ $stage }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container _dark">

                        <div class="_third">
                            <div><label for="sales_total">売上高</label></div>
                            <div><input type="number" id="project_create_sales_total_Input" name="sales_total" required>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="transferred_amount">振込金額</label></div>
                            <div><input type="number" id="project_create_transferred_amount_Input"
                                    name="transferred_amount" required></div>
                        </div>

                        <div class="_third">
                            <div><label for="budget">予算</label></div>
                            <div><input type="number" id="project_create_budget_Input" name="budget" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="order_month">受注月</label></div>
                            <div><input type="date" id="project_create_order_month_Input" name="inspection_month"
                                    required></div>
                        </div>

                        <div class="_half">
                            <div><label for="inspection_month">検収月</label></div>
                            <div><input type="date" id="project_create_inspection_month_Input" name="inspection_month"
                                    required></div>
                        </div>
                    </div>

                </div>

            </div>
            <div id="message"></div>

        </form>
    </div>
</div>



<script>
    $(function() {
        convertToSearchableDropDown("project_create_managerID_Input", "USER");
        convertToSearchableDropDown("project_create_clientID_Input", "CLIENT");
    })

    function ProjectRegisterModalHandler() {
        event.preventDefault();
        showModal('project-create-modal');
    }

    function getProjectRegFormData() {
        return {
            project_name: $('#project_create_name_Input').val(),
            client_id: $('#project_create_clientID_Input').val(),
            manager_id: $('#project_create_managerID_Input').val(),
            order_month: $('#project_create_order_month_Input').val(),
            inspection_month: $('#project_create_inspection_month_Input').val(),
            order_status: $('#project_create_order_status_Input').val(),
            business_situation: $('#project_create_business_situation_Input').val(),
            development_stage: $('#project_create_development_stage_Input').val(),
            sales_total: $('#project_create_sales_total_Input').val(),
            transferred_amount: $('#project_create_transferred_amount_Input').val(),
            budget: $('#project_create_budget_Input').val(),
            _token: $('input[name=_token]').val()
        };
    }


    function handleAJAXResponse(response) {
        if (response["resultStatus"]["isSuccess"])
            $('#message').html("Operation Succesful");
        else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
            $('#message').html("You are not authorized to make this change");
        else
            $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
    }


    function handleAJAXError(err) {
        console.log(err);

        if (err.status == "422") {
            if (err.responseJSON.errors.email != null) {
                $('#message').html(err.responseJSON.errors.email);
            }
            /*
            if (err.responseJSON.errors.client_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }*/
        }
    }


    function createProject() {
        event.preventDefault();
        modalData = getProjectRegFormData();

        $.ajax({
            type: "post",
            url: "/API/createProject",
            data: modalData,
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"]) {
                    // updateProjectTable(modalData);
                    closeModal('project-create-modal');
                } else
                    handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>
