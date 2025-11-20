<?php
class Solution {
    public function listAll() { return []; }
    public function submit($userId, $data) { return 1; }
    public function update($userId, $data) { return true; }
    public function delete($userId, $solutionId) { return true; }
    public function get($solutionId) { return null; }
}
