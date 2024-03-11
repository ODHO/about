<?php
if(isset($_POST['submitCV'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cv = $_FILES['cv']['tmp_name']; // Get temporary file path of uploaded CV
    $message = $_POST['message'];
    
    // Email details
    $to = "maxwell.harper2027@gmail.com";
    $subject = "New CV Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email\r\n";

    // File attachment
    $attachment = chunk_split(base64_encode(file_get_contents($cv)));
    $filename = $_FILES['cv']['name'];
    $filetype = $_FILES['cv']['type'];
    $boundary = md5(date('r', time()));

    // Headers for attachment
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

    // Message body
    $body = "--" . $boundary . "\r\n";
    $body .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // Attachment
    $body .= "--" . $boundary . "\r\n";
    $body .= "Content-Type: $filetype; name=\"" . $filename . "\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment\r\n\r\n";
    $body .= $attachment . "\r\n";
    $body .= "--" . $boundary . "--";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Please try again later.";
        // You can add more detailed error handling here, like logging the error
        error_log("Failed to send email: $email");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<title>About US</title>
<body>

   
   <div class="col-lg-3">
          <a type="button" class="btn btn-primary button-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Start a project</a>

          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button> -->
          
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload CV</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="formarea">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
        <input type="file" class="form-control" name="cv" placeholder="CV" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="message" rows="3" placeholder="Message"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" name="submitCV" value="Submit">
    </form>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>
          </div>
        

</body>
</html>
