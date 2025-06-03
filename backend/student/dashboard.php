<?php
include("config/conn.php");
$user_id = $_SESSION['userID'] ?? null;
$recentApplications = [];
$applications = [];

$pending = $approved = $rejected = 0;
$monthlyData = [];
$latestApplication = [];

if ($user_id) {
    // Fetch recent applications
    $sql = "SELECT a.id, s.title AS scholarship_title, a.status, a.submitted_at 
            FROM applications a
            JOIN scholarships s ON a.scholarship_id = s.id
            WHERE a.user_id = ?
            ORDER BY a.submitted_at DESC
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $recentApplications = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Fetch all applications for current user
    $sql = "SELECT * FROM applications WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $applications = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Count statuses and prepare monthly data
    foreach ($applications as $app) {
        $status = strtolower($app['status']);
        if ($status === 'pending') $pending++;
        elseif ($status === 'approved') $approved++;
        elseif ($status === 'rejected') $rejected++;

        if (!empty($app['submitted_at'])) {
            $month = date('F', strtotime($app['submitted_at']));
            $monthlyData[$month] = ($monthlyData[$month] ?? 0) + 1;
        }
    }

    // Fetch latest application for progress tracking
    $sql = "SELECT * FROM applications WHERE user_id = ? ORDER BY submitted_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $latestApplication = $result->fetch_assoc();
    $stmt->close();
}

// Step tracking logic
$steps = [
    'Application Submitted' => !empty($latestApplication),
    'Documents Uploaded' => !empty($latestApplication['id_document']) && !empty($latestApplication['certificate']),
    'Under Review' => $latestApplication['status'] === 'Pending',
    'Final Decision' => in_array($latestApplication['status'], ['Approved', 'Rejected']),
];
$activeStep = array_search(true, array_reverse($steps, true)) ?? 'Application Submitted';

// Prepare chart data
ksort($monthlyData); // Sort alphabetically (Jan-Dec)
$months = array_keys($monthlyData);
$counts = array_values($monthlyData);

$totalApplications = count($applications);
?>


<?php include("header.php"); ?>

<div class="container-fluid">
    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Som Scholarship</h4>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row">
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar-sm me-3">
                        <span class="avatar-title bg-primary rounded">
                            <i class="mdi mdi-file-document-outline font-20"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="text-muted fw-normal">Your Applicat..</h5>
                        <h3 class="mb-0"><?= $totalApplications ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar-sm me-3">
                        <span class="avatar-title bg-warning rounded">
                            <i class="mdi mdi-timer-sand font-20"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="text-muted fw-normal">Pending</h5>
                        <h3 class="mb-0"><?= $pending ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar-sm me-3">
                        <span class="avatar-title bg-success rounded">
                            <i class="mdi mdi-check-circle font-20"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="text-muted fw-normal">Approved</h5>
                        <h3 class="mb-0"><?= $approved ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar-sm me-3">
                        <span class="avatar-title bg-danger rounded">
                            <i class="mdi mdi-close-circle font-20"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="text-muted fw-normal">Rejected</h5>
                        <h3 class="mb-0"><?= $rejected ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <?php if ($totalApplications === 0): ?>
        <div class="empty-state text-center p-4">
            <i class="mdi mdi-file-document-outline mdi-48px text-muted mb-3"></i>
            <h5>You haven't applied to any scholarships yet.</h5>
            <p>Explore available scholarships and start your application now.</p>
            <a href="see_available_scholarhips.php" class="btn btn-primary mt-2">View Available Scholarships</a>
        </div>
    <?php endif; ?>
<?php
// Example status coming from application
$status = 'Approved'; // This can be: Applied, Documents, Review, Approved, Rejected

// Define your ordered steps
$steps = ['Applied', 'Documents', 'Review', 'Final decision'];

// Map application status to the correct active step
$statusToStep = [
    'Applied' => 'Applied',
    'Documents Submitted' => 'Documents',
    'Under Review' => 'Review',
    'Approved' => 'Final decision',
    'Rejected' => 'Final decision'
];

// Determine the active step from status
$activeStep = $statusToStep[$status] ?? 'Applied';

?>
<style>
.progress-track {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 40px auto;
    max-width: 100%;
}
.progress-track::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 4px;
    background-color: #dee2e6;
    z-index: 0;
}
.progress-step {
    position: relative;
    z-index: 1;
    text-align: center;
    flex: 1;
}
.progress-circle {
    width: 40px;
    height: 40px;
    margin: 0 auto;
    border-radius: 50%;
    background-color: #dee2e6;
    color: white;
    line-height: 40px;
    font-weight: bold;
}
#monthlyChart {
    display: block;
    background: #f8f9fa;
}

.progress-step.completed .progress-circle {
    background-color: #28a745;
}
.progress-step.active .progress-circle {
    background-color: #17a2b8;
}
.progress-label {
    font-size: 14px;
    margin-top: 8px;
}
</style>

<div class="container">
    <div class="progress-track">
        <?php
        $activeIndex = array_search($activeStep, $steps);
        foreach ($steps as $index => $label):
            $classes = '';
            if ($index < $activeIndex) {
                $classes = 'completed';
            } elseif ($index === $activeIndex) {
                $classes = 'active';
            }
        ?>
        <div class="progress-step <?= $classes ?>">
            <div class="progress-circle"><?= $index + 1 ?></div>
            <div class="progress-label"><?= $label ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



    <!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">
<div class="col-6">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Application Status Overview</h5>
        <canvas id="statusChart" height="200"></canvas>
    </div>
</div>
</div>

<div class="col-12 col-md-6">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title mb-4">Monthly Applications</h5>
            <div style="overflow-x: auto;">
                <canvas id="monthlyChart" style="min-width: 50px;" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Applications',
                data: <?= json_encode($counts) ?>,
                backgroundColor: '#2196f3'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>



</div>


<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [<?= $pending ?>, <?= $approved ?>, <?= $rejected ?>],
                backgroundColor: ['#fbc02d', '#4caf50', '#f44336'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>


   <div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">Recently Applied Scholarships</h5>
        
        <?php if (!empty($recentApplications)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Scholarship Title</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentApplications as $index => $app): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($app['scholarship_title']) ?></td>
                                <td>
                                    <?php
                                        $status = $app['status'];
                                        $badge = 'primary';
                                        if ($status === 'Pending') $badge = 'warning';
                                        elseif ($status === 'Approved') $badge = 'success';
                                        elseif ($status === 'Rejected') $badge = 'danger';
                                    ?>
                                    <span class="badge bg-<?= $badge ?>"><?= $status ?></span>
                                </td>
                                <td><?= date('M d, Y', strtotime($app['submitted_at'])) ?></td>
                                <td>
                                    <a href="view_application.php?id=<?= $app['id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>


</div>

<?php include("footer.php"); ?>
