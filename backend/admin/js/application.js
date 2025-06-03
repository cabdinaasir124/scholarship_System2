$(document).ready(function () {
    function getApplicationData() {
        $.ajax({
            type: "POST",
            url: "./api/application_api.php",
            data: {
                action: "fetchApplications"
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    let html = "";
                    response.data.forEach(function (app, index) {
                        html += `<tr>
                            <td>${app.id}</td>
                            <td>${app.student_name}</td>
                            <td>${app.scholarship_name}</td>
                            <td>${app.status}</td>
                            <td>${app.date_submitted}</td>
                            <td>
                                <button class="btn btn-success btn-sm approve" data-id="${app.id}">Approve</button>
                                <button class="btn btn-danger btn-sm reject" data-id="${app.id}">Reject</button>
                            </td>
                        </tr>`;
                    });
                    $("#applicationData").html(html);
                } else {
                    $("#applicationData").html(`<tr><td colspan="6" class="text-center text-danger">${response.message}</td></tr>`);
                }
            },
            error: function () {
                $("#applicationData").html(`<tr><td colspan="6" class="text-center text-danger">Failed to fetch data.</td></tr>`);
            }
        });
    }

    // Call once
    getApplicationData();

    // Delegate click events (after table is loaded)
    $(document).on('click', '.approve', function () {
        let id = $(this).data('id');
        updateStatus(id, 'approveApplication');
    });

    $(document).on('click', '.reject', function () {
        let id = $(this).data('id');
        updateStatus(id, 'rejectApplication');
    });

    function updateStatus(id, actionType) {
        $.ajax({
            type: "POST",
            url: "./api/application_api.php",
            data: {
                action: actionType,
                id: id
            },
            dataType: "json",
            success: function (response) {
                alert(response.message);
                getApplicationData(); // Refresh table
            },
            error: function () {
                alert("Something went wrong.");
            }
        });
    }
});
