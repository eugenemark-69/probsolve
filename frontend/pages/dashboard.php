<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /probsolve/frontend/pages/auth/login.php');
    exit;
}
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>My Dashboard</h1>
            <hr>
            
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 id="posted-count">0</h5>
                            <p class="text-muted">Problems Posted</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 id="solved-count">0</h5>
                            <p class="text-muted">Problems Solved</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 id="rating-value">0.0</h5>
                            <p class="text-muted">Average Rating</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 id="wallet-value">₱0.00</h5>
                            <p class="text-muted">Wallet Balance</p>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#my-problems">My Problems</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#my-solutions">My Solutions</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- My Problems Tab -->
                <div id="my-problems" class="tab-pane fade show active">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>My Problems</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postProblemModal">
                            <i class="fas fa-plus me-2"></i>Post New Problem
                        </button>
                    </div>
                    <div id="problems-list" class="list-group">
                        <p class="text-muted">No problems posted yet</p>
                    </div>
                </div>

                <!-- My Solutions Tab -->
                <div id="my-solutions" class="tab-pane fade">
                    <h3>My Solutions</h3>
                    <div id="solutions-list" class="list-group">
                        <p class="text-muted">No solutions submitted yet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Post Problem Modal -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/modals/post-problem.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load user stats
    fetch('/probsolve/backend/api/user/header-info.php', { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (data.wallet_balance !== undefined) {
                document.getElementById('wallet-value').textContent = '₱' + Number(data.wallet_balance).toFixed(2);
            }
        });

    // Load user's problems
    fetch('/probsolve/backend/api/problems/list.php?user_id=' + '<?php echo $_SESSION['user_id']; ?>', 
          { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (data.problems && data.problems.length > 0) {
                const list = document.getElementById('problems-list');
                list.innerHTML = '';
                document.getElementById('posted-count').textContent = data.problems.length;
                data.problems.forEach(problem => {
                    const div = document.createElement('div');
                    div.className = 'list-group-item';
                    div.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5>${problem.title}</h5>
                                <p class="text-muted small">${problem.description.substring(0, 100)}...</p>
                                <span class="badge bg-info">${problem.category}</span>
                                <span class="badge bg-success">₱${problem.bounty || 'No bounty'}</span>
                                <span class="badge bg-${problem.status === 'open' ? 'primary' : 'secondary'}">${problem.status}</span>
                            </div>
                            <a href="/probsolve/frontend/pages/problem-detail.php?id=${problem.id}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </div>
                    `;
                    list.appendChild(div);
                });
            }
        })
        .catch(err => console.error('Error loading problems:', err));
});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>
