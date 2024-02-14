<?php
session_start();
?>
<?php
include_once "inc/header.php";
include_once "inc/db.php";




$year = 2000;
$cyear = date("y");
$lim = $cyear - 18 + 2000;
$today = date("-m-d");
$yearlim = $lim . $today;

$err = "";

$fname = "";
$lname = "";
$uname = "";
$pemail = "";
$udob = "";
$bio = "";
$gender = "";
$profile_pic = "";

$phone_no = "";
$website = "";
$facebook = "";
$instagram = "";
$twitter = "";
$mail = "";

$usernameerr = "";

$sql = "SELECT * FROM users where user_id = '$user_id'";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
	$fname = $row["f_name"];
	$lname = $row["l_name"];
	$uname = $row["username"];
	$pemail = $row["email"];
	$udob = $row["dob"];
	$bio = $row["bio"];
	$gender = $row["gender"];
	$profile_pic = $row["profile_pic"];

	$phone_no = $row["phone_no"];
	$website = $row["website"];
	$facebook = $row["facebook"];
	$instagram = $row["instagram"];
	$twitter = $row["twitter"];
	$mail = $row["mail"];
}







if (isset($_POST['saveg'])) {

	$_SESSION["active"] = 1;
	$_SESSION["show_active"] = 1;

	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$uname = $_POST["uname"];
	$pemail = $_POST["pemail"];
	$udob = $_POST["udob"];
	$bio = $_POST["bio"];
	$gender = $_POST["gender"];



	$ce = 0;
	$sqlun = "SELECT username FROM users where username = '$uname' and user_id != '$user_id'";
	$resultun = mysqli_query($db, $sqlun);
	$ce = mysqli_num_rows($resultun);
	if ($ce >= 1) {
		$usernameerr = $uname . " is already taken username need to be unique.";
	} else {

		if ($profile_pic == "default_m_pp.png" || $profile_pic == "default_f_pp.png") {
			if ($gender == "f") {
				$sqlu = "update users 
		set f_name = '$fname', l_name = '$lname', profile_pic = 'default_f_pp.png', username = '$uname', email = '$pemail', dob = '$udob', bio = '$bio', gender = '$gender' WHERE user_id = $user_id";
			} else {
				$sqlu = "update users 
		set f_name = '$fname', l_name = '$lname', profile_pic = 'default_m_pp.png', username = '$uname', email = '$pemail', dob = '$udob', bio = '$bio', gender = '$gender' WHERE user_id = $user_id";
			}
		} else {
			$sqlu = "update users 
set f_name = '$fname', l_name = '$lname', username = '$uname', email = '$pemail', dob = '$udob', bio = '$bio', gender = '$gender' WHERE user_id = $user_id";
		}


		mysqli_query($db, $sqlu);
		echo "<script>alert('Change saved successfully ✓')</script>";
	}
}

if (isset($_POST['savesl'])) {

	$_SESSION["active"] = 2;
	$_SESSION["show_active"] = 2;

	$phone_no = $_POST["phone"];
	$website = $_POST["website"];
	$facebook = $_POST["facebook"];
	$instagram = $_POST["instagram"];
	$twitter = $_POST["twitter"];
	$mail = $_POST["mail"];


	$sql = "update users 
	set phone_no = '$phone_no', website = '$website', facebook = '$facebook', instagram = '$instagram', twitter = '$twitter', mail = '$mail' WHERE user_id = $user_id";
	mysqli_query($db, $sql);
	echo "<script>alert('Change saved successfully ✓')</script>";
}
$oldperr = "";
$newperr = "";
$repperr = "";

if (isset($_POST['chpass'])) {
	$_SESSION["active"] = 5;
	$_SESSION["show_active"] = 5;


	$oldpass = $_POST['passwordo'];
	$newpass = $_POST['passwordn'];
	$reppass = $_POST['passwordr'];


	$verify = password_verify($oldpass, $passwordhash);
	if ($verify) {
		$uppercase = preg_match('@[A-Z]@', $newpass);
		$lowercase = preg_match('@[a-z]@', $newpass);
		$number = preg_match('@[0-9]@', $newpass);


		if (!$uppercase) {
			//echo "<script>alert('Must contain at least one uppercase character')</script>"; 
			$newperr = $newperr . "* Must contain at least one uppercase character" . "<br>";
		}
		if (!$lowercase) {
			//echo "<script>alert('Must contain at least one lowercase character')</script>"; 
			$newperr = $newperr . "* Must contain at least one lowercase character" . "<br>";
		}
		if (!$number) {
			//echo "<script>alert('Must contain at least 1 number')</script>"; 
			$newperr = $newperr . "* Must contain at least 1 number" . "<br>";
		}

		if ($newpass != $reppass) {
			//echo "<script>alert('Password do not match')</script>"; 
			$repperr = $repperr . "* Password do not match" . "<br>";
		}
	} else {
		$oldperr = "Incorrect password!!!";
	}

	if ($oldperr == "" and $newperr == "" and $repperr == "") {
		$passwordhashch = password_hash($newpass, PASSWORD_DEFAULT);

		$sql_ch_pass = "UPDATE users SET password = '$passwordhashch' WHERE user_id = '$user_id'";
		mysqli_query($db, $sql_ch_pass);
		echo '<script type="text/javascript">';
		echo'alert("To complete this process we will sign you out");';
        echo "window.location.href = 'sign_in.php';";
        echo "</script>";

	}
}





if (!isset($_SESSION["active"])) {
	$_SESSION["active"] = 1;
	$_SESSION["show_active"] = 1;
}

$activetab1 = "";
$activetab2 = "";
$activetab3 = "";
$activetab4 = "";
$activetab5 = "";
$activetab6 = "";
$activetab7 = "";
$activetab8 = "";
$activetab9 = "";
$activetab0 = "";
$activetab10 = "";

$active1 = "";
$active2 = "";
$active3 = "";
$active4 = "";
$active5 = "";
$active6 = "";
$active7 = "";
$active8 = "";
$active9 = "";
$active0 = "";
$active10 = "";

if ($_SESSION["active"] == 1) {
	$activetab1 = " active";
	$active1 = "show active";
}
if ($_SESSION["active"] == 2) {
	$activetab2 = " active";
	$active2 = "show active";
}

if ($_SESSION["active"] == 3) {
	$activetab3 = " active";
	$active3 = "show active";
}

if ($_SESSION["active"] == 4) {
	$activetab4 = " active";
	$active4 = "show active";
}

if ($_SESSION["active"] == 5) {
	$activetab5 = " active";
	$active5 = "show active";
}

if ($_SESSION["active"] == 6) {
	$activetab6 = " active";
	$active6 = "show active";
}

if ($_SESSION["active"] == 7) {
	$activetab7 = " active";
	$active7 = "show active";
}

if ($_SESSION["active"] == 8) {
	$activetab8 = " active";
	$active8 = "show active";
}

if ($_SESSION["active"] == 9) {
	$activetab9 = " active";
	$active9 = "show active";
}

if ($_SESSION["active"] == 0) {
	$activetab0 = " active";
	$active0 = "show active";
}

if ($_SESSION["active"] == 10) {
	$activetab10 = " active";
	$active10 = "show active";
}

?>





<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Setting | Ethio Connect</title>
	<section class="profile-account-setting">
		<div class="container">
			<div class="account-tabs-setting">
				<div class="row">
					<div class="col-lg-3">
						<div class="acc-leftbar">
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link<?php echo $activetab1; ?>" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true"><i class="fa fa-user"></i>General Settings</a>
								<a class="nav-item nav-link<?php echo $activetab2; ?>" id="nav-social-tab" data-toggle="tab" href="#nav-social" role="tab" aria-controls="nav-social" aria-selected="false"><i class="fa fa-external-link"></i>Social Links</a>
								<a class="nav-item nav-link<?php echo $activetab3; ?>" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="false"><i class="la la-cogs"></i>Account Setting</a>
								<a class="nav-item nav-link<?php echo $activetab4; ?>" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-line-chart"></i>Status</a>
								<a class="nav-item nav-link<?php echo $activetab5; ?>" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
								<a class="nav-item nav-link<?php echo $activetab9; ?>" id="nav-privacy-tab" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false"><i class="fa fa-paw"></i>Privacy</a>
								<a class="nav-item nav-link<?php echo $activetab10; ?>" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>Deactivate Account</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade<?php echo $active1; ?>" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
								<div class="acc-setting">
									<h3>General Account Settings</h3>
									<form action="" method="POST">

										<div class="cp-field">
											<h5>First Name</h5>
											<div class="cpp-fiel">
												<input type="text" name="fname" value="<?php echo $fname; ?>" maxlength="20" placeholder="First Name" required>
												<i class="la la-user"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Last Name</h5>
											<div class="cpp-fiel">
												<input type="text" name="lname" value="<?php echo $lname; ?>" maxlength="20" placeholder="Last Name" required>
												<i class="la la-user"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Username</h5>
											<div class="cpp-fiel">
												<input type="text" name="uname" value="<?php echo $uname; ?>" maxlength="20" placeholder="Username" required>
												<p style="color: red;"><?php echo $usernameerr; ?></p>
												<i class="fa fa-user-circle-o"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Primary Email</h5>
											<div class="cpp-fiel">
												<input type="email" name="pemail" value="<?php echo $pemail; ?>" maxlength="50" placeholder="Primary Email Address" required>
												<i class="la la-envelope"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Date of Birth</h5>
											<div class="cpp-fiel">
												<input type="date" name="udob" value="<?php echo $udob; ?>" min="1905-01-01" max="<?php echo $yearlim; ?>" required>
												<i class="fa fa-birthday-cake"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Gender</h5>
											<div class="cpp-fiel">
												<select class="form-control" name="gender" required>
													<?php
													if ($gender == "f") {
													?>
														<option value="f">Female</option>
														<option value="m">Male</option>

													<?php
													} else {
													?>

														<option value="m">Male</option>
														<option value="f">Female</option>
													<?php
													}
													?>


												</select>

											</div>
										</div>



										<div class="cp-field">
											<h5>Bio <small style="font-size: 14px; color: gray;">(describe yourself with in 70 characters)</small></h5>
											<div class="cpp-fiel">
												<input type="text" name="bio" value="<?php echo $bio; ?>" maxlength="70" required>
												<i class="fa fa-address-book-o"></i>
											</div>
										</div>

										<div class="save-stngs pd2">
											<ul>
												<li><button type="submit" name="saveg">Save Change</button></li>
											</ul>
										</div>

									</form>
								</div>
							</div>

							<div class="tab-pane fade<?php echo $active2; ?>" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab">
								<div class="acc-setting">
									<h3>Social Links</h3>
									<form action="" method="POST">

										<div class="cp-field">
											<h5>Phone Number</h5>
											<div class="cpp-fiel">
												<input type="tel" name="phone" value="<?php echo $phone_no; ?>" maxlength="15" required>
												<i class="fa fa-mobile"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Website </h5>
											<div class="cpp-fiel">
												<input type="url" name="website" value="<?php echo $website; ?>" required>
												<i class="fa fa-globe"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Facebook <small style="font-size: 14px; color: gray;">(describe yourself with in 70 characters)</small></h5>
											<div class="cpp-fiel">
												<input type="url" name="facebook" value="<?php echo $facebook; ?>" required>
												<i class="fa fa-facebook"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Instagram <small style="font-size: 14px; color: gray;">(describe yourself with in 70 characters)</small></h5>
											<div class="cpp-fiel">
												<input type="url" name="instagram" value="<?php echo $instagram; ?>" required>
												<i class="fa fa-instagram"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Twitter <small style="font-size: 14px; color: gray;">(describe yourself with in 70 characters)</small></h5>
											<div class="cpp-fiel">
												<input type="url" name="twitter" value="<?php echo $twitter; ?>" required>
												<i class="fa fa-twitter"></i>
											</div>
										</div>

										<div class="cp-field">
											<h5>Email <small style="font-size: 14px; color: gray;">(describe yourself with in 70 characters)</small></h5>
											<div class="cpp-fiel">
												<input type="email" name="mail" value="<?php echo $mail; ?>" maxlength="50" required>
												<i class="fa fa-envelope-o"></i>
											</div>
										</div>

										<div class="save-stngs pd2">
											<ul>
												<li><button type="submit" name="savesl">Save Change</button></li>
											</ul>
										</div>


									</form>
								</div>
							</div>

							<div class="tab-pane fade<?php echo $active3; ?>" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
								<div class="acc-setting">
									<h3>Account Setting</h3>
									<form>
										<div class="notbar">
											<h4>Notification Sound</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
											<div class="toggle-btn">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch1">
													<label class="custom-control-label" for="customSwitch1"></label>
												</div>
											</div>
										</div>
										<div class="notbar">
											<h4>Notification Email</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
											<div class="toggle-btn">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch2">
													<label class="custom-control-label" for="customSwitch2"></label>
												</div>
											</div>
										</div>
										<div class="notbar">
											<h4>Chat Message Sound</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
											<div class="toggle-btn">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch3">
													<label class="custom-control-label" for="customSwitch3"></label>
												</div>
											</div>
										</div>
										<div class="save-stngs">
											<ul>
												<li><button type="submit">Save Setting</button></li>
												<li><button type="submit">Restore Setting</button></li>
											</ul>
										</div>
									</form>
								</div>
							</div>

							<div class="tab-pane fade<?php echo $active4; ?>" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
								<div class="acc-setting">
									<h3>Profile Status</h3>
									<div class="profile-bx-details">
										<div class="row">

											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="profile-bx-info">
													<div class="pro-bx">
														<img src="images/follower.png" alt="">
														<div class="bx-info">
															<?php
															$sql_following = "SELECT * FROM follower where follower_id = '$user_id'";
															$result_following = mysqli_query($db, $sql_following);
															$following = mysqli_num_rows($result_following);

															$sql_followers = "SELECT * FROM follower where follow_id = '$user_id'";
															$result_followers = mysqli_query($db, $sql_followers);
															$followers = mysqli_num_rows($result_followers);

															$sql_posts = "SELECT * FROM post where user_id = '$user_id'";
															$result_posts = mysqli_query($db, $sql_posts);
															$posts = mysqli_num_rows($result_posts);


															$post_id = array();
															$a = 0;
															while ($row = mysqli_fetch_array($result_posts)) {
																$post_id[$a] = $row["post_id"];
																$a++;
															}

															$likes = 0;
															for ($a = 0; $a < $posts; $a++) {
																$post_id1=$post_id[$a];
																$sqllikes = "SELECT * FROM post_like where post_id = '$post_id1'";
																$resultlikes = mysqli_query($db, $sqllikes);
																$likes = $likes + mysqli_num_rows($resultlikes);
															}





															?>
															<h3><?php echo $followers; ?></h3>
															<h5>Followers</h5>
														</div>
													</div>
													<p>You have <?php echo $followers; ?> followers so far.</p>
												</div>
											</div>

											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="profile-bx-info">
													<div class="pro-bx">
														<img src="images/following.png" alt="">
														<div class="bx-info">
															<h3><?php echo $following; ?></h3>
															<h5>Following</h5>
														</div>
													</div>
													<p>You follow <?php echo $following; ?> users.<br><br></p>
												</div>
											</div>

											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="profile-bx-info">
													<div class="pro-bx">
														<img src="images/post.png" alt="">
														<div class="bx-info">
															<h3><?php echo $posts; ?></h3>
															<h5>Posts</h5>
														</div>
													</div>
													<p>You published <?php echo $posts; ?> posts so far.</p>
												</div>
											</div>

											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="profile-bx-info">
													<div class="pro-bx">
														<img src="images/like.png" alt="">
														<div class="bx-info">
															<h3><?php echo $likes; ?></h3>
															<h5>Likes</h5>
														</div>
													</div>
													<p>You have <?php echo $likes; ?> post likes so far.</p>
												</div>
											</div>



										</div>
									</div>
									<div class="pro-work-status">

									</div>
								</div>
							</div>

							<div class="tab-pane fade<?php echo $active5; ?>" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
								<div class="acc-setting">
									<h3>Change password</h3>

									<form action="" method="POST">

										<div class="cp-field">
											<h5>Old Password</h5>
											<div class="cpp-fiel">
												<input type="password" id="po" name="passwordo" value="" placeholder="Old Password" required>
												<i class="fa fa-eye-slash" id="sh1" onclick="myFunction1()"></i>
												<span style="color: red;"> <?php echo $oldperr; ?></span>
											</div>
										</div>

										<div class="cp-field">
											<h5>New Password</h5>
											<div class="cpp-fiel">
												<input type="password" id="pn" name="passwordn" placeholder="New Password" required>
												<i class="fa fa-eye-slash" id="sh1" onclick="myFunction2()"></i>
												<span style="color: red;"> <?php echo $newperr; ?></span>
											</div>
										</div>

										<div class="cp-field">
											<h5>Repeat Password</h5>
											<div class="cpp-fiel">
												<input type="password" id="pr" name="passwordr" placeholder="Repeat Password" required>
												<i class="fa fa-eye-slash" id="sh1" onclick="myFunction3()"></i>
												<span style="color: red;"> <?php echo $repperr; ?></span>
											</div>
										</div>

										<div class="cp-field">
											<h5><a href="#" title="">Forgot Password?</a></h5>
										</div>

										<div class="save-stngs pd2">
											<ul>
												<li><button type="submit" name="chpass">Save Setting</button></li>
												<li><button type="reset">Restore Setting</button></li>
											</ul>
										</div>

									</form>

								</div>
							</div>
							
							<script>
								function myFunction1() {
									var x = document.getElementById("po");
									if (x.type === "password") {
										x.type = "text";
										document.getElementById("sh").className = "fa fa-eye";
									} else {
										x.type = "password";
										document.getElementById("sh").className = "fa fa-eye-slash";
									}
								}

								function myFunction2() {
									var x = document.getElementById("pn");
									if (x.type === "password") {
										x.type = "text";
										document.getElementById("sh").className = "fa fa-eye";
									} else {
										x.type = "password";
										document.getElementById("sh").className = "fa fa-eye-slash";
									}
								}

								function myFunction3() {
									var x = document.getElementById("pr");
									if (x.type === "password") {
										x.type = "text";
										document.getElementById("sh").className = "fa fa-eye";
									} else {
										x.type = "password";
										document.getElementById("sh").className = "fa fa-eye-slash";
									}
								}
							</script>


							


							
							




				


							<div class="tab-pane fade<?php echo $active9; ?>" id="privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
								<div class="privac">
									<div class="row">
										<div class="col-12">
											<h3>Privacy</h3>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="dropdown privacydropd">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your email address</a>
												<div class="dropdown-menu">
													<p>Choose who can see your email address on your profile</p>
													<div class="row">
														<div class="col-md-9 col-sm-12">
															<form class="radio-form">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck1">
																	<label class="custom-control-label" for="customCheck1">Everyone</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck2">
																	<label class="custom-control-label" for="customCheck2">Friends</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck3">
																	<label class="custom-control-label" for="customCheck3">Only Me</label>
																</div>
															</form>
														</div>
														<div class="col-md-3 col-sm-12">
															<p style="float: right;">Everyone</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="dropdown privacydropd">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your Friends</a>
												<div class="dropdown-menu">
													<p>Choose who can see your list of connections</p>
													<div class="row">
														<div class="col-md-9 col-sm-12">
															<form class="radio-form">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck4">
																	<label class="custom-control-label" for="customCheck4">Everyone</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck5">
																	<label class="custom-control-label" for="customCheck5">Friends</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck6">
																	<label class="custom-control-label" for="customCheck6">Only Me</label>
																</div>
															</form>
														</div>
														<div class="col-md-3 col-sm-12">
															<p style="float: right;">Everyone</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="dropdown privacydropd">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage who can discover your profile from your email address</a>
												<div class="dropdown-menu">
													<p>Choose who can discover your profile if they are not connected to you but have your email address</p>
													<div class="row">
														<div class="col-md-9 col-sm-12">
															<form class="radio-form">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck7">
																	<label class="custom-control-label" for="customCheck7">Everyone</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck8">
																	<label class="custom-control-label" for="customCheck8">Friends</label>
																</div>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck9">
																	<label class="custom-control-label" for="customCheck9">Only Me</label>
																</div>
															</form>
														</div>
														<div class="col-md-3 col-sm-12">
															<p style="float: right;">Everyone</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="dropdown privacydropd">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Search history</a>
												<div class="dropdown-menu">
													<p>Clear all previous searches performed on LinkedIn</p>
													<div class="row">
														<div class="col-12">
															<form class="radio-form">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck10">
																	<label class="custom-control-label" for="customCheck10">Clear All History</label>
																</div>
															</form>
															<div class="privabtns">
																<a href="#">Clear All History</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="dropdown privacydropd">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sharing your profile when you click apply</a>
												<div class="dropdown-menu">
													<p>Chose if you want to share your full profile with the job poster when you're taken off linkedin after clicking apply </p>
													<div class="row">
														<div class="col-md-9 col-sm-12">
															<form class="radio-form">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label" for="customRadio5">Yes</label>
																</div>
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label" for="customRadio6">Yes</label>
																</div>
															</form>
														</div>
														<div class="col-md-3 col-sm-12">
															<p style="float: right;">Yes</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-12">
											<div class="privabtns">
												<a href="#">Save</a>
												<a href="#">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>


							








							<div class="tab-pane fade<?php echo $active10; ?>" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
								<div class="acc-setting">
									<h3>Deactivate Account</h3>
									<form>
										<div class="cp-field">
											<h5>Email</h5>
											<div class="cpp-fiel">
												<input type="text" name="email" placeholder="Email">
												<i class="fa fa-envelope"></i>
											</div>
										</div>
										<div class="cp-field">
											<h5>Password</h5>
											<div class="cpp-fiel">
												<input type="password" name="password" placeholder="Password">
												<i class="fa fa-lock"></i>
											</div>
										</div>
										<div class="cp-field">
											<h5>Please Explain Further</h5>
											<textarea></textarea>
										</div>
										<div class="cp-field">
											<div class="fgt-sec">
												<input type="checkbox" name="cc" id="c4">
												<label for="c4">
													<span></span>
												</label>
												<small>Email option out</small>
											</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id,</p>
										</div>
										<div class="save-stngs pd3">
											<ul>
												<li><button type="submit">Save Setting</button></li>
												<li><button type="submit">Restore Setting</button></li>
											</ul>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include_once "inc/footer.php";
	?>

	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
	<script type="text/javascript" src="lib/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	</body>

</html>