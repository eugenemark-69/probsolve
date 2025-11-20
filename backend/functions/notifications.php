<?php
function notifyUser($userId, $message) {
    // TODO: Integrate with real-time server or email
    file_put_contents(__DIR__.'/../../logs/notifications.log', "User: $userId\n$message\n\n", FILE_APPEND);
    return true;
}
