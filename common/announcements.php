<?php
error_reporting(1);
include('includes/config.php');
$sql = "SELECT * FROM tbannouncements WHERE status = 1 ORDER BY id DESC";
$query = $dbh->prepare($sql);
$query->execute();
$announcements = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container bg-info">
    <h3 class="center-block text-center" style="font-weight: bold"> SEGI ANNOUNCEMENT BOARD</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>S#</th>
            <th>Current Announcements</th>
        </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?>
        <?php foreach ($announcements as $announcement) { ?>
            <tr>
                <td><?= $index++; ?></td>
                <td><?= $announcement['announcement_title'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>