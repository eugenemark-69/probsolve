<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Filter Problems</h5>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select id="category-filter" class="form-select">
                            <option value="">All Categories</option>
                            <option value="technology">Technology</option>
                            <option value="business">Business</option>
                            <option value="design">Design</option>
                            <option value="marketing">Marketing</option>
                            <option value="legal">Legal</option>
                            <option value="personal">Personal</option>
                            <option value="education">Education</option>
                            <option value="health">Health</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="status-filter" class="form-select">
                            <option value="open" selected>Open</option>
                            <option value="resolved">Resolved</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100" onclick="loadProblems()">Apply Filters</button>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <h2>Browse Problems</h2>
            <div id="problems-container" class="list-group">
                <p class="text-muted">Loading problems...</p>
            </div>
        </div>
    </div>
</div>

<script>
function loadProblems() {
    const category = document.getElementById('category-filter').value;
    const status = document.getElementById('status-filter').value || 'open';
    
    let url = '/probsolve/backend/api/problems/list.php?status=' + status;
    if (category) url += '&category=' + category;

    fetch(url, { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            const container = document.getElementById('problems-container');
            if (data.success && data.problems && data.problems.length > 0) {
                container.innerHTML = '';
                data.problems.forEach(problem => {
                    const div = document.createElement('div');
                    div.className = 'list-group-item list-group-item-action';
                    const bountyDisplay = problem.bounty ? '₱' + parseFloat(problem.bounty).toFixed(2) : 'No bounty';
                    div.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5>${problem.title}</h5>
                            <span class="badge bg-success">${bountyDisplay}</span>
                        </div>
                        <p class="text-muted">${problem.description.substring(0, 150)}...</p>
                        <small class="text-secondary">By <strong>${problem.username}</strong></small><br>
                        <div class="mt-2">
                            <span class="badge bg-info">${problem.category_name}</span>
                            <span class="badge bg-secondary">${problem.status}</span>
                            <a href="/probsolve/frontend/pages/problem-detail.php?id=${problem.id}" class="btn btn-sm btn-primary float-end">
                                View & Solve
                            </a>
                        </div>
                    `;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = '<p class="text-muted">No problems found</p>';
            }
        })
        .catch(err => {
            console.error('Error loading problems:', err);
            document.getElementById('problems-container').innerHTML = '<p class="text-danger">Error loading problems</p>';
        });
}

document.addEventListener('DOMContentLoaded', loadProblems);
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>
