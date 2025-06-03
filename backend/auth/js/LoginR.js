$(document).ready(function () {
    // Start the login form request
    $(document).on('submit', '#LoginForm', function (e) {
        e.preventDefault();

        // Storing the form data
        let firmdata = new FormData(this);

        // Adding action and login password
        firmdata.append('action', 'Loginf');
        firmdata.append('Loginf', '12@d#$');

        // Changing the sign-up button to show loading indicator
        $("#btn_log").html("<img width='20px' src='../admin/assets/images/loading-gif.gif'>");

        $.ajax({
            type: "POST",
            url: "apis/auth_api.php",
            data: firmdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    // Redirect based on the user's role
                    if (data.redirect) {
                        window.location.href = data.redirect; // Redirect to the role-specific dashboard
                    }
                } else if (data.status == "error") {
                    // Show error message
                    $("#alert").show();
                    $("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#alert").html(data.message);
                }

                // Reset the login button text after the request
                $("#btn_log").html('<i class="mdi mdi-login"></i> Log In Now ');
            },
            error: function (xhr, status, error) {
                // Handle unexpected errors
                $("#alert").show();
                $("#alert").removeClass("alert-success").addClass("alert-danger");
                $("#alert").html('An error occurred. Please try again.');
                $("#btn_log").html('<i class="mdi mdi-login"></i> Log In Now ');
            }
        });
    });
    // End the login form request
});
