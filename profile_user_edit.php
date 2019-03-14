
<?php include 'navs/user_navs.php'; ?>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <div class="bg-text">
    <div class="form-inline">
      <center>
        <img src="others/dsws.png" height="85" width="85">
        <h2>INFORMATION</h2>
      </center>
    <div>
      <div class="error">
      <?php
        if(isset($_GET['edit'])){
          $id = $_GET['edit'];

          $sql = "SELECT * FROM user_client WHERE user_id=".$id;
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $id = $row['user_id'];
          $lname = $row['Lastname'];
          $fname = $row['Firstname'];
          $mname = $row['MiddleName'];
          $bday = $row['Birthday'];
          $address = $row['Address'];
          $Gender = $row['Gender'];
          $email = $row['Email'];
          $username = $row['Username'];

          if(isset($_POST['update'])){

            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $bday = $_POST['bday'];
            $address = $_POST['address'];
            $Gender = $_POST['Gender'];
            $email = $_POST['email'];
            $username = $_POST['username'];


              $sql = "UPDATE user_client SET Lastname='$lname', Firstname='$fname', MiddleName='$mname', Birthday='$bday', Address='$address', Gender='$Gender', Email='$email', Username='$username'
                      WHERE user_id=".$id;
              $result = mysqli_query($conn, $sql);

              if (!$result) {
                echo "No Action";
              }else {
                echo "Successfuly Update";

              }
            }
        }



       ?>
     </div>

      <br>
      <label for="sel1">
      <input type="text" name="lname" class="form-control" placeholder="Enter Lastname" value="<?php echo $lname;?>">
      </label>
      <label for="sel1">
      <input type="text" name="fname" class="form-control" placeholder="Enter Firstname" value="<?php echo $fname;?>">
      </label>
      <label for="sel1">
      <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" value="<?php echo $mname;?>">
      </label>
    </div>
  </div>
    <div class="form-inline">
    <label for="sel1">
      <div>
        <label for="sel1">
            <input type="date" name="bday" class="form-control" value="<?php echo $bday;?>">
        </label>
        <label for="sel1">
            <input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="<?php echo $address;?>">
        <select class="form-control" name="Gender" value="<?php echo $Gender;?>">
          <option value="Male" <?php if($row['Gender'] == 'Male'){ echo 'selected';}?>>Male</option>
          <option value="Female" <?php if($row['Gender'] == 'Female'){ echo 'selected';}?>>Female</option>
        </select>
        </label>
    </div>
    <div>
      <label for="sel1">
      <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email;?>">
      </label>
    </div>
    <div>
      <label for="sel1">
      <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $username;?>">
      </label>
    </div>
    <div class="form-inline">
      <br><br><br><button type="submit" name="update" class="btn btn-primary">Update</button>
    </div>
  </div>
  </div>
  </form>
