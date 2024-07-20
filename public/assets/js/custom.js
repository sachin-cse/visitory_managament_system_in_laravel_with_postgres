$(document).ready(function(){
    // register user

    var base_url = window.location.origin;
    // alert(base_url);

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        }
      );

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
                            window.location.reload(true);
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

    // add or update profile
    $('#save_data').validate({
        rules:{
            name:{
                required:true,
                minlength:6,
                regex:'^[a-zA-Z ]',
            },
            phone:{
                required:true,
                regex:'^[0-9]{10,15}$',
                minlength:10,
                maxlength:15,
            },
            gender:{
                required:true,
            },
            teacher_status:{
                required:true,
            },
            dateofbirth:{
                required:true,
            },
            current_address:{
                required:true,
            },
            permanent_address:{
                required:true,
            },
            profile_picture:{
                required:true,
                filesize: 200000
            }
        },
        messages:{
            name:{
                required:"Please enter your name",
                minlength:"Invalid name",
                regex:"Please enter your name properly"
            },
            phone:{
                required:"Please enter your phone number",
                minlength:"Phone number at least {0} characters long",
                maxlength:"Phone number at most {0} characters long",
                regex:"Invalid phone number",
            },
            gender:{
                required:"Please choose your gender",
            },
            teacher_status:{
                required:"Please choose status"
            },
            dateofbirth:{
                required:"Please select your date of birth",
            },
            current_address:{
                required:"Please enter your current address",
            },
            permanent_address:{
                required:"Please enter your permanent address",
            },
            profile_picture:{
                required:"Please upload your profile picture",
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
                success: function(response) {
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },1000)
                    } else if(response.status==500){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }         
            });
        }
    });

    // delete data
    $('.delete-user').on('click', function(e){
        e.preventDefault();
        var dataUrl = $(this).attr('data-url');
        var value = confirm('Are you sure you want to delete this?');
        if(value){
            $.ajax({
                url:dataUrl,
                type:'GET',
                success:function(response){
                    if(response.status == 200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },1000)
                    }else{
                        toastr.error('data not found');
                    }
                }
            });
        }
    });

    // change status
    $('.change-status').on('click', function(e){
        e.preventDefault();
        var dataUrl = $(this).attr('data-url');
        var dataValue = $(this).attr('data-value');
        $.ajax({
            url:dataUrl,
            type:'GET',
            data:{statusVal:dataValue},
            success:function(response){
                if(response.status == 200){
                    toastr.success(response.message);
                    setTimeout(function(){
                        window.location.reload(true);
                    },1000)
                }else{
                    toastr.error('data not found');
                }
            }
        });
        
    });

    // close modal
    $('.close-model').on('click', function(){
        $('#UserRoleModel').modal('hide');
    });

    // set user role
    $('.show_user_model').on('click', function(){

        var dataId = $(this).data('value');
        var dataUrl = $(this).data('url');
        $.ajax({
            type:'GET',
            url:dataUrl,
            dataType:'json',
            data:{id:dataId},
            success:function(data){
                console.log(data);
                $('#user_email').val(data.teacherData.email);
                $('#user_type').val(data.teacherData.type);
                $('#user_name').val(data.teacherData.username);
                $('#hidden_id').val(data.teacherData.id);
                $('#hidden_id').val(data.teacherData.id);
                $('#teacher_id').val(data.teacherData.teacher.id);
            }

        });
        $('#UserRoleModel').modal('show');
    });

    // password show and hide
    $(document).on('click', '.toggle-password',function(){
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $('.password');
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    });

    // set user role
    $('#user_role').validate({
        rules:{
            username:{
                required:true,
                regex:'^[a-zA-Z0-9 ]',
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                maxlength:8,
            }
        },
        messages:{
            username:{
                required:"Please enter your username name",
                regex:"Please enter your username properly"
            },
            email:{
                required:"Please enter your email address",
                email:"Please enter your valid email address",
            },
            password:{
                required:"Please enter your password",
                maxlength:"Please enter your password maximum 8 characters long"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $('form').serialize(),
                success: function(response) {
                    if(response.status==200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },1000)
                    } else if(response.status==500){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }         
            });
        }
    });

    // send save subject request
     $('#teacher_save_data').validate({
        rules:{
            subject_name:{
                required:true,
                regex:'^[a-zA-Z0-9 ]',
            },
            subject_code:{
                required:true,
                regex:'^[a-zA-Z0-9 ]',
            },
            teacher_id:{
                required:true,
            },
            subject_description:{
                required:true,
            }
        },
        messages:{
            name:{
                required:"Please enter your subject name",
                regex:"Please enter your subject name properly"
            },
            subject_name:{
                required:"Please enter your subject code",
                regex:"Please enter your subject code properly",
            },
            teacher_id:{
                required:"Please select teacher",
            },
            subject_description:{
                required:"Please enter subject description",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType:'json',
                data: $('form').serialize(),
                success: function(response) {
                    if(response.status==200 && response.flag !== 'error'){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },1000)
                    } else if(response.status==500){
                        toastr.error(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }         
            });
        }
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