<?php

include 'navs/admin_navs.php';

?>
      <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div id="first">
          <center><h2>Edit Employee</h2></center>
        <div class="error">
        <?php

         //****************************************lOG IN PAGE*******************************************
         $EMPID = '';
         $lastname='';
         $firstname=  '';
         $middlename=  '';
         $Cnum=  '';
         $Address =  '';
         $Position=  '';
         $Status=  '';

            if (isset($_GET['edit'])) {
            $empid = $_GET['edit'];
            $sql = "SELECT * FROM employee WHERE Employee_ID=".$empid;
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $EMPID = $row['Employee_ID'];
            $lastname= $row['Lastname'];
            $firstname=  $row['Firstname'];
            $middlename=  $row['MiddleName'];
            $Cnum=  $row['Contact'];
            $Address =  $row['Address'];
            $Position=  $row['Position'];
            $Status=  $row['Status'];
            }


                if(isset($_POST['update'])){

                  $empid= $_POST['empid'];
                  $lname= $_POST['lname'];
                  $fname=  $_POST['fname'];
                  $mname=  $_POST['mname'];
                  $cnum=  $_POST['cnum'];
                  $address =  $_POST['address'];
                  $position=  implode($_POST['position']);
                  $status=  implode($_POST['status']);

                $sql = "UPDATE employee
                        SET Employee_ID='$empid', Lastname='$lname', Firstname='$fname', MiddleName='$mname', Contact='$cnum', Address='$address', Position='$position', Status='$status'
                        WHERE Employee_ID='$empid'";

                $result = mysqli_query($conn, $sql);


                      if (!$result) {
                        echo "Error: ".(mysqli_error($conn));
                      }
                      else {
                        echo "Employee Update";
                        $EMPID = '';
                        $lastname='';
                        $firstname=  '';
                        $middlename=  '';
                        $Cnum=  '';
                        $Address =  '';
                        $Position=  '';
                        $Status=  '';
                      }
                  }


         ?>
          </div>
          <div class="form-inline">
            Employee ID:<br>
            <input type="text" class="form-control"  name="empid" value="<?php echo $EMPID;?>" readonly><br><br>
          </div>
          <div class="form-inline">
            Lastname:<br>
            <input type="text" class="form-control"  name="lname" placeholder="Last Name" value="<?php echo $lastname;?>"><br>
            Firstname:<br>
            <input type="text" class="form-control"  name="fname" placeholder="First Name" value="<?php echo $firstname;?>"><br>
            Middle Name:<br>
            <input type="text" class="form-control"  name="mname" placeholder="Middle Name" value="<?php echo $middlename;?>"><br>
            Contact Number:<br>
            <input type="text" class="form-control"  name="cnum" placeholder="Contact Numbe" maxlength="11" value="<?php echo $Cnum;?>"><br><br>
          </div>
          <input type="text" class="form-control"  name="address" placeholder="Address" value="<?php echo $Address;?>"><br>
          <div class="form-inline">
            <select class="form-control" name="position[]">
                <option value="">Position</option>
                <option value="PWD Evaluator"<?php if($Position=='PWD Evaluator'){echo "selected";}?>>PWD Evaluator</option>
                <option value="Encoder"<?php if($Position=='Encoder'){echo "selected";}?>>Encoder</option>
                <option value="IT and Computer Information"<?php if($Position=='IT and Computer Information'){echo "selected";}?>>IT and Computer Information</option>
            </select>
            <select class="form-control" name="status[]">
                <option value="">Status</option>
                <option value="Active"<?php if($Status=='Active'){echo "selected";}?>>Active</option>
                <option value="Inactive"<?php if($Status=='Inactive'){echo "selected";}?>>Inactive</option>
            </select><br><br>
            <br><br>
            </div>
            <div>
            <br><button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
          </div>
          <center><h1>INACTIVE EMPLOYEE </h1></center>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Action</th>
                  </tr>
                  <?php
                  $sql = "SELECT * FROM employee_inactive";
                  $result = mysqli_query($conn,$sql);
                  if (mysqli_num_rows($result) > 0) {
                  while ($row=mysqli_fetch_array($result)) {
                    echo '<tr>
                          <td>'.$row["Employee_ID"].'</td>
                          <td>'.$row["Firstname"].' '.$row["Lastname"].' '.$row["MiddleName"].'</td>
                          <td>'.$row["Address"].'</td>
                          <td>'.$row["Position"].'</td>
                          <td>'.$row["Status"].'</td>
                          <td>
                            <a href="edit_emp.php?edit='.$row["Employee_ID"].'" class="btn btn-info">EDIT</a>
                          </td>
                          <td>
                            <a href="undo_emp.php?undo='.$row["Employee_ID"].'" class="btn btn-danger">Undo</a>
                          </td>
                          </tr>';
                  }
                }else {
                  echo "<center style='color:red;'>0 Results</center>";
                };

                   ?>
                 </tbody>
                 </table>
                 </div>
                 </div>
        </form>


</body>
</html>
