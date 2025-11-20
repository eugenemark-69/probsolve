<!-- frontend/pages/asker/post-problem.php -->
<?php 
$page_title = "Post Problem - Probsolve";
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Post a New Problem
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="problemForm">
                            <!-- Problem Category -->
                            <div class="mb-4">
                                <label for="category" class="form-label fw-bold">Category *</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="">Choose a category...</option>
                                    <option value="writing">Writing & Scripting</option>
                                    <option value="relationship">Relationship Advice</option>
                                    <option value="academic">Academic Help</option>
                                    <option value="life">Life Solutions</option>
                                    <option value="technical">Technical Help</option>
                                    <option value="creative">Creative Work</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Problem Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold">Problem Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       placeholder="e.g., Need help writing a romantic birthday message" required>
                                <div class="form-text">Be specific about what you need help with.</div>
                            </div>

                            <!-- Problem Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Detailed Description *</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="6" placeholder="Describe your problem in detail..." required></textarea>
                                <div class="form-text">
                                    Include all relevant details. The more information you provide, the better solutions you'll receive.
                                </div>
                            </div>

                            <!-- Budget Settings -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Budget *</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="budgetType" class="form-label">Budget Type</label>
                                        <select class="form-select" id="budgetType" name="budgetType">
                                            <option value="fixed">Fixed Price</option>
                                            <option value="range">Price Range</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="budgetAmount" class="form-label">Amount (₱)</label>
                                        <input type="number" class="form-control" id="budgetAmount" 
                                               name="budgetAmount" min="15" max="10000" value="50" required>
                                    </div>
                                </div>
                                <div class="row mt-2" id="rangeFields" style="display: none;">
                                    <div class="col-md-6">
                                        <label for="budgetMin" class="form-label">Minimum (₱)</label>
                                        <input type="number" class="form-control" id="budgetMin" name="budgetMin">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="budgetMax" class="form-label">Maximum (₱)</label>
                                        <input type="number" class="form-control" id="budgetMax" name="budgetMax">
                                    </div>
                                </div>
                            </div>

                            <!-- Delivery Settings -->
                            <div class="mb-4">
                                <label for="deadline" class="form-label fw-bold">Delivery Deadline *</label>
                                <select class="form-select" id="deadline" name="deadline" required>
                                    <option value="1">1 Hour (₱50 premium)</option>
                                    <option value="3">3 Hours (₱30 premium)</option>
                                    <option value="24" selected>24 Hours</option>
                                    <option value="72">3 Days</option>
                                    <option value="168">1 Week</option>
                                </select>
                            </div>

                            <!-- Additional Options -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Additional Options</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="isAnonymous" name="isAnonymous">
                                    <label class="form-check-label" for="isAnonymous">
                                        Post anonymously
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="enableAI" name="enableAI">
                                    <label class="form-check-label" for="enableAI">
                                        Enable AI backup solution (+₱10) - Get AI solution if no human response in 1 hour
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isPrivate" name="isPrivate">
                                    <label class="form-check-label" for="isPrivate">
                                        Private problem (only invited solvers can see)
                                    </label>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="mb-4">
                                <label for="attachments" class="form-label fw-bold">Attachments (Optional)</label>
                                <input type="file" class="form-control" id="attachments" name="attachments" multiple>
                                <div class="form-text">Upload any relevant files. Maximum 5 files, 10MB each.</div>
                            </div>

                            <!-- Cost Summary -->
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title">Cost Summary</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Problem Budget:</span>
                                        <span id="budgetDisplay">₱50</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Urgency Premium:</span>
                                        <span id="premiumDisplay">₱0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>AI Backup:</span>
                                        <span id="aiDisplay">₱0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Platform Fee (10%):</span>
                                        <span id="feeDisplay">₱5</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total to Pay:</span>
                                        <span id="totalDisplay">₱55</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary me-md-2">Save as Draft</button>
                                <button type="submit" class="btn btn-primary">Post Problem & Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const budgetType = document.getElementById('budgetType');
    const rangeFields = document.getElementById('rangeFields');
    const budgetAmount = document.getElementById('budgetAmount');
    const budgetMin = document.getElementById('budgetMin');
    const budgetMax = document.getElementById('budgetMax');
    const deadline = document.getElementById('deadline');
    const enableAI = document.getElementById('enableAI');
    
    // Budget type toggle
    budgetType.addEventListener('change', function() {
        if (this.value === 'range') {
            rangeFields.style.display = 'flex';
            budgetAmount.required = false;
            budgetMin.required = true;
            budgetMax.required = true;
        } else {
            rangeFields.style.display = 'none';
            budgetAmount.required = true;
            budgetMin.required = false;
            budgetMax.required = false;
        }
        updateCostSummary();
    });

    // Update cost summary when values change
    [budgetAmount, budgetMin, budgetMax, deadline, enableAI].forEach(element => {
        if (element) {
            element.addEventListener('change', updateCostSummary);
            element.addEventListener('input', updateCostSummary);
        }
    });

    function updateCostSummary() {
        let budget = parseInt(budgetAmount.value) || 0;
        let premium = 0;
        let aiCost = enableAI.checked ? 10 : 0;
        
        // Calculate premium based on deadline
        const deadlineValue = deadline.value;
        if (deadlineValue === '1') premium = 50;
        else if (deadlineValue === '3') premium = 30;
        
        const subtotal = budget + premium + aiCost;
        const fee = Math.ceil(subtotal * 0.1);
        const total = subtotal + fee;
        
        document.getElementById('budgetDisplay').textContent = `₱${budget}`;
        document.getElementById('premiumDisplay').textContent = `₱${premium}`;
        document.getElementById('aiDisplay').textContent = `₱${aiCost}`;
        document.getElementById('feeDisplay').textContent = `₱${fee}`;
        document.getElementById('totalDisplay').textContent = `₱${total}`;
    }

    // Initial calculation
    updateCostSummary();
});

document.getElementById('problemForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch('/probsolve/backend/api/problems/create.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            alert('Problem posted successfully!');
            window.location.href = 'my-problems.php';
        } else {
            alert(result.error || 'Failed to post problem.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An unexpected error occurred. Please try again.');
    }
});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>