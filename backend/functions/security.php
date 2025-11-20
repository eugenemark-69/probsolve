<?php
function preventXSS($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
function usePreparedStatements($query, $params) {
    // TODO: Use PDO prepared statements for DB queries
}
