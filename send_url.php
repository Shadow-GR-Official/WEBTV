<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $data = json_decode(file_get_contents('php://input'), true);
    $url = filter_var($data['url'], FILTER_SANITIZE_URL);

    // Send email
    $to = 'skia.official.gr@gmail.com'; // Your email address
    $subject = 'New M3U8 URL Submitted';
    $message = "A new M3U8 URL has been submitted:\n" . $url;
    $headers = 'From: no-reply@example.com' . "\r\n"; // Replace with a valid sender email if needed

    if (filter_var($url, FILTER_VALIDATE_URL) && mail($to, $subject, $message, $headers)) {
        echo json_encode(['message' => 'URL sent successfully.']);
    } else {
        echo json_encode(['message' => 'Failed to send URL.']);
    }
} else {
    echo json_encode(['message' => 'Invalid request method.']);
}
?>
