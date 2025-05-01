<?php
session_start();

if (!isset($_SESSION['students']) || empty($_SESSION['students'])) {
    header("Location: ../index.php");
    exit();
}

$coursesList = [
  "CS101" => "Introduction to Computer Science",
  "IT103" => "Advanced Database Systems",
  "MATH201" => "Calculus I",
  "IT105" => "Networking",
  "ENG105" => "English Composition",
  "COMP106" => "Applications Development and Emerging Technologies",
  "HIST210" => "World History",
  "PE104" => "Team Games Sports",
  "BIO110" => "Biology Basics",
  "IT301" => "Web Programming"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLP STUDENT COURSE REGISTRATION SYSTEM</title>
  <link rel="stylesheet" href="../css/summarystyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" type="image/png" href="../images/logoplp.png">

</head>

<body>
  <div class="image">
    <img src="../images/logoplp.png" alt="PLP Logo" />
  </div>

  <div class="container">
    <h2><a href="../index.php"><i class='bx bx-home-alt-2'></i></a>Student Course Records</h2>
    <hr />

    <div class="scrollable-container">
      <?php foreach ($_SESSION['students'] as $index => $student): ?>
        <div class="student-card">
            <div class="student-info">
              <h3>Student #<?= $index + 1 ?></h3>
                <div class="info-left">
                  <p><strong>Full Name:</strong> <?= htmlspecialchars($student['fullName']) ?></p>
                  <p><strong>Email Address:</strong> <?= htmlspecialchars($student['emailAddress']) ?></p>
                </div>
              <div class="info-right">
                  <p><strong>Student Number:</strong> <?= htmlspecialchars($student['studentNumber']) ?></p>
                  <p><strong>Year and Section:</strong> <?= htmlspecialchars($student['yearSection']) ?></p>
              </div>
          
            
            </div>
          <div class="student-card">

            <h4>Selected Courses:</h4>
            <ul>
              <?php foreach ($student['selectedCourses'] as $courseCode): ?>
                <li><?= htmlspecialchars($coursesList[$courseCode] ?? $courseCode) ?></li>
              <?php endforeach; ?>
            </ul>

          </div>
        </div>
        <hr />
      <?php endforeach; ?>
    </div>
  </div>

  <script>

    
  </script>

</body>
</html>
