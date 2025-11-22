<!-- frontend/includes/modals/post-problem.php -->
<!-- Post Problem Modal -->
<div class="modal fade" id="postProblemModal" tabindex="-1" aria-labelledby="postProblemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postProblemModalLabel">Post a Problem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="postProblemForm">
        <div class="modal-body">
          <!-- Title -->
          <div class="mb-3">
            <label for="problemTitle" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="problemTitle" name="title" placeholder="What is your problem?" required>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="problemDescription" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" id="problemDescription" name="description" rows="4" placeholder="Describe your problem in detail..." required></textarea>
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label for="problemCategory" class="form-label">Category <span class="text-danger">*</span></label>
            <select class="form-select" id="problemCategory" name="category" required>
              <option value="">Select a category</option>
              <option value="programming">Programming</option>
              <option value="design">Design</option>
              <option value="writing">Writing</option>
              <option value="math">Math</option>
              <option value="science">Science</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Bounty (Optional) -->
          <div class="mb-3">
            <label for="problemBounty" class="form-label">Bounty (₱) <span class="text-muted">(Optional)</span></label>
            <input type="number" class="form-control" id="problemBounty" name="bounty" min="0" step="0.01" placeholder="Leave empty for no bounty">
            <small class="text-muted">Offer a bounty to attract solvers</small>
          </div>

          <!-- Files (Optional) -->
          <div class="mb-3">
            <label for="problemFiles" class="form-label">Attachments <span class="text-muted">(Optional)</span></label>
            <input type="file" class="form-control" id="problemFiles" name="files" multiple>
            <small class="text-muted">Upload relevant files or documents</small>
          </div>

          <div class="alert alert-danger d-none" id="postProblemError"></div>
          <div class="alert alert-success d-none" id="postProblemSuccess"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Post Problem</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('postProblemForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('problemTitle').value;
    const description = document.getElementById('problemDescription').value;
    const category = document.getElementById('problemCategory').value;
    const bounty = document.getElementById('problemBounty').value || null;
    
    const errorEl = document.getElementById('postProblemError');
    const successEl = document.getElementById('postProblemSuccess');
    
    errorEl.classList.add('d-none');
    successEl.classList.add('d-none');
    
    const formData = {
        title: title,
        description: description,
        category: category,
        bounty: bounty ? parseFloat(bounty) : null
    };
    
    fetch('/probsolve/backend/api/problems/create.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'same-origin',
        body: JSON.stringify(formData)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            successEl.textContent = 'Problem posted successfully!';
            successEl.classList.remove('d-none');
            
            // Reset form
            document.getElementById('postProblemForm').reset();
            
            // Close modal after 2 seconds
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('postProblemModal'));
                modal.hide();
                
                // Reload problems list if it exists
                if (typeof loadProblems === 'function') {
                    loadProblems();
                }
                
                // Reload page or refresh data
                location.reload();
            }, 2000);
        } else {
            errorEl.textContent = data.error || 'Failed to post problem';
            errorEl.classList.remove('d-none');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        errorEl.textContent = 'Error posting problem: ' + err.message;
        errorEl.classList.remove('d-none');
    });
});
</script>
