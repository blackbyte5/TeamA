<?php include 'navs/staff_navs.php'; ?>


<!-- Multistep Form -->
  <form id="regForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
  <div id="first">
    <center>
    <img src="others/dsws.png" height="85" width="85">
    <h2 class="title">Submitted Senior Citizen Registration</h2>
    <div class="error">
      <?php
      if (isset($_GET['details'])) {
      $id = $_GET['details'];

      $sql = "SELECT * FROM senior_application WHERE ControlNumber=".$id;

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $ctrl_num = $row['ControlNumber'];
      $lname = $row['Lastname'];
      $fname = $row['Firstname'];
      $mname = $row['MiddleName'];
      $Civil_Status = $row['CivilStatus'];
      $Gender = $row['Gender'];
      $Cnumber= $row['ContactNumber'];
      $age = $row['Age'];
      $bday = $row['Birthday'];
      $bplace = $row['BirthPlace'];
      $address = $row['Address'];

      $sql = "SELECT * FROM senior_application_detail WHERE ControlNumber=".$id;
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      $Com_Reg = $row['ComelicReg'];
      $HEAS = $row['HighestEducationalAttainment'];
      $living = explode(',',trim(strtolower($row['Living_Residing']."")));
      $occupation = $row['Occupation'];
      $SOURCE = $row['SourceIncome'];
      $MONTHLY = $row['MonthlyIncome'];
      $SKILLS= $row['Areas_Specialization'];
      $Economics = explode(',',trim(strtolower($row['PROBorNEEDS_Economics']."")));
      $Social = explode(',',trim(strtolower($row['PROBorNEEDS_Social']."")));
      $Health = explode(',',trim(strtolower($row['PROBorNEEDS_Health']."")));
      $Housing = explode(',',trim(strtolower($row['PROBorNEEDS_Housing']."")));
      $Comm_Serv = $row['Comm_Serv'];

      $sql = "SELECT * FROM senior_upload_requirements WHERE ControlNumber=".$id;
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $Requirements=$row['Requirements'];
    }
//------------------------------------------------Update-----------------------------------

  if (isset($_POST['update'])) {
    date_default_timezone_set('Singapore');
    $userid = $_POST['userid'];
    $ctrl_num = $_POST['ctrl_num'];
    $lname = trim($_POST['lname']);
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $Civil_Status = $_POST['Civil_Status'];
    $Gender = $_POST['Gender'];

    $Cnumber1= $_POST['Cnumber1'];
    $Cnumber= trim($_POST['Cnumber']);
    $Contactnumber = $Cnumber1.$Cnumber;

    $age = trim($_POST['age']);
    $bday = trim($_POST['bday']);
    $bplace = trim($_POST['bplace']);
    $address = trim($_POST['address']);
    $datefill = $_POST['datefill'];

    $Com_Reg = $_POST['Com_Reg'];

    $HEA = implode($_POST['HEA']);
    $HEA1= $_POST['HEA1'];
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

    $Comm_Serv =  implode($_POST['Comm_Serv']);

    if (empty($lname) || empty($fname) || empty($Civil_Status) || empty($Gender)
        || empty($Cnumber) || empty($age) || empty($bplace) || empty($address) ||
         empty($age)|| empty($HEA) || empty($occupation) || empty($SOURCE) || empty($MONTHLY)|| empty($SKILLS) || empty($Comm_Serv)
        || empty($_FILES['pdf_file']['name'])) {

      echo (mysqli_error($conn))."Fill-up all required fields <a style='color:black;'>( * )</a> <br>or<br> Attach your Requirements..";
    }
    elseif (empty($userid)) {
      echo (mysqli_error($conn))."Session Timeout <br> Make Sure You're not loging in deffirent account";
    }

    elseif ($age < 60){
      echo "Invalid age for Senior Citizen";
    }
    elseif (empty($userid)) {
      echo (mysqli_error($conn))."Session Timeout <br> Make Sure You're not loging in deffirent account";
    }
else {


  $targetDir = 'pdf/';
  $Requirements=basename($_FILES['pdf_file']['name']);
  $targetFilePath = $targetDir . $Requirements;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
  $allowTypes = array('pdf');


    if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetFilePath))
    {

      $sql = "UPDATE senior_application SET ControlNumber ='$ctrl_num', Lastname='$lname', Firstname='$fname', MiddleName='$mname', CivilStatus='$Civil_Status', Gender='$Gender', ContactNumber='$Contactnumber', Age='$age', Birthday='$bday', BirthPlace='$bplace', Address='$address', DateFillUp='$datefill'
              WHERE  user_id=".$id;

      $sql1 = "UPDATE senior_application_detail SET ControlNumber ='$ctrl_num', ComelicReg='$Com_Reg', HighestEducationalAttainment='$hea',Living_Residing='$Living', Occupation='$Occupation', SourceIncome='$Source', MonthlyIncome='$MONTHLY',
      Areas_Specialization='$SKILLS', PROBorNEEDS_Economics='$PROBorNEEDS_Econ', PROBorNEEDS_Social='$PROBorNEEDS_Soc', PROBorNEEDS_Health='$PROBorNEEDS_H', PROBorNEEDS_Housing='$PROBorNEEDS_House', Comm_Serv='$Comm_Serv'
         WHERE  user_id=".$id;

      $sql2 = "UPDATE senior_upload_requirements SET ControlNumber ='$ctrl_num', Requirements='$Requirements', Lastname='$lname', Firstname='$fname', Middle_Name='$mname', Gender='$Gender', Age='$age'
              WHERE user_id=".$id;

      $result = mysqli_query($conn, $sql);
      $result1 = mysqli_query($conn, $sql1);
      $result2 = mysqli_query($conn, $sql2);

                  $result = mysqli_query($conn, $sql);
                  $result1 = mysqli_query($conn, $sql1);
                  $result2 = mysqli_query($conn, $sql2);

                  if (!$result || !$result1 || !$result2) {
                    echo (mysqli_error($conn));
                  }else{
                    echo (mysqli_error($conn))."Data Updated Successful";
                  }
      }else {
            echo "Error";
            }
          }
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
      $sql = "SELECT * FROM add_senior_requirements ORDER BY id ASC";
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
  <input type="text" class="form-control" style="text-align:center; " name="ctrl_num" value="<?php echo $ctrl_num;?>" readonly><br><br>
  <input type="text" class="form-control"  name="lname" placeholder="Last Name" pattern="^[a-zA-Z ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $lname;?>">
  <input type="text" class="form-control"  name="fname" placeholder="First Name" pattern="^[a-zA-Z ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $fname;?>">
  <input type="text" class="form-control"  name="mname" placeholder="Middle Name" pattern="^[a-zA-Z ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $mname;?>">
  </div>
  <div class="form-inline"><br>
      <select class="form-control" name="Civil_Status" value="<?php echo $Civil_Status;?>">
          <option value="" >Civil Status</option>
          <option value="Single" <?php if($Civil_Status=='Single'){echo "selected";}?>>Single</option>
          <option value="Married" <?php if($Civil_Status=='Married'){echo "selected";}?>>Married</option>
          <option value="Widowed" <?php if($Civil_Status=='Widowed'){echo "selected";}?>>Widowed</option>
          <option value="Separated" <?php if($Civil_Status=='Separated'){echo "selected";}?>>Separated</option>
      </select>
      <select class="form-control" name="Gender" value="<?php echo $Gender;?>">
          <option value="">Gender</option>
          <option value="Male"<?php if($Gender=='Male'){echo "selected";}?>>Male</option>
          <option value="Female"<?php if($Gender=='Female'){echo "selected";}?>>Female</option><br>
      </select>
  <select class="form-control" name="Cnumber1">
    <option value="+63">+63</option>
  </select>
  <input type="text" class="form-control"  name="Cnumber" maxlength="10" placeholder="Contact Number"  pattern="^[0-9]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo substr($Cnumber, 3, 12);?>">
  <input type="text" class="formage"  name="age" placeholder="Age" maxlength="3" pattern="^[0-9]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $age;?>"><br><br>
  </div>
  <div class="form-inline"><br>
  <strong>Birth Date: <br><br></strong><input type="date" class="form-control"  name="bday" value="<?php echo $bday;?>"><br>
  </div>
  <br>
  <input type="text" class="form-control"  name="bplace" placeholder="Birth Place" pattern="^[a-zA-Z0-9., ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $bplace;?>"><br>
  <input type="text" class="form-control"  name="address"  placeholder="Complete Address" pattern="^[a-zA-Z0-9., ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $address;?>"><br>
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
  </div><br><br>
 <div class="form-inline">
       <select class="form-control" name="HEA[]">
           <option value="">HIGHEST EDUCATIONAL ATTAINMENT</option>
           <?php
           $sql = "SELECT * FROM add_highest_educ_attainment";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_array($result)){
           $EA = $row['EducationalAttainment'];
           if ($HEAS==$EA) {
             $hea='selected';
           }else {
             $hea='';
           }
           echo '<option value="'.$EA.'" '.$hea.'> '.$EA.'</option>';
          }
          ?>
       </select>
       <input type="text" class="form-control"  name="HEA1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if($HEAS==$EA){echo $HEAS;}else{echo '';}?>"><br>
</div><br>
    <strong>LIVING/RESIDING WITH (check all applicable):</strong><br><br>

         <?php
         $sql = "SELECT * FROM add_living_residing";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
         $LorR = $row['LivingResiding'];


         if(in_array(trim(strtolower($LorR."")), $living)){
           $lr= "checked";
         }else {

           $lr='unchecked';
         }

          echo '<label><input type="checkbox" value="'.$LorR.'" name="LIVING[]" '.$lr.'> '.$LorR.'</label><br>';

          for($x=0;$x<count($living);$x++)
          {
           if(trim(strtolower($LorR.""))== trim(strtolower($living[$x]."")))
           {

                 $living[$x]="*";
                 break;
           }
         }
         }
         $counter = 0;
         $cont ="";
         for($x=0;$x<count($living);$x++)
         {
          if(!($living[$x]=="*"))
            {
              $counter++;
              if($counter==1)
              {
                  $cont = $cont."".$living[$x];

              }else {
                $cont = $cont.",".$living[$x];
              }

            }

         }
        ?>

       <div class="form-inline"><br>
       <input type="text" class="form-control"  name="LIVING1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $cont;?>"><br>
     </div><br>
  <div class="form-inline"><br>
      <select class="form-control" name="occupation[]">
        <option value="">OCCUPATION</option>
        <?php
        $sql = "SELECT * FROM add_occupation";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        $occ = $row['Occupation'];
        if ($occupation==$occ) {
          $occu='selected';
        }else {
          $occu='';
        }

         echo '<option value="'.$occ.'" '.$occu.'> '.$occ.'</option>';
       }
       ?>
       </select>
       <input type="text" class="form-control"  name="occupation1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if($occupation==$occ){echo $occupation;}else{echo '';};?>"><br>
       </div><br>
       <div class="form-inline"><br>
       <select class="form-control" name="SOURCE[]">
         <option value="">SOURCE OF INCOME/SUPPORT/ASSISTANCE</option><?php
         $sql = "SELECT * FROM add_source_isa";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
         $source = $row['SourceIncomeSupportAssistance'];
         if ($SOURCE==$source) {
           $sources='selected';
         }else {
           $sources='';
         }

          echo '<option value="'.$source.'" '.$sources.'> '.$source.'</option>';
        }
       ?>
       </select>
       <input type="text" class="form-control"  name="SOURCE1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php if ($SOURCE == $source){echo $SOURCE;}else {echo '';}?>"><br>
       <br><br>
          <select class="form-control" name="MONTHLY[]" value="<?php echo $MONTHLY;?>">
            <option value="">MONTHLY INCOME/SUPPORT/ASSISTANCE</option>
            <?php
            $sel='';
            $sql = "SELECT * FROM add_monthly_isa";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $sisa = $row['MonthlyIncomeSupportAssistance'];
            if ($MONTHLY==$sisa) {
              $Mon='selected';
            }else {
              $Mon='';
            }

             echo '<option value="'.$sisa.'" '.$Mon.'> '.$sisa.'</option>';
           }
           ?>
          </select>
          </div><br>
          <div class="form-inline"><br>
             <select class="form-control" name="SKILLS[]" value="<?php echo $MONTHLY;?>">
               <option value="">Areas of Specialization/Skills</option>
               <?php
               $sel='';
               $sql = "SELECT * FROM add_areas_specialization_skills";
               $result = mysqli_query($conn, $sql);
               while($row = mysqli_fetch_assoc($result)){
               $ass = $row['SpecializationOrSkills'];
               if ($SKILLS==$ass) {
                 $skill='selected';
               }else {
                 $skill='';
               }

                echo '<option value="'.$ass.'" '.$skill.'> '.$ass.'</option>';
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
   <strong>PROBLEM/NEEDS COMMONLY ENCOUNTERED (check all applicable):</strong><br><br>
      <b><Strong>Economics:</b></strong><br><br>
      <label class="checkbox-inline">
        <?php
        $sql = "SELECT * FROM add_problem_economics";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        $econ = $row['Economics'];

        if(in_array(trim(strtolower($econ."")), $Economics)){

          $ecomy= "checked";
        }else {

          $ecomy='unchecked';
        }


         echo '<label><input type="checkbox" value="'.$econ.'" name="PROBorNEEDS_Economics[]" '.$ecomy.'> '.$econ.'</label><br>';
         for($x=0;$x<count($Economics);$x++)
         {
          if(trim(strtolower($econ.""))== trim(strtolower($Economics[$x]."")))
          {

                $Economics[$x]="*";
                break;
          }
        }
       }
       $counter = 0;
       $cont ="";
       for($x=0;$x<count($Economics);$x++)
       {
         if(!($Economics[$x]=="*"))
           {
             $counter++;
             if($counter==1)
             {
                 $cont = $cont."".$Economics[$x];

             }else {
               $cont = $cont.",".$Economics[$x];
             }

           }

      }
       ?>
      </label><br><br>
      <div class="form-inline">
      <input type="text" class="form-control"  name="PROBorNEEDS_Economics1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $cont; ?>">
      </div><br>

      <b><Strong>Social/Emotional:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_emotional_social";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $EmSoc = $row['EmotionalSocial'];
           if(in_array(trim(strtolower($EmSoc)), $Social)){
             $emsoc= "checked";
           }else {
             $emsoc='unchecked';
           }

            echo '<label><input type="checkbox" value="'.$EmSoc.'" name="PROBorNEEDS_Social[]" '.$emsoc.'> '.$EmSoc.'</label><br>';

            for($x=0;$x<count($Social);$x++)
            {
             if(trim(strtolower($EmSoc.""))== trim(strtolower($Social[$x]."")))
             {

                   $Social[$x]="*";
                   break;
             }
           }
          }
          $counter = 0;
          $cont ="";
          for($x=0;$x<count($Social);$x++)
          {
            if(!($Social[$x]=="*"))
              {
                $counter++;
                if($counter==1)
                {
                    $cont = $cont."".$Social[$x];

                }else {
                  $cont = $cont.",".$Social[$x];
                }

              }

         }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Social1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $cont;?>"><br>
          </div><br>
     <b><Strong>Health:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_health";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $health = $row['Health'];
           if(in_array(trim(strtolower($health)), $Health)){
             $heal= "checked";
           }else {
             $heal='unchecked';
           }

            echo '<label><input type="checkbox" value="'.$health.'" name="PROBorNEEDS_Health[]" '.$heal.'> '.$health.'</label><br>';
            for($x=0;$x<count($Health);$x++)
            {
             if(trim(strtolower($health.""))== trim(strtolower($Health[$x]."")))
             {

                   $Health[$x]="*";
                   break;
             }
           }
          }
          $counter = 0;
          $cont ="";
          for($x=0;$x<count($Health);$x++)
          {
            if(!($Health[$x]=="*"))
              {
                $counter++;
                if($counter==1)
                {
                    $cont = $cont."".$Health[$x];

                }else {
                  $cont = $cont.",".$Health[$x];
                }

              }

         }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Health1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $cont;?>"><br><br>
       </div>
     <b><strong>Housing:</b></strong><br><br>

         <label class="checkbox-inline">
           <?php
           $sql = "SELECT * FROM add_problem_housing";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
           $house = $row['Housing'];
           if(in_array(trim(strtolower($house)), $Housing)){
             $hous= "checked";
           }else {
             $hous='unchecked';
           }

            echo '<label><input type="checkbox" value="'.$house.'" name="PROBorNEEDS_Housing[]" '.$hous.'> '.$house.'</label><br>';
            for($x=0;$x<count($Housing);$x++)
            {
             if(trim(strtolower($house.""))== trim(strtolower($Housing[$x]."")))
             {

                   $Housing[$x]="*";
                   break;
             }
           }
          }
          $counter = 0;
          $cont ="";
          for($x=0;$x<count($Housing);$x++)
          {
            if(!($Housing[$x]=="*"))
              {
                $counter++;
                if($counter==1)
                {
                    $cont = $cont."".$Housing[$x];

                }else {
                  $cont = $cont.",".$Housing[$x];
                }

              }

         }
          ?>
         </label><br><br>
         <div class="form-inline">
         <input type="text" class="form-control"  name="PROBorNEEDS_Housing1"  placeholder="Others pls. specify" pattern="^[a-zA-Z, ]+$"  oninput="if (!this.checkValidity()) this.value = this.value.slice(0, -1)"value="<?php echo $cont; ?>"><br><br>


        <select class="form-control" name="Comm_Serv[]">
          <option value="">COMMUNITY SERVICE</option>
          <?php
          $sql = "SELECT * FROM add_community_serv";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
          $comserv = $row['CommunityServices'];
          if ($Comm_Serv==$comserv) {
            $com='selected';
          }else {
            $com='';
          }

           echo '<option value="'.$comserv.'" '.$com.'> '.$comserv.'</option>';
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
  <br><center><h1>Uploaded Requirements</h1></center><br>
  Uplaoded File: <?php echo '<a href="pdf/'.$Requirements.'" target="_blank">'.$Requirements.'</a>'; ?>
  <br><br>
  <input type="file" name="pdf_file" accept="application/pdf">
  </h4>
  <div id="errorBlock" class="help-block"><br></div>
  <input class="btn btn-danger" type="button" value="Previous">
  <input class="btn btn-success" type="submit" name="update" value="Update">
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
