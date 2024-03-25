$(document).ready(function(){
    // register user

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
                            window.location.reload();
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
                    $("#loader-login").html('Please wait...');
                    $("#submitbtn-login").hide();
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
                    $("#loader-login").html('');
                    $("#submitbtn-login").show();
                }           
            });
        }
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
});