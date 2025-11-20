<?php 
$page_title = "My Problems - Probsolve";
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">My Problems</h1>
                <p class="text-muted">Manage your posted problems and track solutions</p>
            </div>
            <div class="col-auto">
                <a href="post-problem.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Post New Problem
                </a>
            </div>
        </div>

        <!-- Problem Status Tabs -->
        <ul class="nav nav-tabs mb-4" id="problemTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button">
                    Active <span class="badge bg-primary">5</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                    Pending Review <span class="badge bg-warning">2</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="solved-tab" data-bs-toggle="tab" data-bs-target="#solved" type="button">
                    Solved <span class="badge bg-success">12</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button">
                    Drafts <span class="badge bg-secondary">3</span>
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="problemTabsContent">
            <!-- Active Problems Tab -->
            <div class="tab-pane fade show active" id="active" role="tabpanel">
                <div class="row" id="activeProblemsContainer">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>

            <!-- Pending Problems Tab -->
            <div class="tab-pane fade" id="pending" role="tabpanel">
                <div class="row" id="pendingProblemsContainer">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>

            <!-- Solved Problems Tab -->
            <div class="tab-pane fade" id="solved" role="tabpanel">
                <div class="row" id="solvedProblemsContainer">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>

            <!-- Draft Problems Tab -->
            <div class="tab-pane fade" id="draft" role="tabpanel">
                <div class="row" id="draftProblemsContainer">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function loadProblemsByStatus(status, containerId) {
        try {
            const response = await fetch(`/probsolve/backend/api/problems/list.php?status=${status}`);
            const problems = await response.json();

            if (response.ok) {
                const container = document.getElementById(containerId);
                container.innerHTML = problems.map(problem => `
                    <div class='problem-item'>
                        <h5>${problem.title}</h5>
                        <p>${problem.description}</p>
                        <small>Budget: ${problem.budget}</small>
                    </div>
                `).join('');
            } else {
                console.error('Failed to load problems:', problems.error);
            }
        } catch (error) {
            console.error('Error loading problems:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadProblemsByStatus('active', 'activeProblemsContainer');
        loadProblemsByStatus('pending', 'pendingProblemsContainer');
        loadProblemsByStatus('solved', 'solvedProblemsContainer');
        loadProblemsByStatus('draft', 'draftProblemsContainer');
    });
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>