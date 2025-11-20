<!-- frontend/pages/public/explore.php -->
<?php 
$page_title = "Explore Problems - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold text-primary mb-3">Explore Creative Solutions</h1>
                <p class="lead text-muted">Discover how our community solves real problems with human creativity and expertise</p>
                
                <!-- Search Bar -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Search problems or solutions...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Problems -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Featured Problems</h2>
                <a href="#" class="btn btn-outline-primary">View All</a>
            </div>

            <div class="row g-4">
                <?php for($i = 0; $i < 4; $i++): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 hover-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">Writing</span>
                                <span class="badge bg-success">₱75</span>
                            </div>
                            <h5 class="card-title">How to apologize to my best friend?</h5>
                            <p class="card-text text-muted small">I said something hurtful and now she won't talk to me. Need a sincere apology message.</p>
                            
                            <div class="problem-meta">
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><i class="fas fa-clock me-1"></i>2h left</span>
                                    <span><i class="fas fa-users me-1"></i>12 solutions</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <button class="btn btn-outline-primary btn-sm w-100">View Solutions</button>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- Top Solvers -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Top Solvers</h2>
                <a href="#" class="btn btn-outline-primary">View All</a>
            </div>

            <div class="row g-3">
                <?php for($i = 0; $i < 6; $i++): ?>
                <div class="col-md-4 col-lg-2">
                    <div class="card text-center hover-shadow">
                        <div class="card-body">
                            <img src="https://ui-avatars.com/api/?name=Solver&background=6366f1&color=fff" 
                                 class="rounded-circle mb-3" width="64" height="64" alt="Solver">
                            <h6 class="card-title mb-1">CreativeWriter</h6>
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <i class="fas fa-star text-warning small me-1"></i>
                                <small class="text-muted">4.9 (127)</small>
                            </div>
                            <div class="d-flex justify-content-center gap-1">
                                <span class="badge bg-primary bg-opacity-10 text-primary small">Writing</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary small">Advice</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- Solution Showcase -->
        <section class="mb-5">
            <h2 class="h4 mb-4">Recently Solved</h2>

            <div class="row g-4">
                <?php for($i = 0; $i < 3; $i++): ?>
                <div class="col-lg-4">
                    <div class="card hover-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-success">Solved</span>
                                <span class="badge bg-primary">Writing</span>
                            </div>
                            
                            <h5 class="card-title">"How to make a birthday special during lockdown?"</h5>
                            <p class="card-text text-muted">Creative ideas for celebrating birthdays while social distancing...</p>
                            
                            <div class="solution-preview mb-3">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Top solution:</small>
                                    <p class="mb-0 small">"Create a virtual surprise party with friends via video call, organize a doorstep gift delivery chain, and prepare a homemade dinner with their favorite foods..."</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=ProblemSolver&background=10b981&color=fff" 
                                         class="rounded-circle me-2" width="24" height="24" alt="Solver">
                                    <small class="text-muted">by CreativeMind</small>
                                </div>
                                <small class="text-success">Earned ₱68</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- Categories -->
        <section>
            <h2 class="h4 mb-4">Browse by Category</h2>

            <div class="row g-3">
                <?php 
                $categories = [
                    ['Writing & Scripting', 'fas fa-pen-fancy', 'primary', '234 problems'],
                    ['Relationship Advice', 'fas fa-heart', 'danger', '189 problems'],
                    ['Academic Help', 'fas fa-graduation-cap', 'success', '156 problems'],
                    ['Life Solutions', 'fas fa-tools', 'warning', '98 problems'],
                    ['Technical Help', 'fas fa-laptop-code', 'info', '76 problems'],
                    ['Creative Work', 'fas fa-palette', 'secondary', '54 problems']
                ];
                
                foreach($categories as $category): 
                ?>
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="card category-card text-decoration-none text-dark hover-shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="<?= $category[1] ?> fa-2x text-<?= $category[2] ?> me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1"><?= $category[0] ?></h5>
                                    <p class="card-text text-muted mb-0"><?= $category[3] ?></p>
                                </div>
                                <div class="flex-shrink-0">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>