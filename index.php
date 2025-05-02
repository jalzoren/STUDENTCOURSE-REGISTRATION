<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['tempStudent'] = [
        'fullName' => $_POST['fullName'] ?? '',
        'emailAddress' => $_POST['emailAddress'] ?? '',
        'studentNumber' => $_POST['studentNumber'] ?? '',
        'yearSection' => $_POST['yearSection'] ?? ''
    ];

    header("Location: ./forms/student.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PLP STUDENT COURSE REGISTRATION SYSTEM</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="./images/logoplp.png">

  </head>

  <body>
    <div class="image">
      <img src="./images/logoplp.png" alt="PLP Logo" />
    </div>
    <div class="container">
      <form method="POST" action="" id="studentReg">
        <h2>Student Course Registration</h2>
        <hr />

        <label for="fullName">Full Name:</label>
        <input
          type="text"
          id="fullName"
          name="fullName"
          placeholder="Enter Full Name : (Surname, Firstname, Middle I.)"
        />

        <label for="emailAddress">Email Address:</label>
        <input
          type="email"
          id="emailAddress"
          name="emailAddress"
          placeholder="Enter Email Address:"
        />

        <label for="studentNumber">Student Number:</label>
        <input
          type="number"
          id="studentNumber"
          name="studentNumber"
          placeholder="Enter Student Number :"
        />

        <label for="yearSection">Year & Section:</label>
        <input
          type="text"
          id="yearSection"
          name="yearSection"
          placeholder="Enter Year and Section :"
        />
        
        <button type="button" class="register" id="register" onclick="validateForm()">Register</button>
        <a class="view-summary" href="./forms/summary.php">View Summary</a>
      </form>
    </div>
    <div id="emptyFieldPopup" class="popup">
  <div class="popup-content">
    <h3>Please fill out all fields!</h3>
    <input type="button" value="OK" onclick="closepopup()" class="popup-btn" />
  </div>
</div>


      <script>
  function validateForm() {
    const fullName = document.getElementById("fullName").value.trim();
    const email = document.getElementById("emailAddress").value.trim();
    const studentNumber = document.getElementById("studentNumber").value.trim();
    const yearSection = document.getElementById("yearSection").value.trim();

    if (!fullName || !email || !studentNumber || !yearSection) {
      document.getElementById("emptyFieldPopup").classList.add("show");
      return false;
    }

    document.getElementById("studentReg").submit();
  }

  function closepopup() {
    document.getElementById("emptyFieldPopup").classList.remove("show");
  }
</script>


  </body>
</html>
