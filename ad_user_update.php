<!DOCTYPE html>
<?php 
ob_start();
session_start();
include("control.php");
$get_data=new data();
if(empty($_SESSION["email"])){
    header('location:login.php');
}
else{
$select_info=$get_data->get_register($_SESSION["email"],$_SESSION["pass"]);
foreach($select_info as $select){
	$name_login=$select["Fullname"];
	$user_avata=$select["file"];
}    
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Business Solutions</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<!--[if lte IE 7	]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" charset="utf-8" />	
	<![endif]-->
    <style>
        


#cont {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
div#cont>input[type=text], input[type=password],input[type=date],input[type=file] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

div#cont>input[type=text]:focus, input[type=password]:focus,input[type=date]:focus,input[type=file]:focus,select:focus {
  background-color: #ddd;
  outline: none;
}
div#cont>select{
	width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #0c2635;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
div#cont>a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
.img{
	width: 250px;
}
    </style>
</head>

<body>
	<div id="header">
		<a href="trang1.php" id="logo"><img src="images/logo1.jpg" alt="LOGO" /></a>
		<div id="navigation">
			<ul>
            <li class="first"><a href="admin_login.php">Home</a></li>
				<li><a href="ad_man_blog.php">Blog</a></li>
				<li><a href="ad_man_user.php">User</a></li>
				<li><a href="ad_contact.php">Contact</a></li>
				<li><a href="ad_man_add.php">?????a ??i???m</a></li>
				<li><a href="ad_man_hd.php">Header</a></li>
				<li><a href=""><img src="img/<?php echo $user_avata?>" width="40px" height="40px" style="border-radius:50%;"></a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</div>
		<div id="search">
        <form action="" method="POST">
				<input type="text" placeholder="Search" class="txtfield" name="txt_search">
				<input type="submit" value="" class="button" name="btn_search">
			</form>
			<?php
			if(isset($_POST["btn_search"])){
				?>
				<script>
				location.href = "ad_search_blog.php?search=<?php echo $_POST['txt_search'];?>";
				</script>
			<?php
			}
			?>
		</div>
	</div> <!-- /#header -->
	<div id="contents">
		<div class="background">
        <form enctype="multipart/form-data" method="POST">
    <div class="container" id="cont">
    <h1>C???p nh???t th??ng tin</h1>
    <!-- <p>M???i b???n ??i???n v??o m???u ????ng k?? d?????i ????y.</p> -->
    <hr>
    <?php
     $user_update=$get_data->get_user($_GET['update']);
     foreach($user_update as $user){
     
    ?>
	<label for="fname"><b>H??? t??n</b></label>
    <input type="text" value="<?php  echo $user['Fullname']?>" name="txtfullname" id="fname" required>
    <label for="email"><b>Email</b></label>
    <input type="text" value="<?php  echo $user['email']?>" name="txtemail" id="email" required>
	<label>Gi???i t??nh</label>
	<select name="txtGioiTinh" class="inputs" >
		<option value="Nam" <?php if($user['gender']=="Nam") echo 'selected';?>>Nam</option>
		<option value="N???" <?php if($user['gender']=="N???") echo 'selected';?>>N???</option>
		<option value="Kh??c" <?php if($user['gender']=="Kh??c") echo 'selected';?>>Kh??c</option>
	 </select>
	 <label>?????a ch???</label>	
	<select name="txtQueQuan" class="inputs" >
							<?php
							$add=$get_data->select_devvn_tinhthanhpho();
							foreach($add as $se){
							?>
                            <option value="<?php echo $se['matp'] ?>" <?php if($se['matp']==$user['address']) echo 'selected';?>><?php echo $se['name'] ?></option>

							<?php  }?>
                         </select>	
	<label for="date"><b>Ng??y sinh</b></label>
	<input type="date" value="<?php echo $user['birthday'] ?>" class="date" name="txtDate"/>
	<label for="date"><b>???nh c??</b></label>    <br>                
    <img src="img/<?php echo $user['file'] ?>" class="img"><br>
    <label for="date"><b>???nh m???i</b></label>                  
    <input type="file" class="file" name="txtFile"/>
    <hr>
    <input type="submit" class="registerbtn" name="btn_rgst" value="C???p nh???t">
    <?php
     }
    ?>
  </div>
</form>
<?php
			
	if(isset($_POST["btn_rgst"])){
		if(empty($_POST['txtFile'])){ $_POST['txtFile']=$user['file'];}
		if($user['email']=!$_POST['txtemail']){
		$check_mail=$get_data->check_email($_POST["txtemail"]);
		if($check_mail>0){
			echo"<script> alert('Email n??y ???? ????ng k??')</script>";	
		}
	}
		else{
			
			move_uploaded_file($_FILES['txtFile']['tmp_name'],"img/". $_FILES['txtFile']['name']);
            $insert=$get_data->update_infor($_POST['txtfullname'],$_POST['txtemail'],$_POST['txtQueQuan'],$_POST['txtDate'],$_FILES['txtFile']['name'],$_POST['txtGioiTinh'],$_GET['update']);
			if($insert){
				echo"<script> alert('th??nh c??ng')</script>";
            }  
	            else
                echo"<script> alert('Kh??ng th??nh c??ng')</script>";
              	
			}
	}
	
?>

	</div> <!-- /#contents -->
	<div id="footer">
		<ul class="contacts">
			<h3>Contact Us</h3>
			<li><span>Email</span><p>: company@email.com</p></li>
			<li><span>Address</span><p>: 189 Lorem Ipsum Pellentesque, Mauris Etiam ut velit odio Proin id nisi enim 0000</p></li>
			<li><span>Phone</span><p>: 117-683-9187-000</p></li>
		</ul>
		<ul id="connect">
			<h3>Get Updated</h3>
			<li><a href="blog.php">Blog</a></li>
			<li><a href="http://facebook.com/freewebsitetemplates" target="_blank">Facebook</a></li>
			<li><a href="http://twitter.com/fwtemplates" target="_blank">Twitter</a></li>
		</ul>
		<div id="newsletter">
			<p><b>Nh???n th??ng tin </b>
				????ng k?? nh???n th??ng b??o qua email ????? kh??ng b??? l??? b??i vi???t m???i nh???t.
			</p>
			<form action="" method="post">
				<input type="text" placeholder="T??n" class="txtfield"  name="txt_name"/>
				<input type="text" placeholder="Email" class="txtfield"  name="txt_email"/>
				<input type="submit" value="" class="button" name="btnsub" />
			</form>
			<?php
			if(isset($_POST['btnsub'])){
			 $check=$get_data->check_contact($_POST['txt_email']);
			 if($check>0){
				echo"<script> alert('Email n??y ???? ????ng k??')</script>";	
			 }		
			 else{
				$get_contact=$get_data->contact($_POST['txt_name'],$_POST['txt_email']);
				if($get_contact){
						$username='phuong16397@gmail.com';
						$password='Pphuong16';
						$address=$_POST['txt_email'];
						$subject='BLOG TRAVEl ';
						$body='Dear '.$_POST['txt_name'].', b???n ???? ????ng k?? nh???n th??ng tin t???i trang  BLOG TRAVEL ';
						$altbody='Thanks ';
						$sendMail=$get_data->sendMail($username,$password,$address,$subject,$body,$altbody);
						if($sendMail==1){
						?> <script>
						location.href = 'contact_success.php';
						</script>
						<?php
					}  
						
						else
						echo"<script> alert('Kh??ng th??nh c??ng')</script>";
						  
					}	
				
				else{
					echo"<script> alert('L???i!')</script>";
				}
			}
			}
			?>	
		</div>
		<span class="footnote">&copy; Copyright &copy; 2011. All rights reserved</span>
	</div> <!-- /#footer -->
</body>
</html>