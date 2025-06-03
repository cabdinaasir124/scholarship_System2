    <!-- jq cdn -->
    <script src="assets/plugin2/jq/jquery-3.7.1.min.js"></script>
    <!-- custom js link -->
     <script src="js/app.js"></script>
     <script src="js/profile.js"></script>
     <!-- <script src="js/quick_stat.js"></script> -->
     <script src="js/application.js"></script>
    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <!-- <script src="assets/js/vendor/Chart.bundle.min.js"></script> -->
        <script src="assets/js/vendor/apexcharts.min.js"></script>
        <script src="assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.dashboard-analytics.js"></script>
        <!-- end demo js-->

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Datatables js -->
    <script src="assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="assets/js/vendor/buttons.html5.min.js"></script>
    <script src="assets/js/vendor/buttons.flash.min.js"></script>
    <script src="assets/js/vendor/buttons.print.min.js"></script>

    <!-- Apex js -->
        <script src="assets/js/vendor/apexcharts.min.js"></script>

        <!-- Todo js -->
        <script src="assets/js/ui/component.todo.js"></script>

        <!-- demo app -->
        <script src="assets/js/pages/demo.dashboard-crm.js"></script>
    
        <script>
    // Line Chart: Applications Over Time
    var lineChart = new ApexCharts(document.querySelector("#lineChart"), {
        chart: { type: 'line', height: 300 },
        series: [{
            name: 'Applications',
            data: [10, 25, 38, 45, 60, 80, 90]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        colors: ['#727cf5']
    });
    lineChart.render();

    // Donut Chart: Application Status
    var donutChart = new ApexCharts(document.querySelector("#donutChart"), {
        chart: { type: 'donut', height: 300 },
        series: [150, 98, 52],
        labels: ['Approved', 'Pending', 'Rejected'],
        colors: ['#0acf97', '#ffbc00', '#fa5c7c'],
        legend: { position: 'bottom' }
    });
    donutChart.render();

    // Bar Chart: Top Departments
    var barChart = new ApexCharts(document.querySelector("#barChart"), {
        chart: { type: 'bar', height: 350 },
        series: [{
            name: 'Applications',
            data: [80, 65, 50, 30, 25]
        }],
        xaxis: {
            categories: ['Computer Science', 'Engineering', 'Business', 'Law', 'Medicine']
        },
        colors: ['#39afd1']
    });
    barChart.render();
</script>


</body>