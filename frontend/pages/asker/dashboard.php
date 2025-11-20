<!-- frontend/pages/asker/dashboard.php -->
<?php 
// This would normally include PHP logic for the dashboard
$page_title = "Asker Dashboard - Probsolve";
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php';
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">Asker Dashboard</h1>
                <p class="text-muted">Manage your problems and solutions</p>
            </div>
            <div class="col-auto">
                <a href="post-problem.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Post New Problem
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Active Problems</h6>
                                <h3 class="text-primary" id="activeProblemsCount">0</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-question-circle fa-2x text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Pending Solutions</h6>
                                <h3 class="text-warning">12</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-2x text-warning opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Solved Problems</h6>
                                <h3 class="text-success">23</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-2x text-success opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Total Spent</h6>
                                <h3 class="text-info">₱1,250</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-wallet fa-2x text-info opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Problems -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Recent Problems</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <?php for($i = 0; $i < 3; $i++): ?>
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Need help writing a birthday message for my girlfriend</h6>
                                        <p class="text-muted mb-1">Posted 2 hours ago • 5 solutions received</p>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-primary">Writing</span>
                                            <span class="badge bg-success">Budget: ₱50</span>
                                            <span class="badge bg-warning">Urgent</span>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View Solutions</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit Problem</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="my-problems.php" class="btn btn-outline-primary">View All Problems</a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="post-problem.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Post New Problem
                            </a>
                            <a href="my-problems.php" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>My Problems
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-comments me-2"></i>Messages
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-star me-2"></i>Favorite Solvers
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card mt-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">10 min ago</small>
                                    <p class="mb-0">New solution received for "Birthday message"</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">1 hour ago</small>
                                    <p class="mb-0">You posted "Need relationship advice"</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">3 hours ago</small>
                                    <p class="mb-0">Solution accepted for "Math homework help"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-marker {
    position: absolute;
    left: -2rem;
    top: 0.25rem;
    width: 1rem;
    height: 1rem;
    border-radius: 50%;
}

.timeline-content {
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.timeline-item:last-child .timeline-content {
    border-bottom: none;
    padding-bottom: 0;
}
</style>

<script>
    async function loadDashboardData() {
        try {
            const response = await fetch('/probsolve/backend/api/problems/list.php');
            const problems = await response.json();

            if (response.ok) {
                document.getElementById('activeProblemsCount').textContent = problems.length;
                // Additional logic to populate dashboard cards
            } else {
                console.error('Failed to load dashboard data:', problems.error);
            }
        } catch (error) {
            console.error('Error loading dashboard data:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadDashboardData);
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>