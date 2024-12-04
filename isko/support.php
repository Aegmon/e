<?php
include("sidebar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $subject = $_POST['subject'];
    $priority = $_POST['rel_stat'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    $attachment = $_FILES['image'];

    // Email setup
    $to = "aseest080122@gmail.com";
    $email_subject = "New Ticket Submitted: $subject";

    // Boundary string for the email
    $boundary = md5(time());

    // Headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Email body
    $email_body = "--$boundary\r\n";
    $email_body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $email_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $email_body .= "A new ticket has been submitted.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Priority: $priority\n";
    $email_body .= "Message:\n$content\n";

    // Attachment
    if (!empty($attachment['tmp_name']) && is_uploaded_file($attachment['tmp_name'])) {
        $file_tmp = $attachment['tmp_name'];
        $file_name = $attachment['name'];
        $file_content = file_get_contents($file_tmp);
        $file_content = chunk_split(base64_encode($file_content));

        $email_body .= "--$boundary\r\n";
        $email_body .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";
        $email_body .= "Content-Transfer-Encoding: base64\r\n";
        $email_body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
        $email_body .= $file_content . "\r\n";
    }

    // Closing boundary
    $email_body .= "--$boundary--";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        $success_message = "Your ticket has been submitted successfully. We will respond to you soon.";
    } else {
        $error_message = "There was an issue submitting your ticket. Please try again later.";
    }
}
?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Submit a Ticket</h5>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php if (isset($success_message)): ?>
                                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                                <?php elseif (isset($error_message)): ?>
                                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="form-control" name="rel_stat" required>
                                        <option value="" disabled selected>Select a level</option>
                                        <option value="general">General Issue</option>
                                        <option value="medium">Medium</option>
                                        <option value="critical">Critical</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input class="form-control form-control-lg" type="text" name="name" value="<?php echo $fname . ' ' . $lname; ?>" required placeholder="Enter your name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control form-control-lg" type="email" name="email" value="<?php echo $email; ?>" required placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">
                                        <i>Explain your concern, include all the details related to the transaction to help speed up our investigation.</i>
                                    </label>
                                    <textarea class="form-control" id="content" name="content" placeholder="Write a message..." required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Attachments</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>

                                <div class="mb-3">
                                    <label for="note" class="form-label">
                                        <i>Please note that the expected response time for your query is between 8:00 a.m. and 4:00 p.m.</i>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input type="submit" class="btn btn-lg btn-primary" value="Create Ticket">
                                </div>
                            </div>
                        </form>   
                    </div> 
                </div>
            </div>
        </div>
    </main>
</div>

<script src="js/app.js"></script>
</body>
</html>
