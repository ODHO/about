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
<?php include_once("includes/head.php") ?>
<title>About US</title>
<body>
  <?php include_once("includes/header.php") ?>

    <div class="aboutusbanner">
      <div class="container">
        <div class="services-section-heading">
          <h1>about <span>us</span></h1>
        </div>
        <img src="./assets/images/Group 20.png" alt="" class="lines-dot-left">
        <div class="text-center">
          Who We Are
        </div>
        <img src="./assets/images/Group 20.png" alt="" class="lines-dot-right">
        <div class="bannerimage">
          <img src="./assets/images/aboutusbanner.png" alt="image">
        </div>
        <div class="parasection">
          <p>At the heart of our identity lies a relentless commitment to surpassing the ordinary. We are not content with the bare minimum; instead, we relentlessly pursue perfection. Your satisfaction is not just a goal for us; it's our guiding principle. Every endeavor is a testament to our unwavering dedication to meeting and exceeding your expectations. We immerse ourselves in the digital realm, embodying the spirit of a born-digital company. Understanding the unique and evolving needs of our clients is ingrained in our DNA, and we tirelessly strive to fulfill those needs to the fullest extent.</p>
          <p>Digital innovation courses through our veins, defining our essence as a company that was born in the digital era. We don't just work hard; we bleed digital, symbolizing our deep-rooted connection to the dynamic landscape of the online world. Our pride stems from the exceptional quality of our work, and witnessing your business thrive is the ultimate testament to our boundless creativity. We approach each project as an opportunity to elevate our craft, pushing the boundaries of what is possible to unlock new levels of ingenuity and originality.</p>
          <p>Our dedication to excellence goes beyond mere rhetoric; it is a driving force that fuels our passion for what we do. We take immense pride in our craft, viewing each client's success as a reflection of our unwavering commitment to delivering unparalleled results. Your business flourishing isn't just a goal; it propels us to new heights of creativity, inspiring us to continually refine and redefine the standards of excellence in our industry. We are not just a service provider; we are your dedicated partner in achieving and surpassing your digital aspirations.</p>
        </div>
      </div>
    </div>
    <div class="aboutbox">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="boxes">
              <img src="./assets/images/boxpic.png" alt="image">
              <div class="boxestext">

                <h3>What <span> We </span> Do?</h3>
                <p>Our dynamic professional team of talented designers, developers, programmers and marketing professionals to drive your best business forward and take you to where you need to be.</p>
              </div>
              </div>
          </div>
          <div class="col-lg-4">
            <div class="boxes">
              <img src="./assets/images/boxpic.png" alt="image">
              <div class="boxestext">

                <h3>Why <span> Choose </span> Us?</h3>
                <p>
                  Understanding the complete needs of our clients to the fullest interpreting them in a digital language and achieving a complete satisfaction is what we were created to do.
                </p>
              </div>
              </div>
          </div>
          <div class="col-lg-4">
            <div class="boxes">
              <img src="./assets/images/boxpic.png" alt="image">
              <div class="boxestext">

                <h3>Who <span>We </span> Help?</h3>
                <p>
                  We instigate sustainable and measurable processes to help seize today’s digital marketplace, to help grow your business ROI.
                </p>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="scheduleSec">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <h1>What’s <span>next</span>?</h1>
            <p>Collaboration begins with a conversation. Whether you’re interested in discussing a new project or simply wish to find out more about our services and what we can do for you, we are here to help. Let’s get the conversation going.</p>
          </div>
          
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
        </div>
      </div>
    </div>
    
    
        
    <?php include_once("includes/footer.php") ?>

</body>
</html>
