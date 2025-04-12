<div id="create-user-form" style="display: none;">
    <div class="container">
        <div class="card justify-content-center">
            <div class="card-body">
                <h2 class="text-center">Create User</h2>
                <div class="errorMessageContainer">

                </div>
                <form class="row g-3" id="UserRegistrationForm">
                    @csrf
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                        <span id="emailError" class="text-danger" style="display:none; font-size: 0.875rem;">Invalid email format</span>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" id="password">
                        <p class="fs-6 text-warning poppins-extralight password-note">Note: Password must be minimum 8 characters containing uppercase, lowercase letters, numbers and special characters</p>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <span id="match-icon" style="font-size: 0.75rem; margin-left: 10px;"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="user_type" class="form-label">User Type</label><br>
                        <select name="user_type" id="user_type" class="form-select">
                            <option value="1">Admin</option>
                            <option value="2">Instructor</option>
                            <option value="3">Student</option>
                        </select>
                        @error('user_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="registration_number" class="form-label">Registration Number</label>
                        <input type="number" name="registration_number" class="form-control" id="registration_number" value="{{ old('registration_number') }}">
                        @error('registration_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="department" class="form-label">Department</label><br>
                        <select name="department_id" id="department" class="form-select">
                            @foreach ($departments as $department)
                                <option value={{ $department->id }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="semester" class="form-label">Semester</label><br>
                        <select name="semester_id" id="semester" class="form-select">
                            @foreach ($semesters as $semester)
                                <option value={{ $semester->id }}>{{ $semester->name }}</option>
                            @endforeach
                                <option value="">Null For Instructor</option>
                        </select>
                        @error('semester')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="session" class="form-label">Session</label><br>
                        <select name="session" id="session" class="form-select">
                                <option value="2018-2019">2018-2019</option>
                                <option value="2019-2020">2019-2020</option>
                                <option value="2020-2021">2020-2021</option>
                                <option value="2021-2022">2021-2022</option>
                                <option value="2022-2023">2022-2023</option>
                                <option value="">Null For Instructor</option>
                        </select>
                        @error('session')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Contact Number</label>
                        <input id="phone_number" name="phone_number" class="form-control" type="tel" pattern="^01\d{3}-\d{6}$" placeholder="(format: 01xxx-xxxxxx):" required>
                        @error('phone_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark text-center" id="store-user">Submit</button>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/validation.js') }}"></script>