<!-- frontend/pages/solver/browse-problems.php -->
<?php 
$page_title = "Browse Problems - Probsolve";
include '../../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">Browse Problems</h1>
                <p class="text-muted">Find problems you can solve and earn money</p>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                        <i class="fas fa-filter me-2"></i>Filters
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-sort me-2"></i>Sort By
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Newest First</a></li>
                            <li><a class="dropdown-item" href="#">Budget: High to Low</a></li>
                            <li><a class="dropdown-item" href="#">Budget: Low to High</a></li>
                            <li><a class="dropdown-item" href="#">Urgent First</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="collapse mb-4" id="filtersCollapse">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option value="">All Categories</option>
                                <option value="writing">Writing & Scripting</option>
                                <option value="relationship">Relationship Advice</option>
                                <option value="academic">Academic Help</option>
                                <option value="life">Life Solutions</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Budget Range</label>
                            <select class="form-select">
                                <option value="">Any Budget</option>
                                <option value="15-50">₱15 - ₱50</option>
                                <option value="50-100">₱50 - ₱100</option>
                                <option value="100-200">₱100 - ₱200</option>
                                <option value="200+">₱200+</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Deadline</label>
                            <select class="form-select">
                                <option value="">Any Deadline</option>
                                <option value="1">1 Hour</option>
                                <option value="3">3 Hours</option>
                                <option value="24">24 Hours</option>
                                <option value="72">3 Days</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="active">Active</option>
                                <option value="urgent">Urgent</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="showSkillsOnly">
                                <label class="form-check-label" for="showSkillsOnly">
                                    Only show problems matching my skills
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Apply Filters</button>
                            <button class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Problems Grid -->
        <div class="row" id="problemsContainer">
            <!-- Dynamic content will be loaded here by JavaScript -->
        </div>

        <!-- Pagination -->
        <nav aria-label="Problem pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Submit Solution Modal -->
<div class="modal fade" id="submitSolutionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Solution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="solutionForm">
                    <div class="mb-3">
                        <label class="form-label">Your Solution *</label>
                        <textarea class="form-control" rows="6" placeholder="Write your detailed solution here..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Attachments (Optional)</label>
                        <input type="file" class="form-control" multiple>
                        <div class="form-text">You can upload files to support your solution. Max 3 files, 5MB each.</div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="isDraft">
                        <label class="form-check-label" for="isDraft">
                            Submit as draft for preliminary feedback
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Submit Solution</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function loadProblems() {
        try {
            const response = await fetch('/probsolve/backend/api/problems/list.php');
            const problems = await response.json();

            if (response.ok) {
                const container = document.getElementById('problemsContainer');
                container.innerHTML = problems.map(problem => `
                    <div class='col-lg-6 mb-4'>
                        <div class='card problem-card h-100'>
                            <div class='card-body'>
                                <div class='d-flex justify-content-between align-items-start mb-3'>
                                    <div class='d-flex align-items-center gap-2'>
                                        <span class='badge bg-primary'>${problem.category}</span>
                                        ${problem.urgent ? "<span class='badge bg-warning'>Urgent</span>" : ""}
                                        <small class='text-muted'>Posted ${problem.time_ago} ago</small>
                                    </div>
                                    <div class='budget-badge'>
                                        ₱${problem.budget}
                                    </div>
                                </div>
                                
                                <h5 class='card-title'>${problem.title}</h5>
                                <p class='card-text text-muted'>
                                    ${problem.description}
                                </p>
                                
                                <div class='problem-meta mb-3'>
                                    <div class='d-flex gap-3 text-muted small'>
                                        <span><i class='fas fa-clock me-1'></i>${problem.deadline} deadline</span>
                                        <span><i class='fas fa-users me-1'></i>${problem.solutions_submitted} solutions submitted</span>
                                        <span><i class='fas fa-eye me-1'></i>${problem.views} views</span>
                                    </div>
                                </div>

                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='d-flex gap-2'>
                                        <img src='https://ui-avatars.com/api/?name=Asker&background=0D8ABC&color=fff' 
                                             alt='Asker' class='rounded-circle' width='32' height='32'>
                                        <div>
                                            <small class='d-block'>${problem.asker_name}</small>
                                            <small class='text-muted'>Rating: ${problem.asker_rating}/5</small>
                                        </div>
                                    </div>
                                    <div class='d-flex gap-2'>
                                        <button class='btn btn-outline-primary btn-sm'>
                                            <i class='fas fa-heart me-1'></i>Save
                                        </button>
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#submitSolutionModal'>
                                            <i class='fas fa-paper-plane me-1'></i>Submit Solution
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                console.error('Failed to load problems:', problems.error);
            }
        } catch (error) {
            console.error('Error loading problems:', error);
        }
    }

    function bidOnProblem(problemId) {
        alert(`Bid on problem ID: ${problemId}`);
        // TODO: Implement bidding functionality
    }

    document.addEventListener('DOMContentLoaded', loadProblems);
</script>

<style>
.problem-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.problem-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>

<?php include '../../../includes/footer.php'; ?>