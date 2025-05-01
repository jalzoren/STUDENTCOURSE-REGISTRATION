<?php
session_start();

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

if (!isset($_SESSION['tempStudent'])) {
    header("Location: ../index.php");
    exit();
}

$confirmationCourses = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['courses'])) {
    if (count($_POST['courses']) === 3) {
        $studentData = $_SESSION['tempStudent'];
        
        $studentData['selectedCourses'] = $_POST['courses'];

        if (!isset($_SESSION['students'])) {
            $_SESSION['students'] = [];
        }
        $_SESSION['students'][] = $studentData;

        unset($_SESSION['tempStudent']);

        header("Location: ./summary.php");
        exit();
    } else {
        echo "<script>
            window.onload = function() {
                document.getElementById('coursePopup').style.display = 'flex';
            };
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PLP STUDENT COURSE REGISTRATION SYSTEM</title>
    <link rel="stylesheet" href="../css/studentstyle.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../images/logoplp.png">

  </head>

  <body>
    <div class="image">
      <img src="../images/logoplp.png" alt="PLP Logo" />
    </div>
    <div class="container">
    
    <h2> <a href="../index.php"> <i class="bx bx-arrow-back"></i></a>Student Course Registration </h2>
    <hr />
    <h1>Hello, <span><?php echo htmlspecialchars($_SESSION['tempStudent']['fullName'] ?? 'Guest'); ?>!</span> </h1>

            <div class="student-info">
              <div class="info-left">
                <p>Email Address: <span><?php echo htmlspecialchars($_SESSION['tempStudent']['emailAddress'] ?? 'N/A'); ?></span></p>
                <p>Student Name: <span><?php echo htmlspecialchars($_SESSION['tempStudent']['fullName'] ?? 'N/A'); ?></span></p>
              </div>
              <div class="info-right">
                <p>Student Number: <span><?php echo htmlspecialchars($_SESSION['tempStudent']['studentNumber'] ?? 'N/A'); ?></span></p>
                <p>Student Year and Section: <span><?php echo htmlspecialchars($_SESSION['tempStudent']['yearSection'] ?? 'N/A'); ?></span></p>
              </div>
        </div>

        <div class="register-courses">
          <hr />
          <h3>Register Courses</h3>

          <form method="POST" action="student.php">
          <table class="course-table">
              <tr>
                <?php
                $count = 0;
                foreach ($coursesList as $code => $name):
                  if ($count % 2 == 0) echo "<td>";
                ?>
                  <div class="course-option">
                    <input type="checkbox" id="<?= $code ?>" name="courses[]" value="<?= $code ?>" />
                    <label for="<?= $code ?>"><?= $code ?></label>
                  </div>
                <?php
                  if ($count % 2 == 1) echo "</td>";
                  $count++;
                endforeach;
                ?>
              </tr>
            </table>

            <button
                type="button"
                class="enroll-courses"
                id="enroll-courses"
                onclick="validateCourseSelection()"
              >
                Enroll Courses
              </button>

          </form>
        </div>
      </div>

        <div id="coursePopup" class="popup" style="display:none;">
            <div class="popup-content">
                <h3>Please select exactly 3 courses before proceeding.</h3>
                <button onclick="closeCoursePopup()">OK</button>
            </div>
        </div>

        <div id="confirmationPopup" class="popup" style="display:none;">
            <div class="popup-content">
                <h3>You have successfully selected the following courses:</h3>
                <ul id="courseList">
                  <?php
                    if (isset($_POST['courses']) && !empty($_POST['courses'])) {
                      foreach ($_POST['courses'] as $courseCode) {
                          if (isset($coursesList[$courseCode])) {
                            echo "<li>" . htmlspecialchars($courseCode) . " - " . htmlspecialchars($coursesList[$courseCode]) . "</li>";
                          } else {
                            echo "<li>Unknown Course ($courseCode)</li>";
                          }
                        }
                      }
                  ?>


                </ul>
                <button onclick="closeConfirmationPopup()">OK</button>
            </div>
        </div>




        <script>
    function closeCoursePopup() {
      document.getElementById('coursePopup').style.display = 'none';
    }

    function closeConfirmationPopup() {
      document.getElementById('confirmationPopup').style.display = 'none';
      document.forms[0].submit();
    }

    function validateCourseSelection() {
      const selectedCourses = document.querySelectorAll('input[type="checkbox"][name="courses[]"]:checked');

      if (selectedCourses.length === 3) {
        let courseListHTML = '';
        selectedCourses.forEach(course => {
          const courseCode = course.value;
          const courseName = <?php echo json_encode($coursesList); ?>[courseCode]; 

          courseListHTML += `<li>${courseCode} - ${courseName}</li>`;
        });
        document.getElementById('courseList').innerHTML = courseListHTML;
        document.getElementById("confirmationPopup").style.display = "flex";
      } else {
        document.getElementById("coursePopup").style.display = "flex";
      }
    }
  </script>

  </body>
</html>
