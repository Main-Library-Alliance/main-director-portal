<!DOCTYPE html>
<html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>MAIN Portal</title>
        <link rel="stylesheet" href="../../assets/css/style.css">
        
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../header.php"; ?>
            <div class="flex">
                <div class="sidebar"> </div>
                <main>
                <form method="POST" action="forgot.php" name="reset">
                        <h1>Forgot Password</h1>
                        <p>This will seend a reset email to the <strong>dir-xxx@mainlib.org</strong> alias associated with your account.</p>
                        <div class="form-group">
                            <label><strong>Enter Your Username</strong></label><br>
                            <p style="font-size:small;">Hint: Your username is the abbreviation of your library ('ber').</p>
                            <input type="text" name="username" placeholder="username" />
                            <br><br>
                            
                        </div>

                    <input type="submit" class="btn-info" value="Reset"></button>
                </form>
        </div>
    </body>
</html>

