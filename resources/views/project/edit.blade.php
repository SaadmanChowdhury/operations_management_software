<div class="modal-container" id="project-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">案件編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('project-edit-modal')"></span>
    </div>

    <div class="modal-form-container _project">
        <form id="edit_form" action="" method="">
            @csrf
            <div class="row">

                <div class="column left">
                    LEFT SIDE OF THE COLUMN
                </div>

                <div class="column right">
                    <div>
                        <input type="hidden" id="project_id" value="{{ $project->project_id }}">
                        <label for="project_name">Project Name</label>
                        <input type="text" id="project_name" name="project_name" value="{{ $project->project_name }}"
                            required>
                    </div>

                    <div>
                        <label>Client:</label>
                        <select id="client_id" name="client_id">
                            <option value="">Select Client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->client_id }}"
                                {{ $project->client_id == $client->client_id ? 'selected' : '' }}>
                                {{ $client->client_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Manager:</label>
                        <select id="manager_id" name="manager_id">
                            <option value="">Select Manager</option>
                            @foreach ($managers as $manager)
                            <option value="{{ $manager->user_id }}"
                                {{ $project->manager_id == $manager->user_id ? 'selected' : '' }}>
                                {{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sales_total">Sales total</label>
                        <input type="text" id="sales_total" name="sales_total" value="{{ $project->sales_total }}"
                            required>
                    </div>

                    <div>
                        <button type="submit" onclick="updateProject()">
                            更新
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>

<script>
    // function projectEditModalHandler(projectID) {
        // event.preventDefault();
        // event.stopPropagation();
        // clearModalData('project-edit-modal');
        // showModal('project-edit-modal');

        // getProjectData(projectID);
    // }

    function getEditFormData() {
        return {
            project_id: $('#project_id').val(),
            project_name: $('#project_name').val(),
            client_id: $('#client_id').val(),
            manager_id: $('#manager_id').val(),
            sales_total: $('#sales_total').val(),
            _token: $('input[name=_token]').val()
        };
    }


    function updateProject() {
        event.preventDefault();
        data = getEditFormData();

        $.ajax({
            type: "post",
            url: "/API/updateProject",
            data: data,
            cache: false,
            success: function(response) {
                console.log(response["resultStatus"]["isSuccess"]);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>
