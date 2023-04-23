<?php error_reporting(E_ERROR | E_WARNING | E_PARSE);?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
    <title>Register</title>
  </head>
  <body>
    <section class="login py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <img src="images/website/hands.jpeg" class="img-fluid" alt="Website Logo">
          </div>
          <div class="col-lg-7 text-center py-3">
            <h1>Register</h1>
            <form action="includes/signup.inc.php" method="post">
              <div class="form-row py-3 pt-5">
                <div class="offset-1 col-lg-10">
                <input type="text" class="inp" name="usersId" placeholder="Enter Username" required
                oninvalid="this.setCustomValidity('Enter User Name Here')"
                oninput="this.setCustomValidity('')">
                <p><?php $error = $_GET['error']; if($error == "usernametaken"){echo "User Name Taken";}?></p>
                </div>
              </div>
              <div class="form-row">
                <div class="offset-1 col-lg-10">
                <input type="password" class="inp" name="pwd" placeholder="Enter Password" required
                oninvalid="this.setCustomValidity('Enter Password Here')"
                oninput="this.setCustomValidity('')">
                <p><?php $error = $_GET['error']; if($error == "pwdnomatch"){echo "Passwords do not Match";}?></p>
                </div>
              </div>
              <div class="form-row py-3">
                <div class="offset-1 col-lg-10">
                <input type="password" class="inp" name="pwd_confirm" placeholder="Confirm Password" required
                oninvalid="this.setCustomValidity('Confirm Password Here')"
                oninput="this.setCustomValidity('')">
                <p><?php $error = $_GET['error']; if($error == "pwdnomatch"){echo "Passwords do not Match";}?></p>
                </div>
              </div>              
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
                  <button type="submit" name="submit" class="submit">Register</button>
                  <p><?php $error = $_GET['error']; if($error == "stmtfailed2"){echo "Error: Failed to Create User";}?></p>
                </div>
              </div>
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
                  <a href="Login.php">
                    Login 
                  </a>
                </div>
              </div>
            </form>     
          </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>