$(document).ready(function(){
    // register user

    var base_url = window.location.origin;
    // alert(base_url);

    $('#registerUser').validate({
        rules:{
            name:"required",
            email:{
                required:true,
                email:true,
            },
            password:{
                required:true,
                minlength: 8,
                maxlength: 8
            }
        },
        messages:{
            name:"This field is required",
            email:{
                required:"This field is required",
                email:"Please enter a valid email address"
            },
            password:{
                required:"This field is required",
                minlength:"Please enter at least {0} characters",
                maxlength:"Please enter maximum {0} characters"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                beforeSend: function(){
                    $("#loader").html('Please wait...');
                    $("#submitbtn").hide();
                },
                success: function(response) {
                    $("#loader").html('Please wait...');
                    $("#submitbtn").hide();
                    if(response.status==201){
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = base_url+'/admin/login';
                        }, 1000);
                    } else if(response.status==422){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                complete:function(){
                    $("#submitbtn").show();
                    $("#loader").html('');
                }           
            });
        }
    });

    // login user
    $('#loginUser').validate({
        rules:{
            email:{
                required:true,
            },
            password:{
                required:true,
            }
        },
        messages:{
            email:{
                required:"This field is required"
            },
            password:{
                required:"This field is required",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                beforeSend: function(){
                    $("#loader-login").html('Please wait...');
                    $("#submitbtn-login").hide();
                },
                success: function(response) {
                    // alert(JSON.stringify(response));
                    $("#loader-login").html('Please wait...');
                    $("#submitbtn-login").hide();
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = base_url + '/admin/dashboard';
                        }, 1000);
                    } else if(response.status==401){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                complete:function(){
                    $("#loader-login").html('');
                    $("#submitbtn-login").show();
                }           
            });
        }
    });

    // logout user
    $('#logoutUser').on('submit', function(e){   
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response){
                // alert(JSON.stringify(response));
                if(response.status == 200){
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = base_url + '/admin/login';
                    }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                toastr.error('Error: ' + errorThrown);
            }
        });
    });

    // send reset link
    $('#send-reset-link').validate({
        rules:{
            email:{
                required:true,
                email:true,
            }
        },
        messages:{
            email:{
                required:"This field is required",
                email:"Please enter a valid email address"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                beforeSend: function(){
                    $("#loader-reset").html('Please wait...');
                    $("#submitbtn-reset").hide();
                },
                success: function(response) {
                    $("#loader-reset").html('Please wait...');
                    $("#submitbtn-reset").hide();
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else if(response.status==401){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                complete:function(){
                    $("#loader-reset").html('');
                    $("#submitbtn-reset").show();
                }           
            });
        }
    });

    // change password
    $('#change-password').validate({
        rules:{
            new_password:{
                required:true,
                minlength:8,
                maxlength:8
            }
        },
        messages:{
            new_password:{
                required:"This field is required",
                minlength:"Please enter at least {0} characters",
                maxlength:"Please enter at most {0} characters"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                beforeSend: function(){
                    $("#change-password-loader").html('Please wait...');
                    $("#submitbtn-password").hide();
                },
                success: function(response) {
                    $("#change-password-loader").html('Please wait...');
                    $("#submitbtn-password").hide();
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else if(response.status==401){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                complete:function(){
                    $("#change-password-loader").html('');
                    $("#submitbtn-password").show();
                }           
            });
        }
    });

    // update profile
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} kb');

    $('#update-profile').validate({
        rules:{
            name:{
                required:true,
            },
            username:{
                required:true,
            },
            profile_picture:{
                filesize: 200000
            }
        },
        messages:{
            name:{
                required:"Name field is required",
            },
            username:{
                required:"Username field is required",
            },
            profile_picture:{
                extension: "allowed file extension only jpg, jpeg and png format",
            }
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: form.method,
                contentType: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function(){
                    $("#loader").html('Please wait...');
                    $("#hide-btn").hide();
                },
                success: function(response) {
                    // alert(JSON.stringify(response));
                    $("#loader").html('Please wait...');
                    $("#hide-btn").hide();
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload();
                        },1000)
                    } else if(response.status==500){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                complete:function(){
                    $("#loader").html('');
                    $("#hide-btn").show();
                }           
            });
        }
    });

    // teacher add edit  profile view
    $('.action_type').on('click', function(){
        var url = $(this).data('url');
        $.ajax({
            url:url,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                console.log(response);
            }
        });
    });

});

    // preview image
function previewImage(id, input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}