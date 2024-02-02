
// Check if the file exists, create it if not
if (!file_exists($countFile)) {
    file_put_contents($countFile, '0');
}

// Verify the presence of the special header key
$headers = apache_request_headers(); // If using Apache
if (!isset($headers['key_tos']) || $headers['key_tos'] !== $expectedHeaderKey) {
    header('HTTP/1.1 403 Forbidden');
    exit('Invalid or missing header key');
}

// Read the current count from the file
$currentCount = file_get_contents($countFile);

// Increment the count
$newCount = intval($currentCount) + 1;

// Update the file with the new count
file_put_contents($countFile, $newCount);

// Set the Content-Type header to text/html
header('Content-Type: text/html');

// Output the count as HTML
echo "<h1>Count: $newCount</h1>";
