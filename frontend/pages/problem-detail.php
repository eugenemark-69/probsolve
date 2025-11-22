<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/header.php';

// Get problem ID from URL
$problemId = $_GET['id'] ?? null;

if (!$problemId) {
    header('Location: /probsolve/frontend/pages/browse-problems.php');
    exit;
}
?>

<div class="container mt-5">
    <div class="row">
        <!-- Main Problem Content -->
        <div class="col-md-8">
            <div id="problem-container" class="card mb-4">
                <div class="card-body">
                    <p class="text-muted">Loading problem...</p>
                </div>
            </div>

            <!-- Solutions Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Solutions <span id="solutions-count" class="badge bg-primary">0</span></h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#submitSolutionModal">
                            Submit Solution
                        </button>
                    <?php else: ?>
                        <p class="text-muted">
                            <a href="/probsolve/frontend/pages/auth/login.php">Login</a> to submit a solution
                        </p>
                    <?php endif; ?>
                    <div id="solutions-container"></div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card">
                <div class="card-header">
                    <h5>Comments <span id="comments-count" class="badge bg-primary">0</span></h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form id="commentForm" class="mb-4">
                            <div class="mb-3">
                                <textarea class="form-control" id="comment-text" placeholder="Write a comment..." rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    <?php else: ?>
                        <p class="text-muted mb-3">
                            <a href="/probsolve/frontend/pages/auth/login.php">Login</a> to post a comment
                        </p>
                    <?php endif; ?>
                    <div id="comments-container"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h6>Problem Stats</h6>
                    <div id="problem-stats"></div>
                </div>
            </div>
        </div>
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
                        <label class="form-label">Solution Content *</label>
                        <textarea class="form-control" id="solution-content" placeholder="Provide your solution..." rows="6" required></textarea>
                    </div>
                    <div id="solutionError" class="alert alert-danger d-none mb-3"></div>
                    <div id="solutionSuccess" class="alert alert-success d-none mb-3"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitSolution()">Submit Solution</button>
            </div>
        </div>
    </div>
</div>

<script>
const problemId = <?php echo json_encode($problemId); ?>;
const userId = <?php echo json_encode($_SESSION['user_id'] ?? null); ?>;

// Helper to escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

function loadProblem() {
    fetch(`/probsolve/backend/api/problems/get.php?id=${problemId}`, { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (data.success && data.problem) {
                const p = data.problem;
                const container = document.getElementById('problem-container');
                const bountyDisplay = p.bounty ? `₱${parseFloat(p.bounty).toFixed(2)}` : 'No bounty';
                
                container.innerHTML = `
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2>${p.title}</h2>
                                <small class="text-muted">Posted by <strong>${p.username}</strong> on ${new Date(p.created_at).toLocaleDateString()}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">${bountyDisplay}</span>
                            </div>
                        </div>
                        <p class="card-text">${p.description}</p>
                        <div class="mb-3">
                            <span class="badge bg-info">${p.category_name}</span>
                            <span class="badge bg-secondary">${p.status}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" onclick="likeProblem()" id="likeBtn">
                                <i class="fas fa-thumbs-up"></i> Like <span id="like-count">${p.likes_count || 0}</span>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="viewComments()">
                                <i class="fas fa-comments"></i> Comments <span id="comment-badge">${p.comments_count || 0}</span>
                            </button>
                        </div>
                    </div>
                `;

                // Update sidebar stats
                document.getElementById('problem-stats').innerHTML = `
                    <p><strong>Views:</strong> ${p.views_count || 0}</p>
                    <p><strong>Likes:</strong> <span id="stats-likes">${p.likes_count || 0}</span></p>
                    <p><strong>Comments:</strong> <span id="stats-comments">${p.comments_count || 0}</span></p>
                    <p><strong>Solutions:</strong> <span id="stats-solutions">${p.solutions_count || 0}</span></p>
                `;
                
                loadComments();
                loadSolutions();
            } else {
                document.getElementById('problem-container').innerHTML = '<p class="text-danger">Problem not found</p>';
            }
        })
        .catch(err => {
            console.error('Error:', err);
            document.getElementById('problem-container').innerHTML = '<p class="text-danger">Error loading problem</p>';
        });
}

function loadComments() {
    const url = `/probsolve/backend/api/comments/list.php?problem_id=${problemId}`;
    console.log('Loading comments from:', url);
    
    fetch(url, { credentials: 'same-origin' })
        .then(r => {
            console.log('Response status:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('Comments API response:', data);
            const container = document.getElementById('comments-container');
            
            if (!data.success) {
                console.error('API returned success=false:', data.error);
                container.innerHTML = '<p class="text-danger">Error: ' + (data.error || 'Unknown error') + '</p>';
                return;
            }
            
            const comments = data.comments || [];
            console.log('Number of comments:', comments.length);
            
            if (comments.length > 0) {
                container.innerHTML = '';
                document.getElementById('comments-count').textContent = comments.length;
                
                comments.forEach((comment, index) => {
                    console.log(`Rendering comment ${index}:`, comment);
                    const div = document.createElement('div');
                    div.className = 'card mb-2';
                    div.id = `comment-${comment.id}`;
                    const likeDisabled = !userId ? 'disabled' : '';
                    const likeTitle = !userId ? 'Login to like' : 'Like this comment';
                    const likeCount = parseInt(comment.likes_count) || 0;
                    const username = comment.username ? escapeHtml(comment.username) : 'Anonymous';
                    const content = comment.content ? escapeHtml(comment.content) : '(empty)';
                    
                    div.innerHTML = `
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>${username}</strong>
                                    <small class="text-muted">${new Date(comment.created_at).toLocaleDateString()}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-primary like-btn" data-comment-id="${comment.id}" onclick="likeComment(${comment.id})" ${likeDisabled} title="${likeTitle}">
                                    <i class="fas fa-thumbs-up"></i> <span class="like-count">${likeCount}</span>
                                </button>
                            </div>
                            <p class="mb-0">${content}</p>
                        </div>
                    `;
                    container.appendChild(div);
                });
                console.log('All comments rendered successfully');
            } else {
                console.log('No comments found');
                document.getElementById('comments-count').textContent = '0';
                container.innerHTML = '<p class="text-muted">No comments yet. Be the first to comment!</p>';
            }
        })
        .catch(err => {
            console.error('Error loading comments:', err);
            document.getElementById('comments-container').innerHTML = '<p class="text-danger">Error loading comments: ' + err.message + '</p>';
        });
}

function loadSolutions() {
    fetch(`/probsolve/backend/api/solutions/list.php?problem_id=${problemId}`, { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            const container = document.getElementById('solutions-container');
            if (data.success && data.solutions && data.solutions.length > 0) {
                container.innerHTML = '';
                document.getElementById('solutions-count').textContent = data.solutions.length;
                data.solutions.forEach(solution => {
                    const div = document.createElement('div');
                    div.className = 'card mb-2';
                    const acceptedBadge = solution.is_accepted ? '<span class="badge bg-success">Accepted</span>' : '';
                    div.innerHTML = `
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>${solution.username}</strong>
                                    <small class="text-muted">${new Date(solution.submitted_at).toLocaleDateString()}</small>
                                    ${acceptedBadge}
                                </div>
                                <button class="btn btn-sm btn-outline-primary" onclick="likeSolution(${solution.id})">
                                    <i class="fas fa-thumbs-up"></i> ${solution.likes_count || 0}
                                </button>
                            </div>
                            <p>${solution.content}</p>
                        </div>
                    `;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = '<p class="text-muted">No solutions yet. Be the first to solve!</p>';
            }
        })
        .catch(err => console.error('Error loading solutions:', err));
}

document.getElementById('commentForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const content = document.getElementById('comment-text').value;
    
    fetch('/probsolve/backend/api/comments/create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify({ problem_id: problemId, content })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('comment-text').value = '';
            loadComments();
        } else {
            alert(data.error || 'Failed to post comment');
        }
    })
    .catch(err => console.error('Error:', err));
});

function likeProblem() {
    if (!userId) {
        window.location.href = '/probsolve/frontend/pages/auth/login.php';
        return;
    }
    
    fetch('/probsolve/backend/api/problems/like.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify({ problem_id: problemId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            loadProblem();
        }
    })
    .catch(err => console.error('Error:', err));
}

function likeComment(commentId) {
    if (!userId) {
        window.location.href = '/probsolve/frontend/pages/auth/login.php';
        return;
    }
    
    fetch('/probsolve/backend/api/comment-likes/create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify({ comment_id: commentId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            loadComments();
        }
    })
    .catch(err => console.error('Error:', err));
}

function likeSolution(solutionId) {
    if (!userId) {
        window.location.href = '/probsolve/frontend/pages/auth/login.php';
        return;
    }
    
    fetch('/probsolve/backend/api/solution-likes/create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify({ solution_id: solutionId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            loadSolutions();
        }
    })
    .catch(err => console.error('Error:', err));
}

function submitSolution() {
    const content = document.getElementById('solution-content').value;
    const errorEl = document.getElementById('solutionError');
    const successEl = document.getElementById('solutionSuccess');
    
    errorEl.classList.add('d-none');
    successEl.classList.add('d-none');
    
    fetch('/probsolve/backend/api/solutions/submit.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify({ problem_id: problemId, content })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            successEl.textContent = 'Solution submitted successfully!';
            successEl.classList.remove('d-none');
            document.getElementById('solution-content').value = '';
            setTimeout(() => {
                bootstrap.Modal.getInstance(document.getElementById('submitSolutionModal')).hide();
                loadSolutions();
            }, 1000);
        } else {
            errorEl.textContent = data.error || 'Failed to submit solution';
            errorEl.classList.remove('d-none');
        }
    })
    .catch(err => {
        errorEl.textContent = 'Error: ' + err.message;
        errorEl.classList.remove('d-none');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    loadProblem();
    loadComments();
    loadSolutions();
});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/probsolve/frontend/includes/footer.php'; ?>
