<!-- frontend/includes/modals/post-problem.php -->
<!-- Post Problem Modal -->
<div class="modal fade" id="postProblemModal" tabindex="-1" aria-labelledby="postProblemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postProblemModalLabel">Post a Problem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="postProblemForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="problemTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="problemTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="problemDescription" class="form-label">Description</label>
            <textarea class="form-control" id="problemDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="problemBudget" class="form-label">Budget (₱)</label>
            <input type="number" class="form-control" id="problemBudget" name="budget" min="0" required>
          </div>
          <div class="alert alert-danger d-none" id="postProblemError"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Post Problem</button>
        </div>
      </form>
    </div>
  </div>
</div>
