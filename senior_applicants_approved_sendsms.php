<?php include 'navs/staff_navs.php'; ?>

<div>
  <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><center>Approved Senior Citizen Send SMS</center></h4>
        </div>
          <input type="hidden" name="username" value="renald.duat@gmail.com" class="form-control">
          <input type="hidden" name="hash" value="3e4ba35324538113b8347cb17bb7a1f13b6756c22b9d722a4fc86019f44968f8" class="form-control"><br>
           <input type="hidden" name="sender" value="ISERVE"class="form-control">
           <div class="error">
          <?php

          if (isset($_GET['sendsms'])) {
            $id = $_GET['sendsms'];


            $sql = "SELECT * FROM approved_applications WHERE ControlNumber=".$id;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name=$row['Firstname'].' '.$row['Lastname'];
            $contact=$row['ContactNumber'];

          }

          //----------------------------------------------------------------send sms------------------

                if(isset($_POST['send'])){


                	// Authorisation details.
                	$username = $_POST['username'];
                  //"renald.duat@gmail.com";
                	$hash = $_POST['hash'];
                  //"3133f3adc658d403db4ea6d6bf21278d9d59b879fc6b9b95f72be56ad559a421";

                	// Config variables. Consult http://api.txtlocal.com/docs for more info.
                	$test = "0";

                	// Data for text message. This is the text message data.
                	$sender = $_POST['sender'];
                  //"ISERVE"; // This is who the message appears to be from.
                	$numbers = $_POST['number']; // A single number or a comma-seperated list of numbers
                	$message = $_POST['message'];
                	// 612 chars or less
                	// A single number or a comma-seperated list of numbers
                  if (empty($numbers) || empty($message)) {
                    echo "Write a Message<br>";
                  }else{
                	$message = urlencode($message);
                	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                	$ch = curl_init('http://api.txtlocal.com/send/?');
                	curl_setopt($ch, CURLOPT_POST, true);
                	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                	$result = curl_exec($ch); // This is the result from the API
                  if ($result) {
                    echo "Message Sent..<br><br>";
                  }else {
                    echo "Message not Sent..<br>Check your network<br>";
                  }
                  curl_close($ch);
                  }
                }

          ?>
        </div>
        <div class="modal-body">
          Mobile Number:
          <input type="text" name="number" class="form-control" value="<?php echo $contact;?>" readonly>
          Message:
          <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo 'Hi! '.$name;?></textarea><br>
        </div>
        <div class="modal-footer">
          <button type="submit" name="send" class="btn btn-primary">Send</button>
        </div></center>
  </div>



</form>


  <script>
  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("customers");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  }
  function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("customers");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  }
  </script>
  </div>
</div>
</body>
</html>
