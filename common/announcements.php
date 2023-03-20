<?php
error_reporting(1);
include('includes/config.php');
$sql = "SELECT * FROM tbannouncements WHERE status = 1 ORDER BY id DESC";
$query = $dbh->prepare($sql);
$query->execute();
$announcements = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
    <h3 class="center-block"> Announcements</h3>
    <marquee behavior="scroll" direction="left" scrollamount="10" onmouseover="this.stop();" onmouseout="this.start();">
        <?php foreach ($announcements as $announcement) { ?>
            <strong><?= $announcement['announcement_title'] ?></strong>
        <?php } ?>
    </marquee>
</div>