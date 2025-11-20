<?php
class Problem {
    public function listAll() {
        // TODO: Fetch all problems from DB
        return [];
    }
    public function create($userId, $data) {
        // TODO: Insert new problem into DB
        return 1; // Return new problem ID
    }
    public function update($userId, $data) {
        // TODO: Update problem in DB
        return true;
    }
    public function delete($userId, $problemId) {
        // TODO: Delete problem from DB
        return true;
    }
    public function get($problemId) {
        // TODO: Fetch single problem from DB
        return null;
    }
}
