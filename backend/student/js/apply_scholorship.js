$(document).ready(function () {
    $(document).on("submit", "#applicationForm", function (e) {
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append("action", "applyF");

        $.ajax({
            type: "POST",
            url: "./api/application_Api.php",
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    console.log(response);
                    $("#applicationForm")[0].reset();
                } else if (response.status == "warning") {
                    toastr.error(response.message);
                } else {
                    toastr.warning('Unexpected response.', 'Warning');
                    console.log(response);
                }
            },
            error: function (xhr, status, error) {
                console.error("XHR:", xhr.responseText);
                toastr.error(xhr.responseText, 'Request Failed');
            }
        });
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const nextBtns = document.querySelectorAll(".next a");
    const prevBtns = document.querySelectorAll(".previous a");
    const navLinks = document.querySelectorAll(".form-wizard-header .nav-link");
    const tabPanes = document.querySelectorAll(".tab-pane");

    navLinks.forEach(link => {
        link.classList.add("disabled-tab");
    });
    navLinks[0].classList.remove("disabled-tab");

    navLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            if (link.classList.contains("disabled-tab")) {
                e.preventDefault();
            } else {
                const targetId = link.getAttribute("href").substring(1);
                showTab(targetId);
            }
        });
    });

    function showTab(tabId) {
        tabPanes.forEach(p => p.classList.remove("show", "active"));
        document.getElementById(tabId).classList.add("show", "active");

        navLinks.forEach(l => l.classList.remove("active"));
        document.querySelector(`.form-wizard-header .nav-link[href="#${tabId}"]`).classList.add("active");
    }

    function validateCurrentTab(tab) {
        const inputs = tab.querySelectorAll("input, select, textarea");
        let isValid = true;

        inputs.forEach(input => {
            const required = input.hasAttribute("required");
            const empty = input.value.trim() === "";

            if ((required && empty) || !input.checkValidity()) {
                input.classList.add("is-invalid");
                isValid = false;
            } else {
                input.classList.remove("is-invalid");
            }
        });

        return isValid;
    }

    nextBtns.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const activeTab = document.querySelector(".tab-pane.show.active");
            const currentTabId = activeTab.id;

            if (validateCurrentTab(activeTab)) {
                const navLink = document.querySelector(`.form-wizard-header .nav-link[href="#${currentTabId}"]`);
                if (!navLink.innerHTML.includes("✔")) {
                    navLink.innerHTML += " ✔";
                }

                const nextTab = activeTab.nextElementSibling;
                if (nextTab && nextTab.classList.contains("tab-pane")) {
                    const nextTabId = nextTab.id;
                    const nextNav = document.querySelector(`.form-wizard-header .nav-link[href="#${nextTabId}"]`);
                    nextNav.classList.remove("disabled-tab");
                    showTab(nextTabId);
                }
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const activeTab = document.querySelector(".tab-pane.show.active");
            const prevTab = activeTab.previousElementSibling;
            if (prevTab && prevTab.classList.contains("tab-pane")) {
                const prevTabId = prevTab.id;
                showTab(prevTabId);
            }
        });
    });
});
