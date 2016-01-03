<!DOCTYPE HTML>
<html>
<head>
<title>Login form and sign up</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div class="sign_up">

			<!----------start form----------- -->

			<form class="sign" action="insert_govt_signup.php" method="post">
				<div class="formtitle">Sign Up-It's free.</div>

				<!----------start top_section---------- -->
				
				<div class="top_section">
					<div class="section">
						<div class="input-sign details">
							<input type="text"  placeholder="Department Name" name="d_name" id="d_name" required/>
						</div>
						<div class="input-sign details">
							<input type="text"  placeholder="District Name" name="district" id="district" required/>
						</div>
					</div>
					<div class="clear"> </div>
				</div>

				<!----------end top_section---------- -->
				<!----------start personal Details----------->
				<!----------start bottom-section---------- -->

				<div class="bottom-section">
					<div class="title" style="text-align:center;">Department Details</div>

					<!----------start name section---------- -->

					<div class="section">
						<div class="input-sign details">
							<input type="email"  placeholder="Department Email" name="email" id="email" required/>
						</div>
						<div class="input password">
							<input type="password"  placeholder="Password" name="pswd" id="pswd" required/><span></span>
						</div>
						<div class="clear"> </div>
					</div>

					<!----------start mail section---------- -->

					<!----------start Address section---------- -->

					<div class="section">
						<div class="input-sign details">
							<input type="text"  placeholder="Contact Number" name="contact_no" id="contact_no" required/> 
						</div>
						<div class="input password">
							<input type="password"  placeholder="Confirm Password" name="confirm_pswd" id="confirm_pswd" required/><span></span>
						</div>
						<div class="clear"> </div>
					</div>

					<!----------start city section---------- -->

					<div class="section">
						<div class="input-sign details">
							<input type="text"  placeholder="City" name="city" id="city" required/> 
						</div>
						<div class="input-sign details1">
							<input type="text"  placeholder="District" name="district" id="district" required/> 
						</div>
						<div class="clear"> </div>
					</div>

					<div class="section">
						<div class="input-sign details">
							<input type="text" placeholder="State" name="state" id="state" required/> 
						</div>
						<div class="input-sign details1">
							<input type="text" placeholder="Pincode" name="pin_code" id="pin_code" required/>
						</div>
						<div class="clear"> </div>
					</div>

					<!----------start country section---------- -->

					<div class="submit">
						<input class="bluebutton submitbotton" type="submit" value="Sign up" />
					</div>
				</div>
				<!----------end bottom-section---------- -->
			</form>
			<!----------end form---------- -->
		</div>
		<!----------start copyright---------- -->
			<p class="copy_right">&#169; 2014 Template by<a href="iiits.ac.in" target="_blank">&nbsp;MaD Team</a> </p>
</body>
</html>