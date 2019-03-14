
<!-- Multistep Form -->
  <form id="regForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
  <div id="first">
    <center>
    <img src="others/dsws.png" height="85" width="85">
    <h2 class="title">PWD Requirements</h2>
    <div class="error">
      <?php
      $Pwd_Num = '';
      $lname = '';
      $fname = '';
      $mname = '';
      $Civil_Status = '';
      $Gender = '';
      $Cnumber1= '';
      $Cnumber= '';
      $Contactnumber = '';
      $age = '';
      $bday = '';
      $bplace = '';
      $address = '';
      $datefill = '';
      $Com_Reg = '';
      $Pwd_Num = '';
      $Type_disability = '';
      $Inbo_conge = '';
      $If_ill = '';
      $yr_cause = '';
      $HEA = '';
      $HEA1= '';
      $hea='';
      $LIVING = '';
      $LIVING1 = '';
      $occupation = '';
      $occupation1 = '';
      $Occupation = '';
      $SOURCE = '';
      $SOURCE1 = '';
      $MONTHLY = '';
      $SKILLS= '';
      $PROBorNEEDS_Economics = '';
      $PROBorNEEDS_Economics1 = '';
      $PROBorNEEDS_Social = '';
      $PROBorNEEDS_Social1 = '';
      $PROBorNEEDS_Health = '';
      $PROBorNEEDS_Health1 = '';
      $PROBorNEEDS_Housing = '';
      $PROBorNEEDS_Housing1 = '';
      $Comm_Serv = '';


        if (isset($_POST['submit'])) {
          date_default_timezone_set('Singapore');
          $userid = $_POST['userid'];
          $ctrl_num = $_POST['ctrl_num'];
          $Pwd_Num = trim($_POST['Pwd_Num']);
          $lname = trim($_POST['lname']);
          $fname = trim($_POST['fname']);
          $mname = trim($_POST['mname']);
          $Civil_Status = trim($_POST['Civil_Status']);
          $Gender = trim($_POST['Gender']);

          $Cnumber1= $_POST['Cnumber1'];
          $Cnumber= trim($_POST['Cnumber']);
          $Contactnumber = $Cnumber1.$Cnumber;

          $age = trim($_POST['age']);
          $bday = trim($_POST['bday']);
          $bplace = trim($_POST['bplace']);
          $address = trim($_POST['address']);
          $datefill = trim($_POST['datefill']);

          $Com_Reg = trim($_POST['Com_Reg']);
          $Pwd_Num = trim($_POST['Pwd_Num']);
          $Type_disability = implode($_POST['Type_disability']);
          $Inbo_conge = trim($_POST['Inbo_conge']);
          $If_ill = trim($_POST['If_ill']);
          $yr_cause = trim($_POST['yr_cause']);

          $HEA = implode($_POST['HEA']);
          $HEA1= trim($_POST['HEA1']);
          $hea=$HEA.$HEA1;

          if(isset($_POST['LIVING']))
          $LIVING = implode(',',$_POST['LIVING']);
          $LIVING1 = trim(','.$_POST['LIVING1']);
          $Living=$LIVING.$LIVING1;

          $occupation = implode($_POST['occupation']);
          $occupation1 = trim($_POST['occupation1']);
          $Occupation = $occupation.$occupation1;

          $SOURCE = implode($_POST['SOURCE']);
          $SOURCE1 = trim($_POST['SOURCE1']);
          $Source = $SOURCE.$SOURCE1;

          $MONTHLY = implode($_POST['MONTHLY']);
          $SKILLS= implode($_POST['SKILLS']);


          if(isset($_POST['PROBorNEEDS_Economics']))
          $PROBorNEEDS_Economics = implode(',',$_POST['PROBorNEEDS_Economics']);

          $PROBorNEEDS_Economics1 = trim(','.$_POST['PROBorNEEDS_Economics1']);
          $PROBorNEEDS_Econ = $PROBorNEEDS_Economics.$PROBorNEEDS_Economics1;

          if(isset($_POST['PROBorNEEDS_Social']))
          $PROBorNEEDS_Social = implode(',',$_POST['PROBorNEEDS_Social']);

          $PROBorNEEDS_Social1 = trim(','.$_POST['PROBorNEEDS_Social1']);
          $PROBorNEEDS_Soc = $PROBorNEEDS_Social.$PROBorNEEDS_Social1;

          if(isset($_POST['PROBorNEEDS_Health']))
          $PROBorNEEDS_Health = implode(',',$_POST['PROBorNEEDS_Health']);

          $PROBorNEEDS_Health1 = trim(','.$_POST['PROBorNEEDS_Health1']);
          $PROBorNEEDS_H = $PROBorNEEDS_Health.$PROBorNEEDS_Health1;


          if(isset($_POST['PROBorNEEDS_Housing']))
          $PROBorNEEDS_Housing = implode(',',$_POST['PROBorNEEDS_Housing']);

          $PROBorNEEDS_Housing1 = trim(','.$_POST['PROBorNEEDS_Housing1']);
          $PROBorNEEDS_House = $PROBorNEEDS_Housing.$PROBorNEEDS_Housing1;

          $Comm_Serv = implode($_POST['Comm_Serv']);


        if (empty($lname) || empty($fname) || empty($Civil_Status) || empty($Gender)
            || empty($Cnumber) || empty($age) || empty($bplace) || empty($address) || empty($Pwd_Num) || empty($_FILES['pdf_file']['name'])) {

          echo (mysqli_error($conn))."Fill-up all required fields in first page <a style='color:black;'>( * )</a> <br>or<br> Attach your Requirements..";
        }

        elseif (empty($Type_disability) || empty($age)|| empty($HEA) || empty($occupation) || empty($SOURCE) || empty($MONTHLY)|| empty($SKILLS) || empty($Comm_Serv)) {

          echo (mysqli_error($conn))."Fill-up all required fields in second page <a style='color:black;'>( * )</a>";

        }


        else{

          $targetDir = 'pdf/';
          $Requirements=basename($_FILES['pdf_file']['name']);
          $targetFilePath = $targetDir . $Requirements;
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
          $allowTypes = array('pdf');

          if(in_array($fileType, $allowTypes))
          {
            if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetFilePath))
            {

              $sql = "INSERT INTO pwd_applications (ControlNumber, user_id, Lastname, Firstname, MiddleName, CivilStatus, Gender, ContactNumber, Age, Birthday, BirthPlace, Address, DateFillUp)
                      VALUES ('$ctrl_num', '$userid','$lname', '$fname', '$mname', '$Civil_Status', '$Gender', '$Contactnumber', '$age', '$bday', '$bplace', '$address','$datefill')";

              $sql1 = "INSERT INTO pwd_application_detail (ControlNumber, user_id, PWD_Number, ComelicReg, TypeOfDisability, Inborn_Conginetal, State_Illness, YearAccident, HighestEducationalAttainment,
                Living_Residing, Occupation, SourceIncome, MonthlyIncome, Areas_Specialization, PROBorNEEDS_Economics, PROBorNEEDS_Social, PROBorNEEDS_Health, PROBorNEEDS_Housing, Comm_Serv)
                 VALUES ('$ctrl_num', '$userid', '$Pwd_Num', '$Com_Reg', '$Type_disability', '$Inbo_conge', '$If_ill', '$yr_cause', '$hea', '$Living', '$Occupation', '$Source', '$MONTHLY', '$SKILLS', '$PROBorNEEDS_Econ',
                    '$PROBorNEEDS_Soc', '$PROBorNEEDS_H', '$PROBorNEEDS_House', '$Comm_Serv')";

              $sql2 = "INSERT INTO pwd_upload_requirements (ControlNumber,user_id, Requirements, Lastname, Firstname, Middle_Name, Gender, Age)
                        VALUES ('$ctrl_num', '$userid', '$Requirements', '$lname', '$fname', '$mname', '$Gender', '$age')";

              $result = mysqli_query($conn, $sql);
              $result1 = mysqli_query($conn, $sql1);
              $result2 = mysqli_query($conn, $sql2);



                        if (!$result && !$result1 && !$result2) {
                          echo (mysqli_error($conn));
                        }else {
                          echo (mysqli_error($conn))."Data Submit Successfully";
                          $Pwd_Num = '';
                          $lname = '';
                          $fname = '';
                          $mname = '';
                          $Civil_Status = '';
                          $Gender = '';
                          $Cnumber1= '';
                          $Cnumber= '';
                          $Contactnumber = '';
                          $age = '';
                          $bday = '';
                          $bplace = '';
                          $address = '';
                          $datefill = '';
                          $Com_Reg = '';
                          $Pwd_Num = '';
                          $Type_disability = '';
                          $Inbo_conge = '';
                          $If_ill = '';
                          $yr_cause = '';
                          $HEA = '';
                          $HEA1= '';
                          $hea='';
                          $LIVING = '';
                          $LIVING1 = '';
                          $occupation = '';
                          $occupation1 = '';
                          $Occupation = '';
                          $SOURCE = '';
                          $SOURCE1 = '';
                          $MONTHLY = '';
                          $SKILLS= '';
                          $PROBorNEEDS_Economics = '';
                          $PROBorNEEDS_Economics1 = '';
                          $PROBorNEEDS_Social = '';
                          $PROBorNEEDS_Social1 = '';
                          $PROBorNEEDS_Health = '';
                          $PROBorNEEDS_Health1 = '';
                          $PROBorNEEDS_Housing = '';
                          $PROBorNEEDS_Housing1 = '';
                          $Comm_Serv = '';
                        }
                      }
            }else{
                  echo (mysqli_error($conn))."Requirements Submit Error!!";
                }

          }
        }


        if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row['user_id'];
        }

      ?>
    </div>
    </center><br><br>
    <div class="progress">
      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
      aria-valuemin="0" aria-valuemax="100" style="width:20%">
      <p style="color:black;">Requirements</p>
      </div>
    </div><br><br>
    <ol>
      <?php
      $sql = "SELECT * FROM add_pwd_requirements ORDER BY id ASC";
      $sql1 = "SELECT * FROM add_steps";
      $result = mysqli_query($conn, $sql);
      $result1 = mysqli_query($conn, $sql1);
      $rows = mysqli_fetch_assoc($result1);

      $step = $rows['Steps'];
      echo '<li>View this <a href="steps/'.$step.'" target="_blank">'.$step.'</a> guide and format in uploaded requirements (NOTE: Not following instructions the more Disapprove registration)</li><br>';

      if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)){
      $req = $row['requirements'];
      echo '<li>'.$req.'</li><br>';
    }
  }else {
    echo (mysqli_error($conn)).'<center style="color:red;">O Result</center>';
  }
       ?>
    </ol>
    <br><br>

    <input class="btn btn-primary" name="next" type="button" value="Next">
  </div>


<div class="others">
  <center>
  <img src="others/dsws.png" height="85" width="85">
<h2 class="title">Registration</h2>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:40%">
  <p style="color:black;">Step 1</p>
  </div>
</div>
</center><br><br>
<div class="form-inline">
<strong>Control Number:<a style="color:red;"> (Remember this control number)</a></strong><br><br>
  <input type="hidden" class="form-control"  name="userid" value="<?php echo $id;?>" readonly>
  <input type="hidden" class="form-control"  name="datefill" value="<?php date_default_timezone_set('Singapore'); echo date('Y-m-d h:i:s')?>" readonly>
  <input type="text" class="form-control" style="text-align:center; " name="ctrl_num" value="<?php echo date('ym').(rand(0,10000)).date('d');?>" readonly><br><br>
  <a style="color:red">*</a><input type="text" class="form-control"  name="Pwd_Num"  pattern="^[0-9-]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"placeholder="PWD Number" value="<?php echo $Pwd_Num;?>"><br><br>
  <a style="color:red">*</a><input type="text" class="form-control"  name="lname" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"placeholder="Last Name" value="<?php echo $lname;?>">
  <a style="color:red">*</a><input type="text" class="form-control"  name="fname" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"placeholder="First Name" value="<?php echo $fname;?>">
  <input type="text" class="form-control"  name="mname" placeholder="Middle Name" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $mname;?>">
  </div>
  <div class="form-inline"><br>
    <a style="color:red">*</a>
      <select class="form-control" name="Civil_Status" value="<?php echo $Civil_Status;?>">
          <option value="" >Civil Status</option>
          <option value="Single" <?php if($Civil_Status=='Single'){echo "selected";}?>>Single</option>
          <option value="Married" <?php if($Civil_Status=='Married'){echo "selected";}?>>Married</option>
          <option value="Widowed" <?php if($Civil_Status=='Widowed'){echo "selected";}?>>Widowed</option>
          <option value="Separated" <?php if($Civil_Status=='Separated'){echo "selected";}?>>Separated</option>
      </select>
      <a style="color:red">*</a>
      <select class="form-control" name="Gender" value="<?php echo $Gender;?>">
          <option value="">Gender</option>
          <option value="Male"<?php if($Gender=='Male'){echo "selected";}?>>Male</option>
          <option value="Female"<?php if($Gender=='Female'){echo "selected";}?>>Female</option><br>
      </select>
  <a style="color:red">*</a>
  <select class="form-control" name="Cnumber1">
    <option value="+63">+63</option>
  </select>
  <input type="text" class="form-control"  name="Cnumber" maxlength="10" placeholder="Contact Number"  pattern="^[0-9]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $Cnumber;?>">
  <a style="color:red">*</a><input type="text" class="formage"  name="age" placeholder="Age" maxlength="3" pattern="^[0-9]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $age;?>"><br><br>
  </div>
  <div class="form-inline"><br>
  <strong>Birth Date: <br><br></strong><a style="color:red">*</a><br><input type="date" class="form-control"  name="bday" value="<?php echo $bday;?>"><br>
  </div>
  <br>
  <a style="color:red">*</a><input type="text" class="form-control"  name="bplace" placeholder="Birth Place" pattern="^[a-zA-Z0-9,. ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $bplace;?>"><br>
  <a style="color:red">*</a><input type="text" class="form-control"  name="address"  placeholder="Complete Address" pattern="^[a-zA-Z0-9,. ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $address;?>"><br>
  <input class="btn btn-danger" type="button" value="Previous">
  <input class="btn btn-primary" name="next" type="button" value="Next">
</div>

<div class="others">
    <center>
  <img src="others/dsws.png" height="85" width="85">
<h2 class="title">Registration</h2>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60"
  aria-valuemin="0" aria-valuemax="100" style="width:60%">
  <p style="color:black;">Step 2</p>
  </div>
</div>
</center><br><br>
<div class="form-inline"><br>
      <select class="form-control" name="Com_Reg">
          <option value="">Comelec Registered</option>
          <option value="Yes"<?php if($Com_Reg=='Yes'){echo "selected";}?>>Yes</option>
          <option value="No"<?php if($Com_Reg=='No'){echo "selected";}?>>No</option>
      </select>
  </div>
  <div class="form-inline"><br>
    <a style="color:red">*</a><br>
    <select class="form-control" name="Type_disability[]">
    <option value="">TYPE OF DISABILITY</option>
    <?php
    $sql = "SELECT * FROM add_type_of_disability";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    $tod = $row['TypeOfDisabilty'];
    if ($Type_disability==$tod) {
      $TOd='selected';
    }else {
      $TOd='';
    }

     echo '<option value="'.$tod.'" '.$TOd.'>'.$tod.'</option>';
   }
   ?>
 </select>
 </div><br>
<div class="form-inline">
  <b><strong>CAUSE OF DISABILITY</b></strong><br><br>
  <select class="form-control" name="Inbo_conge">
       <option value="">INBORN/CONGENITAL</option>
       <option value="Yes"<?php if($Inbo_conge=='Yes'){echo "selected";}?>>Yes</option>
       <option value="No"<?php if($Inbo_conge=='No'){echo "selected";}?>>No</option>
   </select>
 <input type="text" class="form-control"  size="30" name="If_ill"  placeholder="If ILLNESS please State Cause" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $If_ill;?>">
</div><br>
 <div class="form-inline">
  <input type="text" class="form-control"  size="30" name="yr_cause"  placeholder="If ACCIDENT please State Year"pattern="^[0-9]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)" value="<?php echo $yr_cause;?>">
 </div><br>
 <div class="form-inline"><a style="color:red">*</a><br>
       <select class="form-control" name="HEA[]">
           <option value="">HIGHEST EDUCATIONAL ATTAINMENT</option>
           <?php
           $sql = "SELECT * FROM add_highest_educ_attainment";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_array($result)){
           $EA = $row['EducationalAttainment'];
           if ($HEA==$EA) {
             $hea='selected';
           }else {
             $hea='';
           }

              echo '<option value="'.$EA.'" '.$hea.'> '.$EA.'</option>';
          }
          ?>
       </select>
       <input type="text" class="form-control"  name="HEA1"  placeholder="Others pls. specify" pattern="^[a-zA-Zpattern="^[a-zA-Z0-9,. ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)" ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if ($HEA==$EA){echo $EA;}else {echo $HEA1;}?>"><br>
</div><br>
    <strong>LIVING/RESIDING WITH (check all applicable):</strong><br><br>

         <?php
         $sql = "SELECT * FROM add_living_residing";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
         $LorR = $row['LivingResiding'];

         if(isset($_POST['LIVING']) && in_array($LorR, $_POST['LIVING'])){
           $LorRcheck= 'checked';
         }else {
           $LorRcheck= 'unchecked';
         }

          echo '<label><input type="checkbox" value="'.$LorR.'" name="LIVING[]" '.$LorRcheck.'> '.$LorR.'</label><br>';
        }
        ?>

       <div class="form-inline"><br>
       <input type="text" class="form-control"  name="LIVING1"  placeholder="Others pls. specify" pattern="^[a-zA-Zpattern="^[a-zA-Z0-9,. ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)" ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $LIVING1;?>"><br>
     </div><br>
  <div class="form-inline">
    <a style="color:red">*</a><br>
      <select class="form-control" name="occupation[]">
        <option value="">OCCUPATION</option>
        <?php
        $sel='';
        $sql = "SELECT * FROM add_occupation";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        $occ = $row['Occupation'];
        if ($occupation==$occ) {
          $OCC='selected';
        }else {
          $OCC='';
        }

         echo '<option value="'.$occ.'"'.$OCC.'> '.$occ.'</option>';
       }
       ?>
       </select>
       <input type="text" class="form-control"  name="occupation1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if ($occupation==$occ){echo $occ;}else {echo $occupation1;}?>"><br>
       </div><br>
       <div class="form-inline"><br>
       <a style="color:red">*</a><br>
       <select class="form-control" name="SOURCE[]">
         <option value="">SOURCE OF INCOME/SUPPORT/ASSISTANCE</option><?php
         $sql = "SELECT * FROM add_source_isa";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
         $source = $row['SourceIncomeSupportAssistance'];
         if ($SOURCE==$source) {
           $sourc='selected';
         }else {
           $sourc='';
         }

          echo '<option value="'.$source.'"'.$sourc.'> '.$source.'</option>';
        }
       ?>
       </select>
       <input type="text" class="form-control"  name="SOURCE1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if ($SOURCE == $source){echo $SOURCE;}else {echo $SOURCE1;}?>"><br>
       <br><br>
       <a style="color:red">*</a><br>
          <select class="form-control" name="MONTHLY[]" value="<?php echo $MONTHLY;?>">
            <option value="">MONTHLY INCOME/SUPPORT/ASSISTANCE</option>
            <?php
            $sel='';
            $sql = "SELECT * FROM add_monthly_isa";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $sisa = $row['MonthlyIncomeSupportAssistance'];
            if ($MONTHLY==$sisa) {
              $sis='selected';
            }else {
              $sis='';
            }

             echo '<option value="'.$sisa.'"'.$sis.'> '.$sisa.'</option>';
           }
           ?>
          </select>
          </div><br><br>
       <input class="btn btn-danger" type="button" value="Previous">
       <input class="btn btn-primary" name="next" type="button" value="Next">
</div>


<div class="others">
    <center>
      <img src="others/dsws.png" height="85" width="85">
      <h2 class="title">Registration</h2>
      <div class="progress">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80"
        aria-valuemin="0" aria-valuemax="100" style="width:80%">
        <p style="color:black;">Step 3</p>
        </div>
      </div>
    </center><br><br><br>
    <div class="form-inline">
    <a style="color:red">*</a><br>
       <select class="form-control" name="SKILLS[]" value="<?php echo $MONTHLY;?>">
         <option value="">Areas of Specialization/Skills</option>
         <?php
         $sel='';
         $sql = "SELECT * FROM add_areas_specialization_skills";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
         $ass = $row['SpecializationOrSkills'];
         if ($SKILLS==$ass) {
           $as='selected';
         }else {
           $as='';
         }

          echo '<option value="'.$ass.'"'.$as.'> '.$ass.'</option>';
        }
        ?>
       </select>
     </div><br><br>

   <strong>PROBLEM/NEEDS COMMONLY ENCOUNTERED (check all applicable):</strong><br><br>
      <b><Strong><a style="color:red">*</a>Economics:</b></strong><br><br>
      <label class="checkbox-inline">
        <?php
        $sql = "SELECT * FROM add_problem_economics";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        $econ = $row['Economics'];

        if(isset($_POST['PROBorNEEDS_Economics']) && in_array($econ, $_POST['PROBorNEEDS_Economics'])){
          $econcheck= 'checked';
        }else {
          $econcheck= 'unchecked';
        }


         echo '<label><input type="checkbox" value="'.$econ.'" name="PROBorNEEDS_Economics[]" '.$econcheck.'> '.$econ.'</label><br>';
       }
       ?>
      </label><br><br>
      <div class="form-inline">
      <input type="text" class="form-control"  name="PROBorNEEDS_Economics1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $PROBorNEEDS_Economics1;?>">
      </div><br>

      <b><Strong><a style="color:red">*</a>Social/Emotional:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_emotional_social";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $EmSoc = $row['EmotionalSocial'];

           if(isset($_POST['PROBorNEEDS_Social']) && in_array($EmSoc, $_POST['PROBorNEEDS_Social'])){
             $EmSoccheck= 'checked';
           }else {
             $EmSoccheck= 'unchecked';
           }

            echo '<label><input type="checkbox" value="'.$EmSoc.'" name="PROBorNEEDS_Social[]" '.$EmSoccheck.'> '.$EmSoc.'</label><br>';
          }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Social1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $PROBorNEEDS_Social1;?>"><br>
          </div><br>
     <b><Strong><a style="color:red">*</a>Health:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_health";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $health = $row['Health'];

           if(isset($_POST['PROBorNEEDS_Health']) && in_array($health, $_POST['PROBorNEEDS_Health'])){
             $healthcheck= 'checked';
           }else {
             $healthcheck= 'unchecked';
           }

            echo '<label><input type="checkbox" value="'.$health.'" name="PROBorNEEDS_Health[]" '.$healthcheck.'> '.$health.'</label><br>';
          }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Health1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $PROBorNEEDS_Health1;?>"><br><br>
       </div>
     <b><strong><a style="color:red">*</a>Housing:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_housing";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $house = $row['Housing'];

           if(isset($_POST['PROBorNEEDS_Housing']) && in_array($house, $_POST['PROBorNEEDS_Housing'])){
             $housecheck= 'checked';
           }else {
             $housecheck= 'unchecked';
           }


            echo '<label><input type="checkbox" value="'.$house.'" name="PROBorNEEDS_Housing[]" '.$housecheck.'> '.$house.'</label><br>';
          }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Housing1"  placeholder="Others pls. specify" pattern="^[a-zA-Z ]+$" oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $PROBorNEEDS_Housing1;?>"><br><br>

        <a style="color:red">*</a><br>
        <select class="form-control" name="Comm_Serv">
          <option value="">COMMUNITY SERVICE</option>
          <?php
          $sql = "SELECT * FROM add_community_serv";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
          $comserv = $row['CommunityServices'];

          if ($Comm_Serv==$comserv) {
            $comser='selected';
          }else {
            $comser='';
          }

           echo '<option value="'.$comserv.'"'.$comser.'> '.$comserv.'</option>';
         }
         ?>
          </select>
        </div><br><br>
         <input class="btn btn-danger" type="button" value="Previous">
         <input class="btn btn-primary" name="next" type="button" value="Next">
</div>

<div class="others">
  <center>
  <img src="others/dsws.png" height="85" width="85">
  <h2 class="title">Registration</h2>
  <div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100"
  aria-valuemin="0" aria-valuemax="100" style="width:100%">
  <p style="color:black;">Last</p>
  </div>
  </div>
  </center><br><br>
  <br><center><h1>Upload Your Requirements Here!!!!</h1></center><br>
  <h4><p style="color:red">*require</p>
  <input type="file" name="pdf_file" accept="application/pdf">
  </h4>
  <div id="errorBlock" class="help-block"><br></div>
  <input class="btn btn-danger" type="button" value="Previous">
  <input class="btn btn-success" type="submit" name="submit" value="Submit">
</div>



</form>
</body>
</html>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
<script>

$(document).ready(function() {
/*---------------------------------------------------------*/
$(".btn-primary").click(function() { // Function Runs On NEXT Button Click
$(this).parent().next().fadeIn('fast');
$(this).parent().css({
'display': 'none'
});
// Adding Class Active To Show Steps Forward;
$('.active').next().addClass('active');
});
$(".btn-danger").click(function() { // Function Runs On PREVIOUS Button Click
$(this).parent().prev().fadeIn('fast');
$(this).parent().css({
'display': 'none'
});
// Removing Class Active To Show Steps Backward;
$('.active:last').removeClass('active');
});
});

</script>
