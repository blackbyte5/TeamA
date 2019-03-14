<?php

include 'navs/admin_navs.php';

?>
      <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div id="first">
          <center><h2>Undo Records Employee</h2></center>
        <div class="error">
        <?php

         //****************************************lOG IN PAGE*******************************************


            if (isset($_GET['undo'])) {
            $empid = $_GET['undo'];
            $sql = "SELECT * FROM employee_inactive WHERE Employee_ID=".$empid;
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


                if(isset($_POST['undo'])){

                  $empid= $_POST['empid'];
                  $lname= $_POST['lname'];
                  $fname=  $_POST['fname'];
                  $mname=  $_POST['mname'];
                  $cnum=  $_POST['cnum'];
                  $address =  $_POST['address'];
                  $position=  implode($_POST['position']);
                  $status=  implode($_POST['status']);


                  $sql = "INSERT INTO employee (Employee_ID, Lastname, Firstname, MiddleName, Contact, Address, Position, Status)
                          VALUES ('$empid', '$lname', '$fname', '$mname','$cnum', '$address', '$position', '$status')";
                  $password=md5($empid);
                  $sql1 = "INSERT INTO user_staff (user_staff_id, Lastname, Firstname, Middle_Name, Username, Password)
                          VALUES ('$empid', '$lname', '$fname', '$mname', '$lname', '$password')";

                  $sqli = "DELETE FROM employee_inactive
                          WHERE Employee_ID=".$empid;


                  $result = mysqli_query($conn, $sql);
                  $result1 = mysqli_query($conn, $sql1);
                  $result2 = mysqli_query($conn, $sqli);

                    if (!$result && !$result1 && !$result2) {
                      echo "Error: "(mysqli_error($conn));
                    }
                    else {
                        echo "Employee Undo";
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
            <br><button type="submit" name="undo" class="btn btn-primary">Undo</button>
            </div>
          </div>
                   ?>
                 </tbody>
                 </table>
                 </div>
                 </div>
        </form>


</body>
</html>
