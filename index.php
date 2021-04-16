<?php
  session_start();
  if ( isset($_POST['reset']) ) {
    $_SESSION['attendance'] = Array();
    header("Location: index.php");
    return;
  }
  if ( isset($_POST['name'])) {
    if ( !isset ($_SESSION['attendance']) ) $_SESSION['attendance'] = Array();
    $_SESSION['attendance'] [] = array($_POST['name'], $_POST['matric']);
    header("Location: index.php");
    return;
  }
?>
<html>
  <head>
    <title>Attendance Form</title>
  </head>
  <body>
    <h1>Attendance Form</h1>
    <h3>Insert your student details here:</h3>
    <form name="myForm" method="post" action="index.php">
      <p> Name: <input type="text" name="name" size="40"/></p>
      <p> Matric Number: <input type="number" name="matric" size="15"/></p>
      <p>
        <input type="submit" value="Check-In"/>
        <input type="reset" onClick="return confirm('All input will be cleared.
        Are you sure want to reset?')" name="reset" value="Reset"/>
        <a href="attendancelist.php" target="_blank">Open Attendance List</a>
      </p>
    </form>
    <div id="currentattendancelist">
        <img src="img/load.gif" alt="Loading..."style="width:30px;
        height:30px;"/> Loading... Please wait...
    </div>
    <script type="text/javascript" src="jquery.min.js"> </script>
    <script type="text/javascript">
      function updateAttendance() {
        window.console && console.log('Requesting JSON');
        $.getJSON('attendancelist.php', function(rowz){
          window.console && console.log('JSON Received');
          window.console && console.log(rowz);
          $('#currentattendancelist').empty();
          for (var i = 0; i < rowz.length; i++) {
            arow = rowz[i];
            $('#currentattendancelist').append('<p>'+arow[0] +
            '<br/>&nbsp;&nbsp;'+arow[1]+"</p>\n");
          }
          setTimeout('updateAttendance()', 4000);
        });
      }
      // Make sure JSON requests are not cached
      $(document).ready(function() {
        $.ajaxSetup({ cache: false });
        updateAttendance();
      });
    </script>
  </body>
</html>
