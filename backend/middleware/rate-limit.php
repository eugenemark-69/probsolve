<?php
function rateLimit($key, $limit = 60, $window = 60) {
    // Simple file-based rate limiting for demo
    $file = sys_get_temp_dir() . "/rate_" . md5($key);
    $data = @json_decode(@file_get_contents($file), true) ?: ['count' => 0, 'start' => time()];
    if (time() - $data['start'] > $window) {
        $data = ['count' => 0, 'start' => time()];
    }
    $data['count']++;
    file_put_contents($file, json_encode($data));
    if ($data['count'] > $limit) {
        http_response_code(429);
        echo json_encode(['error' => 'Rate limit exceeded']);
        exit;
    }
}
