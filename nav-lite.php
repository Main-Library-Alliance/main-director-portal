<div class="header"><img class="logo" src="/assets/logo.svg">
<nav>
        <ul>
        <?php if (isset($_SESSION['username'])):
        $username = $_SESSION['username'];
        $username = strtoupper($username);
        
        //echo $username;
         ?>

        
        <?php if ($username == "MAINTECH") { ?>
        <li>
            <a href="/admin/">Home</a>
        </li>
        <li><a href="/welcome/index.php">Reference Guide</a></li>
        <li>
            <a href="/view/index.php">IT/Technology Data</a>
        </li> 
        <li>
            <a href="/admin/tc/">Tech Contacts</a>
        </li>
        <li>
            <a href="/econtent/choose.php">eContent GP</a>
        </li>
        <?php
        } else {
            ?>
        <li>
            <a href="/portal/">Home</a>
        </li>
        <li>
            <a href="/welcome/generate-page.php?libraries=<?php echo $username ?>&generateText=Submit">Reference Guide</a>
        </li>
        <li>
            <a href="/view/view.php?lib=<?php echo $username ?>&view=Submit">IT/Technology Data</a>
        </li>
        <li><a href="/econtent/index.php?lib=<?php echo $username; ?>&view=Submit">eContent GP</a></li>
        <?php } ?>
        
        <?php endif?>
            <?php if (isset($_SESSION['username'])): ?>
        <li>
            <a href="/logout.php">Logout</a>
        </li>
            <?php else: ?>
            <a href="/login/">Log In</a>
            <?php endif?>
            
            </ul>
</nav>
</div>
