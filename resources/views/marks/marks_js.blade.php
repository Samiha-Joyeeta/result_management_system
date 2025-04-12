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
         // Show marks in update marks details modal
         $(document).on('click', '.update_marks_form', function() {
            let id = $(this).data('id');
            let marks = $(this).data('marks');

            $('#edit_id').val(id);
            $('#edit_marks').val(marks);
        });

        // Update marks data
        $(document).on('click', '.update_marks', function(e) {
            e.preventDefault();

            let id = $('#edit_id').val();

            $.ajax({
                url: "{{ route('marks.update') }}",
                method: 'PUT',
                data: {
                    id: id,
                    marks: $('#edit_marks').val(),
                },

                success: function(response) {
                    console.log("AJAX success:", response);
                    if (response.status === "success") {
                        $('#updateModal').modal("hide");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').removeClass('modal-open').css('overflow', 'auto');
                        $('#updateMarksForm')[0].reset();
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

        //Delete Data
        $(document).on('click', '.delete_marks', function(e) {
            e.preventDefault();
    
            let id =  $(this).data('id');

            if (confirm('Are you sure to delete this marks details of the student?')) {
                $.ajax({
                url: "{{ route('marks.delete') }}",
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
    });
</script>


