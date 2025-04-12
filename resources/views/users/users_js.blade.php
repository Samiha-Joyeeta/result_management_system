<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        //Toggle down create user form on click of add new button
        $('#add-new-button').on('click', function() {
            $('#create-user-form').toggle();
            const isFormVisible = $('#create-user-form').is(':visible');
            $(this).text(isFormVisible ? 'Close' : 'Add New');
            $(this).toggleClass('close-button-style', isFormVisible);
        });

        // Form submission
        $('#UserRegistrationForm').on('submit', function(event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('users.register') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('Data added successfully!');
                    $('#create-user-form').hide();
                    $('#add-new-button').text('Add New');
                    $('#UserRegistrationForm')[0].reset();
                    $('.table').load(location.href + ' .table'); 
                },
                error: function(error) {
                    console.error("AJAX error:", error);
                    $('.errorMessageContainer').html(''); 
                    if (error.responseJSON && error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(index, value) {
                            $('.errorMessageContainer').append('<span class="text-danger">' + value + '</span>');
                        });
                    } else {
                        $('.errorMessageContainer').append('<span class="text-danger">An unexpected error occurred.</span>');
                    }
                }
            });
        });

         // Show details in update user details modal
         $(document).on('click', '.update_user_form', function() {
            let id = $(this).data('id');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let registration_number = $(this).data('registration_number');
            let phone_number = $(this).data('phone_number');
            let status = $(this).data('status');
            let user_type = $(this).data('user_type');

            
            $('#edit_id').val(id);
            $('#edit_username').val(username);
            $('#edit_email').val(email);
            $('#edit_registration_number').val(registration_number);
            $('#edit_phone_number').val(phone_number);
            $('#edit_status').val(status);
            $('#edit_user_type').val(user_type);
        });

        // Update user data
        $(document).on('click', '.update_user', function(e) {
            e.preventDefault();

            let id = $('#edit_id').val();
            console.log(id);

            $.ajax({
                url: "{{ route('users.update') }}",
                method: 'PUT',
                data: {
                    id: id,
                    username: $('#edit_username').val(),
                    email: $('#edit_email').val(),
                    registration_number: $('#edit_registration_number').val(),
                    phone_number: $('#edit_phone_number').val(),
                    status: $('#edit_status').val(),
                    user_type: $('#edit_user_type').val(),
                },

                success: function(response) {
                    console.log("AJAX success:", response);
                    if (response.status === "success") {
                        $('#updateModal').modal("hide");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('#updateUserForm')[0].reset();
                        $('.table').load(location.href + ' .table'); 
                    }
                },
                error: function(error) {
                    console.error("AJAX error:", error);
                    $('.errorMessageContainer').html(''); 
                    if (error.responseJSON && error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(index, value) {
                            $('.errorMessageContainer').append('<span class="text-danger">' + value + '</span>');
                        });
                    } else {
                        $('.errorMessageContainer').append('<span class="text-danger">An unexpected error occurred.</span>');
                    }
                }
            });
        });

        //Delete User Data
        $(document).on('click', '.delete_user', function(e) {
            e.preventDefault();
    
            let id =  $(this).data('id');

            if (confirm('Are you sure to delete this user?')) {
                $.ajax({
                url: "{{ route('users.delete') }}",
                method: 'DELETE',
                data: {
                    id: id
                },

                success: function(response) {
                    console.log("AJAX success:", response);
                    if (response.status === "success") {
                        $('.table').load(location.href + ' .table'); 
                    }
                }
            });
            }
        });

        //Frontend Password Validation
        $('#password, #password_confirmation').on('input', function() {
        let password = $('#password').val();
        let confirmPassword = $('#password_confirmation').val();

            if (confirmPassword) {
                if (password === confirmPassword) {
                    $('#match-icon').html('&#10004;').css('color', 'green');
                } else {
                    $('#match-icon').html('&#10006;').css('color', 'red');
                }
            } else {
                $('#match-icon').html('').css('color', '');
            }
        });
    });
</script>


