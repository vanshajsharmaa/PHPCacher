<?php
// Cache directory
define('CACHE_DIR', 'cache/');

// Create cache directory if it doesn't exist
if (!file_exists(CACHE_DIR)) {
    mkdir(CACHE_DIR, 0777, true);
}

// Function to load content (simulate fetching content from a database or file)
function load_content() {
    // Example content (this could be a query or reading from a file)
    return "This is some dynamically loaded content at " . date('Y-m-d H:i:s');
}

// Function to check cache and load content if needed
function load_cached_content($cache_filename) {
    $cache_file = CACHE_DIR . $cache_filename;
    
    // Check if cache file exists and is not expired (set an expiration time, e.g., 3600 seconds = 1 hour)
    if (file_exists($cache_file) && (filemtime($cache_file) + 3600 > time())) {
        // Load content from cache
        return file_get_contents($cache_file);
    } else {
        // Cache expired or file doesn't exist, load content
        $content = load_content();
        
        // Save the content to the cache file
        file_put_contents($cache_file, $content);
        
        return $content;
    }
}

// Define cache file name
$cache_filename = 'cached_content.txt';

// Load content (either from cache or fresh)
$content = load_cached_content($cache_filename);

// Output the content to the webpage
echo $content;
?>
