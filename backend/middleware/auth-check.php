<?php
function getAuthenticatedUser() {
    // TODO: Implement real authentication (JWT/session)
    // For now, return a mock user
    return [
        'id' => 1,
        'role' => 'asker',
        'username' => 'demo_user'
    ];
}
