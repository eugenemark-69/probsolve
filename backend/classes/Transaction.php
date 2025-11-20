<?php
class Transaction {
    public function listAll() { return []; }
    public function create($data) { return 1; }
    public function update($transactionId, $data) { return true; }
    public function get($transactionId) { return null; }
}
