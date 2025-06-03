$(document).ready(function () {
    //reloading the read request function
    profileReadRequest()
    // reading profile request
    function profileReadRequest()
    {
        $.ajax({
            type: "post",
            url: "./api/profile_api.php",
            data: {"action":"Myprofile"
                , "Myprofile":"dw212u6hd"
            },
            dataType: "json",
            success: function (data) {
                if(data.status=="success")
                {
                    // console.log(data);
                    // console.log(data.user_name);
                    $(".user_name").html(data.userName);
                    $(".user_email").html(data.email);
                    $(".user_role").html(data.role);
                    $(".image_parent").html(`<img src='${data.userImage}' class='rounded-circle img-thumbnail'>`);
                    $(".image_parent2").html(`<img src='${data.userImage}' class='rounded-circle img-thumbnail'>`);
                }
                else if(data.status=="error")
                {
                   console.log(data.data);
                }
                
            }
        });
    }
});
