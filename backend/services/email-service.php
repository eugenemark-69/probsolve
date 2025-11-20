<?php
function sendEmail($to, $subject, $message) {
    // TODO: Use PHPMailer or similar for real email
    // For now, just log
    file_put_contents(__DIR__.'/../../logs/email.log', "To: $to\nSubject: $subject\n$message\n\n", FILE_APPEND);
    return true;
}
