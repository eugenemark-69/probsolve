<!-- frontend/pages/admin/dashboard.php -->
<?php 
$page_title = "Admin Dashboard - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">Admin Dashboard</h1>
                <p class="text-muted">Platform management and analytics</p>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-cog me-2"></i>Admin Tools
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="moderation.php"><i class="fas fa-shield-alt me-2"></i>Content Moderation</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i>User Management</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-chart-bar me-2"></i>Analytics</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Platform Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Total Users</h6>
                                <h3 class="text-primary" id="total-users">Loading...</h3>
                                <small class="text-success"><i class="fas fa-arrow-up me-1"></i>12% this week</small>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Problems Solved</h6>
                                <h3 class="text-success">892</h3>
                                <small class="text-success"><i class="fas fa-arrow-up me-1"></i>8% this week</small>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-2x text-success opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Pending Moderation</h6>
                                <h3 class="text-warning">23</h3>
                                <small class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>Needs attention</small>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-flag fa-2x text-warning opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">Platform Revenue</h6>
                                <h3 class="text-danger">₱12,580</h3>
                                <small class="text-success"><i class="fas fa-arrow-up me-1"></i>15% this week</small>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-wallet fa-2x text-danger opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Activity -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Platform Activity</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Problem</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-activity">
                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Alerts -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="moderation.php" class="btn btn-warning">
                                <i class="fas fa-shield-alt me-2"></i>Content Moderation
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-users me-2"></i>User Management
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-chart-bar me-2"></i>View Analytics
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-cog me-2"></i>System Settings
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Alerts -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">System Alerts</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>23 problems</strong> awaiting moderation
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <i class="fas fa-server me-2"></i>
                            <strong>High server load</strong> detected
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>System backup</strong> scheduled tonight
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="col-md-3">
                <div class="card stat-card danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title text-muted">User Management</h6>
                                <h3 class="text-danger" id="banned-users">Loading...</h3>
                                <small class="text-muted">Banned Users</small>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user-slash fa-2x text-danger opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Table -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">User Management</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="user-management">
                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch total users
        fetch('/backend/api/admin/users.php?action=count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-users').textContent = data.total;
            });

        // Fetch recent activity
        fetch('/backend/api/admin/activity.php')
            .then(response => response.json())
            .then(data => {
                const activityTable = document.getElementById('recent-activity');
                activityTable.innerHTML = '';
                data.forEach(activity => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${activity.user}</td>
                        <td>${activity.action}</td>
                        <td>${activity.problem}</td>
                        <td>${activity.time}</td>
                        <td>${activity.status}</td>
                    `;
                    activityTable.appendChild(row);
                });
            });

        // Fetch banned users count
        fetch('/backend/api/admin/users.php?action=banned_count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('banned-users').textContent = data.banned;
            });

        // Fetch user list
        fetch('/backend/api/admin/users.php')
            .then(response => response.json())
            .then(data => {
                const userTable = document.getElementById('user-management');
                userTable.innerHTML = '';
                data.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>${user.status}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="handleUserAction(${user.id}, 'ban')">Ban</button>
                            <button class="btn btn-success btn-sm" onclick="handleUserAction(${user.id}, 'unban')">Unban</button>
                            <button class="btn btn-warning btn-sm" onclick="handleUserAction(${user.id}, 'delete')">Delete</button>
                        </td>
                    `;
                    userTable.appendChild(row);
                });
            });
    });

    function handleUserAction(userId, action) {
        fetch('/backend/api/admin/users.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id: userId, action: action }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        });
    }
</script>

<?php include '../../includes/footer.php'; ?>