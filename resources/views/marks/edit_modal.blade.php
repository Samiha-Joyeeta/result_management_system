<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" id="updateMarksForm">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateModalLabel">Update Marks</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="errorMessageContainer">

                </div>
                <input type="hidden" id='edit_id' name='id'>
                <div class="input-group mb-3">
                    <label for="marks" class="input-group-text">Marks</label>
                    <input type="marks" name="marks" class="form-control" id="edit_marks" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark update_marks">Update changes</button>
                </div>
        </div>
        </div>
    </form>
</div>