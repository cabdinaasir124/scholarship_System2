$(document).ready(function () {
// start the registration request
    $(document).on("submit", "#regform", function(e)
    {
        e.preventDefault();
        //storing the form data 
        let formdata = new FormData(this);
        // telling the action
        formdata.append("action","regf");
        // regf password
        formdata.append("regf","123@#$");
        // changing the sign up button
        $("#btn_save").html("<img width='20px' src='../admin/assets/images/loading-gif.gif'>");
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "apis/auth_api.php",
                data: formdata,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) 
                {
                    if(data.status=="success")
                    {
                       $("#alert").show();
                       $("#alert").removeClass("alert-danger").addClass("alert-success");
                       $("#alert").html(data.message);
                       $("#btn_save").html('<i class="mdi mdi-account-circle"></i> Sign Up ');
                    }
                    else if(data.status=="error")
                    {
                        $("#alert").show();
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").html(data.message);
                        $("#btn_save").html('<i class="mdi mdi-account-circle"></i> Sign Up ');
                    }
                }
            });
        },500)
    });
// End the registration request


});