<div class="header"><a href="/portal/"><img class="logo" src="/assets/logo.svg"></a>
<nav>
    <ul>
        <?php if (isset($_SESSION['username'])): ?>
        <li>
            <a href="/portal/">Home</a>
            <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">Open a Ticket</a>
            <a href="/logout.php">Logout</a>
        </li>
            <?php else: ?>
            <a href="/login/">Log In</a>
            <?php endif?>
            
            </ul>

</nav></div>
