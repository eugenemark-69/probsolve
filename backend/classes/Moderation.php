<?php

class Moderation {

    public function getModerationQueue() {
        // Simulate fetching moderation queue from the database
        return [
            ['id' => 1, 'content' => 'Example content 1', 'status' => 'pending'],
            ['id' => 2, 'content' => 'Example content 2', 'status' => 'flagged'],
        ];
    }

    public function approveContent($contentId) {
        // Simulate approving content
        return ['success' => true, 'message' => "Content $contentId approved."];
    }

    public function rejectContent($contentId) {
        // Simulate rejecting content
        return ['success' => true, 'message' => "Content $contentId rejected."];
    }

    public function flagContent($contentId) {
        // Simulate flagging content
        return ['success' => true, 'message' => "Content $contentId flagged."];
    }
}