<!doctype html>
<html>
    <head>
        <style type="text/css">
 
            body {font-family:Arial, Sans-Serif;}
            #container {width:300px; margin:0 auto;}
            form label {display:inline-block; width:140px;}
            form input[type="text"],
            form input[type="password"],
            form input[type="email"] {width:160px;}
            form .line {clear:both;}
            form .line.submit {text-align:center;}
 
        </style>
    </head>
    <body>
        <div id="container">
            <form action="insert_signup.php" method="post">
                <h1>Sign Up To "Make A Difference"</h1>
                <div class="line">First Name : <input type="text" name="f_name" id="f_name" /></div> <br>
                <div class="line">Last Name : <input type="text" name="l_name" id="l_name" /></div> <br>
                <div class="line">Email : <input type="email" name="email" id="email" /></div><br>
                <div class="line">Password : <input type="password" name="pswd" id="pswd" /></div><br>
                <div class="line">Confirm Password : <input type="password" name="confirm_pswd" id="confirm_pswd" /></div><br>
                <div class="line">Mobile No.: <input type="text" name="mob" id="mob" /></div><br>
                <div class="line">Date of Birth : <input type="date" name="dob" id="dob" /></div><br>
                <div class="line">Address Line 1 : <input type="text" name="address_line1" id="address_line1" /></div><br>
				<div class="line">Address Line 2 : <input type="text" name="address_line2" id="address_line2" /></div><br>
                <div class="line">City : <input type="text" name="city" id="city" /></div><br>
                <div class="line">District : <input type="text" name="district" id="district" /></div><br>
                <div class="line">State : <input type="text" name="state" id="state" /></div><br>
                <div class="line">Pin Code : <input type="text" name="pin_code" id="pin_code" /></div><br>
                <div class="line submit"><input type="submit" value="Submit" /></div>
            </form>
        </div>
    </body>
</html>