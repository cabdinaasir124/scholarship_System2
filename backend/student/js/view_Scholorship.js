$(document).ready(function () {
     reloadData();
    function reloadData() {
        $.ajax({
            type: "POST",
            url: "./api/scholorship_Api.php",
            data: { action: 'fetchscholarship' },
            dataType: "html",
            success: function (response) {
                $("#dataSholorship").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Reload Error: ", error);
            }
        });
    }
});