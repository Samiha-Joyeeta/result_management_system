<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" id="updateUserForm">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateModalLabel">Update User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="errorMessageContainer">

                </div>
                <input type="hidden" id='edit_id' name='id'>
                <div class="input-group mb-3">
                    <label for="email" class="input-group-text">Email</label>
                    <input type="email" name="email" class="form-control" id="edit_email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="username" class="input-group-text">Username</label>
                    <input type="text" name="username" class="form-control" id="edit_username" value="{{ old('username') }}">
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="registration_number" class="input-group-text">Registration Number</label>
                    <input type="number" name="registration_number" class="form-control" id="edit_registration_number" value="{{ old('registration_number') }}">
                    @error('registration_number')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="user_type" class="input-group-text col-4">User Type</label><br>
                    <select name="user_type" id="edit_user_type" class="col-6">
                        <option value="1">Admin</option>
                        <option value="2">Instructor</option>
                        <option value="3">Student</option>
                    </select>
                    @error('user_type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="status" class="input-group-text">User Status</label><br>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="contact_no" class="input-group-text">Contact Number</label>
                    <input id="edit_phone_number" name="phone_number" class="form_control" type="tel" pattern="^01\d{3}-\d{6}$" placeholder="(format: 01xxx-xxxxxx):" required>
                    @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_user">Update changes</button>
            </div>
        </div>
        </div>
    </form>
</div>