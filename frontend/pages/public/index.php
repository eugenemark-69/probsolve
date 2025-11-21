<?php include __DIR__ . '/../../includes/header.php'; ?>

<style>
    /* Modern Variable Font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap');
    
    * {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
    
    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
        scroll-snap-type: y proximity;
    }
    
    section {
        scroll-snap-align: start;
    }
    
    /* Hero Section with Mesh Gradient */
    .hero-section {
        background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe, #06b6d4);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        position: relative;
        overflow: hidden;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Noise Texture Overlay */
    .hero-section::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        opacity: 0.03;
        pointer-events: none;
    }
    
    /* Particle Canvas */
    #particles-canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    
    /* Modern Typography */
    .hero-section h1 {
        font-size: clamp(3rem, 12vw, 7rem);
        letter-spacing: -0.03em;
        line-height: 0.95;
        font-weight: 900;
    }
    
    /* Floating Elements */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    /* 3D Mockup Container */
    .mockup-3d {
        perspective: 1000px;
        animation: float3d 6s ease-in-out infinite;
    }
    
    @keyframes float3d {
        0%, 100% { transform: translateY(0) rotateY(0deg); }
        50% { transform: translateY(-30px) rotateY(10deg); }
    }
    
    .mockup-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        transform-style: preserve-3d;
        transition: transform 0.3s ease;
    }
    
    /* Glassmorphism Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    
    .glass-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(45deg);
        transition: all 0.6s ease;
    }
    
    .glass-card:hover::before {
        left: 100%;
    }
    
    .glass-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px -10px rgba(102, 126, 234, 0.4),
                    0 15px 30px -10px rgba(236, 72, 153, 0.3);
    }
    
    /* Magnetic Button Effect */
    .btn-magnetic {
        background: linear-gradient(135deg, #667eea, #764ba2, #ec4899);
        background-size: 200% 200%;
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: gradientMove 3s ease infinite;
    }
    
    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .btn-magnetic::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-magnetic:hover::before {
        left: 100%;
    }
    
    .btn-magnetic:hover {
        transform: scale(1.05) translateY(-2px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.6);
    }
    
    .btn-magnetic:active {
        transform: scale(0.98);
    }
    
    /* Confetti Effect */
    @keyframes confetti-fall {
        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
    
    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        background: #fbbf24;
        pointer-events: none;
        animation: confetti-fall 3s linear forwards;
    }
    
    /* Enhanced Stats Counter */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-10px) scale(1.05);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #667eea, #ec4899, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Animated Blobs */
    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.5;
        animation: blobFloat 20s infinite ease-in-out;
    }
    
    @keyframes blobFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(100px, -50px) scale(1.2); }
        66% { transform: translate(-50px, 100px) scale(0.8); }
    }
    
    .blob-1 { 
        width: 400px; 
        height: 400px; 
        background: rgba(102, 126, 234, 0.3);
        top: 10%; 
        left: 10%; 
        animation-delay: 0s; 
    }
    .blob-2 { 
        width: 300px; 
        height: 300px; 
        background: rgba(236, 72, 153, 0.3);
        top: 60%; 
        right: 15%; 
        animation-delay: 3s; 
    }
    .blob-3 { 
        width: 250px; 
        height: 250px; 
        background: rgba(6, 182, 212, 0.3);
        bottom: 20%; 
        left: 50%; 
        animation-delay: 6s; 
    }
    
    /* Bento Grid Layout */
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .bento-item {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
    }
    
    .bento-item:hover {
        border-color: #667eea;
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
    }
    
    .bento-item.large {
        grid-column: span 2;
    }
    
    /* Tilt Effect for Category Cards */
    .category-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
        transform-style: preserve-3d;
    }
    
    .category-card:hover {
        border-color: #667eea;
        transform: translateY(-15px) rotateX(5deg);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.4);
    }
    
    .category-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: inline-block;
        transition: all 0.5s ease;
        filter: drop-shadow(0 5px 15px rgba(102, 126, 234, 0.3));
    }
    
    .category-card:hover .category-icon {
        transform: rotateY(360deg) scale(1.2);
    }
    
    /* Live Activity Ticker */
    .activity-ticker {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 1rem 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 2rem;
        overflow: hidden;
        position: relative;
    }
    
    .ticker-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: tickerScroll 20s linear infinite;
    }
    
    @keyframes tickerScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    .ticker-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        padding: 0 2rem;
    }
    
    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { 
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            transform: scale(1.1);
        }
    }
    
    /* Enhanced Testimonials */
    .testimonial-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);
        color: white;
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .testimonial-card::before {
        content: '"';
        font-size: 8rem;
        position: absolute;
        top: -30px;
        left: 20px;
        opacity: 0.15;
        font-family: Georgia, serif;
    }
    
    .testimonial-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 30px 60px rgba(102, 126, 234, 0.5);
    }
    
    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #ec4899, #fbbf24);
        z-index: 9999;
        transition: width 0.1s ease;
    }
    
    /* Trust Badge Pulse */
    .trust-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(16, 185, 129, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        border: 2px solid #10b981;
        animation: badgePulse 3s infinite;
    }
    
    @keyframes badgePulse {
        0%, 100% { 
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
        }
        50% { 
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }
    }
    
    /* Reveal Animations with Intersection Observer */
    .reveal {
        opacity: 0;
        transform: translateY(80px);
        transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Stagger Animation for Children */
    .stagger-container .reveal {
        transition-delay: calc(var(--stagger-delay) * 100ms);
    }
</style>

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Hero Section -->
<section class="hero-section py-5 text-white position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <!-- Particle Canvas -->
    <canvas id="particles-canvas"></canvas>
    
    <!-- Animated Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="fw-bold mb-4 floating">
                    Your Problems,<br>Our <span style="color: #ffd700; text-shadow: 0 0 30px rgba(255, 215, 0, 0.6);">Solutions</span>.
                </h1>
                <p class="lead mb-4 fs-4">For a Price. 💰</p>
                <p class="fs-5 mb-4 opacity-90">
                    Got a problem? Post it. Get creative, human-powered solutions from our global community of problem-solvers. Pay only for what you love.
                </p>
                
                <!-- Trust Badges -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <div class="trust-badge">
                        <span class="pulse-dot"></span>
                        <small class="fw-bold">1,234 Active Now</small>
                    </div>
                    <div class="trust-badge">
                        <i class="fas fa-shield-alt text-success"></i>
                        <small class="fw-bold">Money-Back Guarantee</small>
                    </div>
                </div>
                
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/probsolve/frontend/pages/auth/register.php" class="btn btn-magnetic btn-lg px-5 py-3 text-white" id="ctaButton">
                        <i class="fas fa-rocket me-2"></i>Get Started Free
                    </a>
                    <a href="/probsolve/frontend/pages/public/explore.php" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fas fa-compass me-2"></i>Explore Problems
                    </a>
                </div>
                
                <!-- Live Activity Ticker -->
                <div class="activity-ticker">
                    <div class="ticker-content">
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Juan earned ₱500 2 minutes ago 🎉</span>
                        </div>
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Maria solved a problem in Manila 💡</span>
                        </div>
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Lisa got 5 solutions in 10 minutes ⚡</span>
                        </div>
                        <!-- Duplicate for seamless loop -->
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Juan earned ₱500 2 minutes ago 🎉</span>
                        </div>
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Maria solved a problem in Manila 💡</span>
                        </div>
                        <div class="ticker-item">
                            <span class="pulse-dot"></span>
                            <span>Lisa got 5 solutions in 10 minutes ⚡</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="mockup-3d">
                    <div class="mockup-card text-center">
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <div class="stat-card glass-card text-white">
                                    <div class="stat-number" data-count="12543">0</div>
                                    <div class="small">Problems Solved</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card glass-card text-white">
                                    <div class="stat-number" data-count="8921">0</div>
                                    <div class="small">Active Solvers</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card glass-card text-white">
                                    <div class="stat-number" data-count="4567">0</div>
                                    <div class="small">Happy Clients</div>
                                </div>
                            </div>
                        </div>
                        <div class="glass-card p-4 text-start text-white">
                            <h5 class="mb-3">🔥 Trending Problem</h5>
                            <p class="mb-2 small">"Need help writing a breakup text that doesn't sound harsh..."</p>
                            <div class="d-flex justify-content-between small opacity-75">
                                <span>💰 ₱150 Budget</span>
                                <span>⚡ 12 Solutions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works - Bento Grid Style -->
<section class="py-5 bg-light reveal">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">How It Works</h2>
            <p class="lead text-muted">Three simple steps to solve any problem</p>
        </div>
        
        <div class="bento-grid stagger-container">
            <div class="bento-item large reveal" style="--stagger-delay: 1">
                <div class="d-flex align-items-start gap-4">
                    <div class="bg-primary bg-gradient rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 80px; height: 80px;">
                        <i class="fas fa-edit text-white fs-2"></i>
                    </div>
                    <div>
                        <h3 class="h4 mb-3">1. Post Your Problem</h3>
                        <p class="text-muted mb-3">Describe your issue in detail, set your budget, and watch the magic happen. Our AI matches you with the best solvers.</p>
                        <ul class="text-muted small">
                            <li>Choose from 50+ categories</li>
                            <li>Set your own budget (₱50 - ₱10,000)</li>
                            <li>Get responses within minutes</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="bento-item reveal" style="--stagger-delay: 2">
                <div class="bg-success bg-gradient rounded-4 d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-lightbulb text-white fs-2"></i>
                </div>
                <h3 class="h4 mb-3">2. Get Solutions</h3>
                <p class="text-muted">Receive multiple creative solutions from verified solvers worldwide.</p>
            </div>
            
            <div class="bento-item reveal" style="--stagger-delay: 3">
                <div class="bg-warning bg-gradient rounded-4 d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-star text-white fs-2"></i>
                </div>
                <h3 class="h4 mb-3">3. Pay & Rate</h3>
                <p class="text-muted">Choose your favorite solution, pay securely, and rate your experience.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Categories -->
<section class="py-5 reveal" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Popular Categories</h2>
            <p class="lead text-muted">Browse problems by category</p>
        </div>
        
        <div class="row g-4 stagger-container">
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 1">
                    <div class="category-icon">💬</div>
                    <h4>Social Scripts</h4>
                    <p class="text-muted small mb-0">Conversation help, dating advice, conflict resolution</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 2">
                    <div class="category-icon">✍️</div>
                    <h4>Writing Help</h4>
                    <p class="text-muted small mb-0">Essays, emails, creative content, translations</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 3">
                    <div class="category-icon">💡</div>
                    <h4>Life Hacks</h4>
                    <p class="text-muted small mb-0">DIY fixes, budgeting, productivity tips</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 4">
                    <div class="category-icon">📚</div>
                    <h4>Study Help</h4>
                    <p class="text-muted small mb-0">Tutoring, homework assistance, exam prep</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 5">
                    <div class="category-icon">🎨</div>
                    <h4>Creative Work</h4>
                    <p class="text-muted small mb-0">Design ideas, naming, branding concepts</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 6">
                    <div class="category-icon">💼</div>
                    <h4>Career Advice</h4>
                    <p class="text-muted small mb-0">Resume help, interview prep, career pivots</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 7">
                    <div class="category-icon">🏠</div>
                    <h4>Home & Living</h4>
                    <p class="text-muted small mb-0">Cleaning hacks, organizing, maintenance</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="category-card reveal" style="--stagger-delay: 8">
                    <div class="category-icon">💰</div>
                    <h4>Money Matters</h4>
                    <p class="text-muted small mb-0">Budgeting, saving strategies, side hustles</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-light reveal">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">What Our Users Say</h2>
            <p class="lead text-muted">Real problems. Real solutions. Real results.</p>
        </div>
        
        <div class="row g-4 stagger-container">
            <div class="col-md-4">
                <div class="testimonial-card h-100 reveal" style="--stagger-delay: 1">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Maria Santos</h5>
                            <small class="opacity-75">College Student</small>
                        </div>
                    </div>
                    <p class="mb-3">"Needed help with a breakup text and got 5 amazing responses in 30 minutes! Worth every peso. 💯"</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="testimonial-card h-100 reveal" style="--stagger-delay: 3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-user text-warning"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Lisa Chen</h5>
                            <small class="opacity-75">Small Business Owner</small>
                        </div>
                    </div>
                    <p class="mb-3">"Got a brilliant business name and tagline from the community. They understood my vision perfectly!"</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 position-relative overflow-hidden reveal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ec4899 100%);">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    
    <div class="container py-5 position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-8 text-white mb-4 mb-lg-0">
                <h2 class="display-4 fw-bold mb-3">Ready to Solve Your Problems?</h2>
                <p class="lead mb-3">Join thousands of problem-solvers and problem-posters today. It's free to start!</p>
                <div class="d-flex gap-3 flex-wrap align-items-center">
                    <div class="trust-badge bg-white bg-opacity-10">
                        <i class="fas fa-lock text-white"></i>
                        <small class="fw-bold text-white">Secure Escrow Payment</small>
                    </div>
                    <div class="trust-badge bg-white bg-opacity-10">
                        <i class="fas fa-check-circle text-white"></i>
                        <small class="fw-bold text-white">Verified Solvers</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/probsolve/frontend/pages/auth/register.php" class="btn btn-light btn-lg px-5 py-3 btn-magnetic">
                    <i class="fas fa-rocket me-2"></i>Join Now
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // 1. PARTICLE SYSTEM
    // ============================================
    const canvas = document.getElementById('particles-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    let mouse = { x: null, y: null, radius: 150 };
    
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        initParticles();
    });
    
    canvas.addEventListener('mousemove', (e) => {
        mouse.x = e.x;
        mouse.y = e.y;
    });
    
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 3 + 1;
            this.speedX = Math.random() * 2 - 1;
            this.speedY = Math.random() * 2 - 1;
            this.color = `rgba(255, 255, 255, ${Math.random() * 0.5 + 0.2})`;
        }
        
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            
            // Mouse interaction
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            
            if (distance < mouse.radius) {
                const force = (mouse.radius - distance) / mouse.radius;
                const directionX = dx / distance;
                const directionY = dy / distance;
                this.x -= directionX * force * 5;
                this.y -= directionY * force * 5;
            }
            
            // Bounce off edges
            if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
            if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
        }
        
        draw() {
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }
    
    function initParticles() {
        particles = [];
        const numberOfParticles = (canvas.width * canvas.height) / 15000;
        for (let i = 0; i < numberOfParticles; i++) {
            particles.push(new Particle());
        }
    }
    
    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });
        
        // Connect particles
        particles.forEach((a, indexA) => {
            particles.slice(indexA + 1).forEach(b => {
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 100) {
                    ctx.strokeStyle = `rgba(255, 255, 255, ${0.2 - distance / 500})`;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(a.x, a.y);
                    ctx.lineTo(b.x, b.y);
                    ctx.stroke();
                }
            });
        });
        
        requestAnimationFrame(animateParticles);
    }
    
    initParticles();
    animateParticles();
    
    // ============================================
    // 2. STATS COUNTER ANIMATION
    // ============================================
    const counters = document.querySelectorAll('.stat-number');
    let counterStarted = false;
    
    function animateCounters() {
        if (counterStarted) return;
        counterStarted = true;
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            };
            
            updateCounter();
        });
    }
    
    // Start counters immediately
    setTimeout(animateCounters, 500);
    
    // ============================================
    // 3. INTERSECTION OBSERVER FOR SCROLL REVEALS
    // ============================================
    const revealElements = document.querySelectorAll('.reveal');
    
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);
    
    revealElements.forEach(el => observer.observe(el));
    
    // ============================================
    // 4. SCROLL PROGRESS BAR
    // ============================================
    const progressBar = document.getElementById('scrollProgress');
    
    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });
    
    // ============================================
    // 5. CONFETTI EFFECT ON CTA BUTTON HOVER
    // ============================================
    const ctaButton = document.getElementById('ctaButton');
    let confettiTimeout;
    
    function createConfetti(x, y) {
        const colors = ['#667eea', '#764ba2', '#ec4899', '#fbbf24', '#06b6d4'];
        for (let i = 0; i < 15; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = x + 'px';
            confetti.style.top = y + 'px';
            confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
            confetti.style.animationDelay = Math.random() * 0.3 + 's';
            confetti.style.animationDuration = (Math.random() * 2 + 1) + 's';
            document.body.appendChild(confetti);
            
            setTimeout(() => confetti.remove(), 3000);
        }
    }
    
    if (ctaButton) {
        ctaButton.addEventListener('mouseenter', (e) => {
            clearTimeout(confettiTimeout);
            confettiTimeout = setTimeout(() => {
                const rect = ctaButton.getBoundingClientRect();
                createConfetti(rect.left + rect.width / 2, rect.top + rect.height / 2);
            }, 300);
        });
        
        ctaButton.addEventListener('mouseleave', () => {
            clearTimeout(confettiTimeout);
        });
    }
    
    // ============================================
    // 6. MAGNETIC BUTTON EFFECT
    // ============================================
    const magneticButtons = document.querySelectorAll('.btn-magnetic');
    
    magneticButtons.forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            button.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px) scale(1.05)`;
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'translate(0, 0) scale(1)';
        });
    });
    
    // ============================================
    // 7. SMOOTH PARALLAX SCROLL
    // ============================================
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroBlobs = document.querySelectorAll('.hero-section .blob');
        
        heroBlobs.forEach((blob, index) => {
            const speed = 0.3 + (index * 0.1);
            blob.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
    
    // ============================================
    // 8. 3D TILT EFFECT FOR CATEGORY CARDS
    // ============================================
    const categoryCards = document.querySelectorAll('.category-card');
    
    categoryCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-15px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
    
    // ============================================
    // 9. HAPTIC FEEDBACK (Mobile)
    // ============================================
    function triggerHaptic() {
        if ('vibrate' in navigator) {
            navigator.vibrate(10);
        }
    }
    
    document.querySelectorAll('button, .btn').forEach(btn => {
        btn.addEventListener('click', triggerHaptic);
    });
    
    // ============================================
    // 10. LAZY LOAD OPTIMIZATION
    // ============================================
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
