<?php
include 'navs/admin_navs.php';
?>


<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div id="first">
          <center><h2>Add Employee</h2></center>
        <div class="error">
        <?php
         //****************************************lOG IN PAGE*******************************************
                 $lname= '';
                 $fname= '';
                 $mname= '';
                 $cnum='';
                 $address = '';
                 $position= '';
                 $status= '';



                if(isset($_POST['addemp'])){

                  $empid= $_POST['empid'];
                  $lname= $_POST['lname'];
                  $fname=  $_POST['fname'];
                  $mname=  $_POST['mname'];
                  $cnum= $_POST['cnum'];
                  $address =  $_POST['address'];
                  $position=  implode($_POST['position']);
                  $status=  implode($_POST['status']);




                  if(empty($lname) || empty($fname) || empty($address) || empty($position) || empty($status)) {
                    echo "Empty Fields";
                  }
                  else {

                    $sql = "INSERT INTO employee (Employee_ID, Lastname, Firstname, MiddleName, Contact, Address, Position, Status)
                            VALUES ('$empid', '$lname', '$fname', '$mname','$cnum', '$address', '$position', '$status')";
                    $password=md5($empid);
                    $sql1 = "INSERT INTO user_staff (user_staff_id, Lastname, Firstname, Middle_Name, Username, Password)
                            VALUES ('$empid', '$lname', '$fname', '$mname', '$lname', '$password')";

                    $result = mysqli_query($conn, $sql);
                    $result1 = mysqli_query($conn, $sql1);

                      if (!$result && !$result1) {
                        echo "Error: "(mysqli_error($conn));
                      }
                      else {
                        echo "Employee Added";
                      }
                  }

                }
         ?>
          </div>
          <div class="form-inline">
            Employee ID:<br>
            <input type="text" class="form-control"  name="empid" value="<?php echo date('yd').(rand(100,1000)).date('m');?>" readonly><br><br>
          </div>
          <div class="form-inline">
            Lastname:<br>
            <input type="text" class="form-control"  name="lname" placeholder="Last Name" value="<?php echo $lname;?>"><br>
            Firstname:<br>
            <input type="text" class="form-control"  name="fname" placeholder="First Name" value="<?php echo $fname;?>"><br>
            Middle Name:<br>
            <input type="text" class="form-control"  name="mname" placeholder="Middle Name" value="<?php echo $mname;?>"><br>
            Contact Number:<br>
            <input type="text" class="form-control"  name="cnum" maxlength="11" placeholder="Contact Number" value="<?php echo $cnum;?>"><br><br>
          </div>
          <input type="text" class="form-control"  name="address" placeholder="Address" value="<?php echo $address;?>"><br>
          <div class="form-inline">
            <select class="form-control" name="position[]">
                <option value="">Position</option>
                <option value="PWD Evaluator">PWD Evaluator</option>
                <option value="Encoder">Encoder</option>
                <option value="IT and Computer Information">IT and Computer Information</option>
            </select>
            <select class="form-control" name="status[]">
                <option value="">Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select><br><br>
            <br><br>
            </div>
            <div>
            <br><button type="submit" name="addemp" class="btn btn-primary">+ Add</button>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Employee Number..">
                <thead>
                  <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Inactive</th>
                  </tr>
                  <?php
                  $sql = "SELECT * FROM employee";
                  $result = mysqli_query($conn,$sql);
                  if (mysqli_num_rows($result) > 0) {
                  while ($row=mysqli_fetch_array($result)) {
                    echo '<tr>
                          <td>'.$row["Employee_ID"].'</td>
                          <td>'.$row["Firstname"].' '.$row["Lastname"].' '.$row["MiddleName"].'</td>
                          <td>'.$row["Contact"].'</td>
                          <td>'.$row["Address"].'</td>
                          <td>'.$row["Position"].'</td>
                          <td>'.$row["Status"].'</td>
                          <td>
                            <a href="edit_emp.php?edit='.$row["Employee_ID"].'" class="btn btn-info">EDIT</a>
                          </td>
                          <td>
                            <a href="add_emp.php?inactive='.$row["Employee_ID"].'" class="btn btn-danger">INACTIVE</a>
                          </td>
                          </tr>';
                  }
                }else {
                  echo "0 Results";
                };

                if (isset($_GET['inactive'])) {
                  $empid = $_GET['inactive'];

                  $sql = "INSERT INTO employee_inactive
                          SELECT * FROM employee WHERE Employee_ID=".$empid;

                  $sql1 = "DELETE FROM employee
                            WHERE Employee_ID=".$empid;

                  $sql2 = "DELETE FROM user_staff
                            WHERE user_staff_id=".$empid;

                  $result = mysqli_query($conn,$sql);
                  $result1 = mysqli_query($conn,$sql1);
                  $result2 = mysqli_query($conn,$sql2);

                  if ($result && $result1 && $result2) {
                    echo "Success";
                  }else {
                    echo (mysqli_error($conn));
                  }
                }

                   ?>
                 </tbody>
                 </table>
                 </div>
                 </div>
        </form>


</body>
</html>
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
  td = tr[i].getElementsByTagName("td")[0];
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
