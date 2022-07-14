
<div class="sidebar">
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
        <li><a href="/portal/overview/index.php">Library Overview</a></li>
        <li><a href="/portal/reference-guide/index.php">Reference Guide</a></li>
        <li>
            <a href="/admin/it/">IT/Tech</a>
        </li> 
        <li>
            <a href="/portal/econtent/index.php">eContent</a>
        </li>
        <li>
            <a href="/admin/ils/">ILS</a>
        </li>
        <?php
        } else {
            ?>
        <li>
            <a href="/portal/">Home</a>
        </li>
        <li>
            <a href="/portal/reference-guide/view.php?libraries=<?php echo $username ?>&generateText=Submit">Reference Guide</a>
        </li>
        <li>
            <a href="/portal/overview/view.php?lib=<?php echo $username ?>&view=Submit">Overview</a>
        </li>
        <li><a href="/portal/econtent/library.php?lib=<?php echo $username; ?>&view=Submit">eContent GP</a></li>
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

</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PTQ5LK2JMW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PTQ5LK2JMW');
</script>
