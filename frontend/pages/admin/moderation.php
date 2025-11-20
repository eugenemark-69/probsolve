<!-- frontend/pages/admin/moderation.php -->
<?php 
$page_title = "Content Moderation - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">Content Moderation</h1>
                <p class="text-muted">Review and manage user-generated content</p>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">All Content</a></li>
                        <li><a class="dropdown-item" href="#">Pending Review</a></li>
                        <li><a class="dropdown-item" href="#">Flagged Content</a></li>
                        <li><a class="dropdown-item" href="#">Approved</a></li>
                        <li><a class="dropdown-item" href="#">Rejected</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Moderation Stats -->
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-primary">23</h3>
                        <small class="text-muted">Pending Review</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-warning">12</h3>
                        <small class="text-muted">Flagged</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-success">156</h3>
                        <small class="text-muted">Approved Today</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-danger">8</h3>
                        <small class="text-muted">Rejected Today</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-info">5</h3>
                        <small class="text-muted">Appeals</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-secondary">42</h3>
                        <small class="text-muted">Total Actions</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Moderation -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Content Queue</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Content</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="moderation-queue">
                            <!-- Dynamic rows will be injected here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Moderation Guidelines -->
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Moderation Guidelines</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="fas fa-ban text-danger me-2"></i>Reject Content For:</h6>
                        <ul class="small text-muted">
                            <li>Illegal activities or harmful content</li>
                            <li>Personal attacks or harassment</li>
                            <li>Spam or promotional content</li>
                            <li>Plagiarism or copyright violation</li>
                            <li>Inappropriate or explicit content</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-check text-success me-2"></i>Approve Content When:</h6>
                        <ul class="small text-muted">
                            <li>Content is original and helpful</li>
                            <li>No personal information is shared</li>
                            <li>Appropriate for general audience</li>
                            <li>Follows community guidelines</li>
                            <li>Clear and well-presented</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/backend/api/admin/moderation.php', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            const queue = document.getElementById('moderation-queue');
            queue.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.content}</td>
                    <td>${item.user}</td>
                    <td>${item.status}</td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="handleAction(${item.id}, 'approve')">Approve</button>
                        <button class="btn btn-danger btn-sm" onclick="handleAction(${item.id}, 'reject')">Reject</button>
                    </td>
                `;
                queue.appendChild(row);
            });
        });
    });

    function handleAction(contentId, action) {
        fetch('/backend/api/admin/moderation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ content_id: contentId, action: action }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        });
    }
</script>

<?php include '../../includes/footer.php'; ?>