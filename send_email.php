<?php
$allowed_origins = [
    'https://wellzonapp.com',
    'https://www.wellzonapp.com'
];

if (in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

// Handle preflight request for OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "social@wellzonapp.com";
    $subject = "New Subscription Alert";

    // Get form data
    $email = htmlspecialchars($_POST['email']);

    $message = "
        <html>
        <head>
            <title>New Subscription Notification</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: auto;
                    background: white;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    padding: 10px 0;
                }
                .header img {
                    max-width: 100px;
                }
                h1 {
                    color: #333;
                }
                p {
                    color: #555;
                    line-height: 1.6;
                }
                .footer {
                    margin-top: 20px;
                    text-align: center;
                    font-size: 12px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <img src='https://wellzone-merchant.acublock.in/landing-pages/assets/images/wellzon_logo.png' alt='Wellzon Logo'>
                    <h1>New Subscription Alert</h1>
                </div>
                <p>Hello Admin,</p>
                <p>A new user has subscribed for updates with the email: <strong>$email</strong>.</p>
                <p>Ensure to review new subscriptions regularly to engage with your audience.</p>
                <div class='footer'>
                    <p>&copy; " . date('Y') . " Wellzon. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Set sender name
    $headers .= 'From: Wellzon <social@wellzonapp.com>' . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo 'Email sent successfully!';
    } else {
        echo 'Email sending failed.';
    }
} else {
    echo 'Invalid request method.';
}
?>