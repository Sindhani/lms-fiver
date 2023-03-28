<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $title = $_POST['announcement_title'];
        $body = $_POST['announcement_body'];
        $status = $_POST['status'];
        $sql = "INSERT INTO tbannouncements (announcement_title, annoucement_body, status) VALUES (:title, :body, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':body', $body, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Announcement created successfully";
            header('location: announcement.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location: announcement.php');
        }
    }
    ?>
<div class="container bg-image">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Add Announcement</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Announcement Info
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="announcement_title" autocomplete="off"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="announcement_body" rows="5"
                                      autocomplete="off"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="1" checked="checked">Active
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="0">Inactive
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="create" class="btn btn-info">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
