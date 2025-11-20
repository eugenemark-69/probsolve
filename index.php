<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probsolve - Your Problems, Our Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="frontend/assets/css/custom/main.css" rel="stylesheet">
</head>
<body>
    <?php include 'frontend/includes/header.php'; ?>
    
    <main>
        <?php include 'frontend/includes/navigation.php'; ?>
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center min-vh-80">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold text-primary">Your Problems, Our Solutions. For a Price.</h1>
                        <p class="lead mb-4">Get human-powered solutions for any problem, big or small. From creative writing to life advice.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="frontend/pages/auth/register.php" class="btn btn-primary btn-lg">Get Solutions</a>
                            <a href="frontend/pages/solver/browse-problems.php" class="btn btn-outline-primary btn-lg">Solve Problems</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-graphic">
                            <div class="floating-card card-1">
                                <i class="fas fa-lightbulb text-warning"></i>
                                <span>Creative Solutions</span>
                            </div>
                            <div class="floating-card card-2">
                                <i class="fas fa-comments text-info"></i>
                                <span>Live Chat</span>
                            </div>
                            <div class="floating-card card-3">
                                <i class="fas fa-bolt text-success"></i>
                                <span>Quick Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Problem Categories -->
        <section class="categories-section py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">What kind of problem do you have?</h2>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="category-card card h-100 hover-shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-pen-fancy fa-3x text-primary mb-3"></i>
                                <h5>Writing & Scripting</h5>
                                <p class="text-muted">Social media posts, messages, creative writing</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-card card h-100 hover-shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                                <h5>Relationship Advice</h5>
                                <p class="text-muted">Dating, friendships, family matters</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-card card h-100 hover-shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
                                <h5>Academic Help</h5>
                                <p class="text-muted">Homework, projects, study advice</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-card card h-100 hover-shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-tools fa-3x text-warning mb-3"></i>
                                <h5>Life Solutions</h5>
                                <p class="text-muted">Practical problems, DIY, bureaucracy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'frontend/includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/assets/js/custom/main.js"></script>
</body>
</html>