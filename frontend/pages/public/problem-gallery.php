<!-- frontend/pages/public/problem-gallery.php -->
<?php 
$page_title = "Problem Gallery - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold text-primary mb-3">Problem Gallery</h1>
                <p class="lead text-muted">A collection of interesting problems and creative solutions from our community</p>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Categories</option>
                            <option value="writing">Writing & Scripting</option>
                            <option value="relationship">Relationship Advice</option>
                            <option value="academic">Academic Help</option>
                            <option value="life">Life Solutions</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">Any Budget</option>
                            <option value="15-50">₱15 - ₱50</option>
                            <option value="50-100">₱50 - ₱100</option>
                            <option value="100+">₱100+</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">Sort By</option>
                            <option value="popular">Most Popular</option>
                            <option value="recent">Most Recent</option>
                            <option value="solutions">Most Solutions</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Problem Grid -->
        <div class="row" id="problemGrid">
            <?php for($i = 0; $i < 9; $i++): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card gallery-card h-100">
                    <div class="card-body">
                        <!-- Problem Header -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-primary">Writing</span>
                                <span class="badge bg-success">₱75</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i>Report</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Share</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Problem Content -->
                        <h5 class="card-title">How do I tell my boss I need a mental health day?</h5>
                        <p class="card-text text-muted">
                            I've been feeling burned out but don't know how to ask for time off without sounding unprofessional...
                        </p>

                        <!-- Solution Preview -->
                        <div class="solution-preview mb-3">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted d-block mb-2">Top Solution:</small>
                                <p class="mb-0 small text-dark">"Be honest but professional. Say: 'I need to take a personal day to recharge and will be back refreshed tomorrow. My current projects are...'"</p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="problem-stats mb-3">
                            <div class="row text-center">
                                <div class="col-4">
                                    <small class="text-muted">Solutions</small>
                                    <div class="fw-bold text-primary">15</div>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">Likes</small>
                                    <div class="fw-bold text-danger">42</div>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">Shares</small>
                                    <div class="fw-bold text-info">8</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-comment"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                            <small class="text-muted">2 days ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

        <!-- Load More -->
        <div class="text-center mt-4">
            <button class="btn btn-outline-primary" id="loadMore">
                <i class="fas fa-refresh me-2"></i>Load More Problems
            </button>
        </div>
    </div>
</div>

<style>
.gallery-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: var(--primary-color);
}

.solution-preview {
    border-left: 3px solid var(--success-color);
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('loadMore');
    let loadedCount = 9;

    loadMoreBtn.addEventListener('click', function() {
        // Simulate loading more problems
        const problemGrid = document.getElementById('problemGrid');
        
        for(let i = 0; i < 3; i++) {
            const newProblem = document.createElement('div');
            newProblem.className = 'col-lg-4 col-md-6 mb-4';
            newProblem.innerHTML = `
                <div class="card gallery-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-primary">Relationship</span>
                                <span class="badge bg-success">₱50</span>
                            </div>
                        </div>
                        <h5 class="card-title">New loaded problem #${loadedCount + i + 1}</h5>
                        <p class="card-text text-muted">This is a dynamically loaded problem...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Just now</small>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                        </div>
                    </div>
                </div>
            `;
            problemGrid.appendChild(newProblem);
        }

        loadedCount += 3;
        
        // Show message if loaded enough
        if (loadedCount >= 15) {
            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = '<i class="fas fa-check me-2"></i>All Problems Loaded';
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>