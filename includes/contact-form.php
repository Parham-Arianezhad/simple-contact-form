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

        // Redirect to the same page with a success parameter
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = remove_query_arg('success', $url); // Remove old param if exists
        $url = add_query_arg('success', '1', $url);
        wp_redirect($url);
        exit;
    } else {
        echo '<p class="scf-error-message">All required fields must be filled out. Please try again.</p>';
    }
}

// Show success message if redirected
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo '<p class="scf-success-message">Thank you for reaching out. We will get back to you soon!</p>';
}
?>

<div class="contact_us">
    <div class="responsive-container-block container">
        <form class="form-box" method="post" autocomplete="off">
            <div class="container-block form-wrapper">
                <div class="responsive-container-block">
                    <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6" id="i10mt-4">
                        <p class="text-blk input-title">
                            First Name
                        </p>
                        <input class="input" id="ijowk-4" name="scf-first-name" type="text" required>
                    </div>
                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                        <p class="text-blk input-title">
                            Last Name
                        </p>
                        <input class="input" id="indfi-3" name="scf-last-name" type="text" required>
                    </div>
                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                        <p class="text-blk input-title">
                            Email
                        </p>
                        <input class="input" id="ipmgh-4" name="scf-email" type="email" required>
                    </div>
                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                        <p class="text-blk input-title">
                            Phone No.
                        </p>
                        <input class="input" id="imgis-4" name="scf-phone" type="text">
                    </div>
                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i634i-4">
                        <p class="text-blk input-title">
                            Message
                        </p>
                        <textarea class="textinput" id="i5vyy-4" name="scf-message" placeholder="Write your message..."
                            required style="resize: none;"></textarea>
                    </div>
                </div>
                <button class="submit-btn" type="submit">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>