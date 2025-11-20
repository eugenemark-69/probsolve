<?php
class Message {
    public function listAll($problemId) { return []; }
    public function send($fromUser, $toUser, $data) { return 1; }
    public function get($messageId) { return null; }
}
