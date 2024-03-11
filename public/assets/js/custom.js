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
});