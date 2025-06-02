<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form fields
    $first_name = sanitize_text_field($_POST['scf-first-name']);
    $last_name = sanitize_text_field($_POST['scf-last-name']);
    $email = sanitize_email($_POST['scf-email']);
    $phone = sanitize_text_field($_POST['scf-phone']);
    $message = sanitize_textarea_field($_POST['scf-message']);

// Send the email if all required fields are filled
if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($message)) {
    $to = get_option('admin_email');
    $subject = 'New Contact Form Submission';
    $body = "You have received a new message from $first_name $last_name.<br><br>";
    $body .= "<strong>Email:</strong> $email<br>";
    $body .= "<strong>Phone:</strong> $phone<br>";
    $body .= "<strong>Message:</strong><br>$message<br>";
    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    wp_mail($to, $subject, $body, $headers);
    echo '<p class="scf-success-message">Thank you for reaching out. We will get back to you soon!</p>';
} else {
    echo '<p class="scf-error-message">All required fields must be filled out. Please try again.</p>';
}
}
?>

<form id="scf-contact-form" method="post" action="">
    <div class="scf-form-group">
        <label for="scf-first-name">First Name:</label>
        <input type="text" id="scf-first-name" name="scf-first-name" required>
    </div>
    <div class="scf-form-group">
        <label for="scf-last-name">Last Name:</label>
        <input type="text" id="scf-last-name" name="scf-last-name" required>
    </div>
    <div class="scf-form-group">
        <label for="scf-email">Email:</label>
        <input type="email" id="scf-email" name="scf-email" required>
    </div>
    <div class="scf-form-group">
        <label for="scf-phone">Phone Number:</label>
        <input type="tel" id="scf-phone" name="scf-phone">
    </div>
    <div class="scf-form-group">
        <label for="scf-message">Message:</label>
        <textarea id="scf-message" name="scf-message" rows="5" required></textarea>
    </div>
    <button type="submit" class="scf-submit-button">Send Message</button>
</form>