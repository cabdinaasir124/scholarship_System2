$(document).ready(function () {
    $(document).on("submit", "#insertS", function(e) {
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append("action", "inserScholorship");

        $.ajax({
            type: "POST",
            url: "./api/scholorship_Api.php",
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        // ✅ Corrected ID here
                        $('#insertS')[0].reset();
                        $('#exampleModal').modal('hide');
                        reloadData(); // ✅ Make sure this function is defined
                    });
                } else if (response.status == "error") {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    });

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

    // here i will start deleting scholorship
    $(document).on("click", "#deleteBtn", function () {
    let deleteId = $(this).attr("btn-id"); // Move it here to access correct `this`

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "./api/scholorship_Api.php",
                data: {
                    action: "deleteF",
                    id: deleteId
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success"
                        });
                        reloadData(); // Reload your list
                    } else {
                        Swal.fire({
                            title: "Sorry!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            });
        }
    });
});



    // here i will start reading scholorship 
    $(document).on("click","#updateBtn", function(){
        let updateId = $(this).attr("btn-id"); // Get the scholarship ID
        console.log(updateId);
        $.ajax({
            type: "POST",
            url: "./api/scholorship_Api.php",
            data: {
                "action":"updatereadF",
                "id": updateId,
            },
            dataType: "html",
            success: function (response) {
               $("#ScholorB").html(response)
            }
        });
        
    });

    $(document).on("submit", "#updateF", function(e) {
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append("action", "updateF");

        $.ajax({
            type: "POST",
            url: "./api/scholorship_Api.php",
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        // ✅ Corrected ID here
                        $('#insertS')[0].reset();
                        $('#exampleModal').modal('hide');
                        reloadData(); // ✅ Make sure this function is defined
                    });
                } else if (response.status == "error") {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    });

    

});
