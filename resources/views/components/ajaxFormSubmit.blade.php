<script>

$(document).ready(function($){
    $("#{{$formId}}").on("submit",function (e) {

        e.preventDefault();
        const invalidFields = $(this).find('[required]').filter(function() {
            return !this.checkValidity();
        });

        // Remove validation classes from all fields
        $(this).find(':input').removeClass('is-valid is-invalid');

        if (invalidFields.length > 0) {
            e.stopPropagation();
            $('html, body').animate({
                    scrollTop: $(`#${invalidFields[0].name}`).offset().top - 300
            }, 777);
            $(invalidFields[0]).focus();
        }
        else
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var form = $('#{{$formId}}');
        var formData = new FormData(this);
        var url = form.attr('action');
        var method = form.attr('method');
        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#loader').removeClass('hide');
            },
            success: function(response, status, jqXHR) {

                if(jqXHR.status == 201)
                {
                    form.trigger('reset');
                    $('.image_privew img').each(function() {
                        $(this).attr('src', "{{ asset('media/default/No_image_available.png') }}");
                    });
                }
                toastr.success(response.success);
                $(this).find(':input').removeClass('is-valid is-invalid');
                $(".{{$formId}}").removeClass('was-validated');
                $('.content-main-outer').animate({
                    scrollTop: jQuery("body").offset().top
                }, 777);
            },
            error: function(response, textStatus, errorThrown) {
                $(this).find(':input').removeClass('is-valid is-invalid');
                if(response.status == 422)
                {
                    var error = 0;
                    $.each(response.responseJSON.errors, function(key, value) {
                        if(error === 0)
                        {
                            $('#loader').addClass('hide');
                            $(`#${key}`).focus();
                            $('html, body').animate({
                                // scrollTop: $(`#${key}`).offset().top - 100
                            }, 1000);
                        }
                        toastr.error(value);
                    });
                }
                else if(response.status == 404)
                {
                    toastr.error("Requested action not available<br><small>Please contact adminstrator</small>");
                }
                else if(response.status == 500)
                {
                    toastr.error("Internal server error<br><small>Please try again after sometime</small>");
                }
                else if(response.status == 400)
                {
                    toastr.error(response.responseJSON.error);
                }
                else
                {
                    toastr.error("Something went wrong<br><small>Please contact adminstrator</small>");
                }
            },
            complete: function (data) {
                $('#loader').addClass('hide');
            }

        });
        }
        $(this).addClass('was-validated');

    });
});
</script>
