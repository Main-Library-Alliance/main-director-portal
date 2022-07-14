<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library Portal Login</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
        <div class="portalContainer">
            
            <?php include "../header.php"; ?>
            <div class="flex">
                <div class="sidebar"> </div>
            <main>
            <form method="post" action="login.php">
                <h1>MAIN Portal Login</h1>
                <div>
                    <input type="text" class="textbox" id="username" name="username" placeholder="Username" />
                </div>
                <div>
                    <input type="password" class="textbox" id="password" name="password" placeholder="Password" />
                </div>
                <p><a href="../login/forgot-password/">Forgot password?</a></p>
                <div>
                    <input type="submit" value="Log In" name="but_submit" id="but_submit" />
                </div>
            </form>
        </div>
    </body>
</html>