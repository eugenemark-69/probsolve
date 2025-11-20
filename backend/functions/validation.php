<?php
function validateProblemData($data, $isUpdate = false) {
    // Basic validation for problem data
    if (!$isUpdate) {
        if (empty($data['title']) || empty($data['description']) || empty($data['category']) || empty($data['budget'])) {
            return ['valid' => false, 'error' => 'Missing required fields'];
        }
    }
    // Additional validation logic here
    return ['valid' => true];
}
