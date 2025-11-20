<?php include_once '../../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <h2 class="text-3xl font-semibold mb-2 text-blue-700">My Solutions</h2>
    <div class="w-full max-w-3xl bg-white rounded shadow p-6 mt-4">
        <!-- Solutions list placeholder -->
        <div class="text-center text-gray-400">Your submitted solutions will appear here.</div>
    </div>
</div>
<?php include_once '../../includes/footer.php'; ?>
<!-- frontend/pages/solver/my-solutions.php -->
<?php 
$page_title = "My Solutions - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3">My Solutions</h1>
                <p class="text-muted">Track your submitted solutions and earnings</p>
            </div>
        </div>

        <!-- Solutions Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option value="">All Status</option>
                            <option value="submitted">Submitted</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select class="form-select">
                            <option value="">All Categories</option>
                            <option value="writing">Writing</option>
                            <option value="relationship">Relationship</option>
                            <option value="academic">Academic</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date Range</label>
                        <select class="form-select">
                            <option value="">All Time</option>
                            <option value="7">Last 7 days</option>
                            <option value="30">Last 30 days</option>
                            <option value="90">Last 90 days</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solutions List -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Solution History</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Problem</th>
                                <th>Category</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Earnings</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $solutions = [
                                ['Birthday message writing', 'Writing', '2 hours ago', 'accepted', '₱68', '5.0'],
                                ['Math homework help', 'Academic', '1 day ago', 'accepted', '₱120', '4.5'],
                                ['Relationship advice', 'Relationship', '2 days ago', 'submitted', '₱90', '-'],
                                ['Business email writing', 'Writing', '3 days ago', 'draft', '₱0', '-'],
                                ['Python programming help', 'Technical', '1 week ago', 'rejected', '₱0', '-']
                            ];
                            
                            foreach($solutions as $solution): 
                                $statusClass = [
                                    'accepted' => 'success',
                                    'submitted' => 'warning', 
                                    'draft' => 'secondary',
                                    'rejected' => 'danger'
                                ][$solution[3]];
                            ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= $solution[0] ?></div>
                                    <small class="text-muted">Budget: ₱<?= str_replace('₱', '', $solution[4]) + 7 ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-primary"><?= $solution[1] ?></span>
                                </td>
                                <td>
                                    <small><?= $solution[2] ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $statusClass ?>"><?= ucfirst($solution[3]) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success"><?= $solution[4] ?></span>
                                </td>
                                <td>
                                    <?php if($solution[5] != '-'): ?>
                                        <div class="d-flex align-items-center">
                                            <span class="text-warning me-1"><?= $solution[5] ?></span>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View</a></li>
                                            <?php if($solution[3] == 'draft'): ?>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <?php endif; ?>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <nav aria-label="Solution pagination">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    async function loadMySolutions() {
        try {
            const response = await fetch('/probsolve/backend/api/solutions/list.php');
            const solutions = await response.json();

            if (response.ok) {
                const container = document.getElementById('solutionsContainer');
                container.innerHTML = solutions.map(solution => `
                    <div class='solution-item'>
                        <h5>${solution.problem_title}</h5>
                        <p>${solution.content}</p>
                        <small>Status: ${solution.status}</small>
                    </div>
                `).join('');
            } else {
                console.error('Failed to load solutions:', solutions.error);
            }
        } catch (error) {
            console.error('Error loading solutions:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadMySolutions);
</script>

<!-- Replace static content with dynamic container -->
<div id="solutionsContainer"></div>

<?php include '../../includes/footer.php'; ?>