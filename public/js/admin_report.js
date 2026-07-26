$(document).ready(function () {

    function loadReport(type) {
        $.ajax({
            url: "/admin/report/" + type,
            method: "GET",
            success: function (response) {
                $("#reportResult").html(response);
            },
            error: function () {
                $("#reportResult").html(
                    "<div class='alert alert-danger'>Failed to load report.</div>"
                );
            }
        });
    }

    // Load default report on page load
    loadReport("payment");

    // Change report when dropdown changes
    $("#reportType").on("change", function () {
        loadReport($(this).val());
    });

});
