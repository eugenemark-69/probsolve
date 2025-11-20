<!-- frontend/includes/modals/chat.php -->
<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Chat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="chat-box" style="height:300px; overflow-y:auto; background:#f8f9fa; padding:1rem;">
          <!-- Messages will be dynamically loaded here -->
        </div>
        <form id="chatForm" class="mt-3">
          <div class="input-group">
            <input type="text" class="form-control" id="chatMessage" placeholder="Type your message..." required>
            <button class="btn btn-primary" type="submit">Send</button>
          </div>
        </form>
        <div class="alert alert-danger d-none mt-2" id="chatError"></div>
      </div>
    </div>
  </div>
</div>
