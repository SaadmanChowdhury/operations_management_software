<div class="modal-container" id="project-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">案件編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('project-edit-modal')"></span>
    </div>

    <div class="modal-form-container _project">
        <form id="edit_form" action="" method="">
            @csrf





        </form>
    </div>

</div>



<script>
    function projectEditModalHandler(projectID) {
        event.preventDefault();
        event.stopPropagation();
        // clearModalData('project-edit-modal');
        showModal('project-edit-modal');

        // getProjectData(projectID);
    }

</script>
