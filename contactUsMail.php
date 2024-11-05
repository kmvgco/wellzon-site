<?php
// CORS handling (optional, if you're making cross-origin requests)
$allowed_origins = [
    'https://wellzonapp.com',
    'https://www.wellzonapp.com'
];

if (in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Main email handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email configuration
    $to = "social@wellzonapp.com";
    $subject = "New Contact Us Submission";

    // Get and sanitize form data
    $firstname = isset($_POST['firstname']) ? htmlspecialchars(trim($_POST['firstname'])) : '';
    $lastname = isset($_POST['lastname']) ? htmlspecialchars(trim($_POST['lastname'])) : '';
    $businessName = isset($_POST['businessName']) ? htmlspecialchars(trim($_POST['businessName'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $subjectField = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';

    // Prepare the HTML email message
    $message = "
    <html>
    <head>
        <title>Contact Us Submission</title>
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
            .info {
                margin: 10px 0;
            }
            .info strong {
                color: #333;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <img src='https://wellzone-merchant.acublock.in/landing-pages/assets/images/wellzon_logo.png' alt='Wellzon Logo'>
                <h1>New Contact Us Submission</h1>
            </div>
            <p>Hello Admin,</p>
            <p>You have received a new contact form submission. Here are the details:</p>
            <div class='info'>
                <strong>First Name:</strong> $firstname<br>
                <strong>Last Name:</strong> $lastname<br>
                <strong>Business Name:</strong> $businessName<br>
                <strong>Email:</strong> $email<br>
                <strong>Phone:</strong> $phone<br>
                <strong>Topic of Concern:</strong><br>
                $subjectField
            </div>
            <p>Thank you!</p>
            <div class='footer'>
                <p>&copy; " . date('Y') . " Wellzon. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Set the content-type and other headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Wellzon <social@wellzonapp.com>' . "\r\n"; // Set sender name

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo 'Email sent successfully!';
    } else {
        echo 'Email sending failed. Please try again later.';
    }
} else {
    echo 'Invalid request method.';
}
?>