<?php
session_start();
error_reporting(1);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $title = $_POST['announcement_title'];
        $body = $_POST['announcement_body'];
        $announcementId = intval($_GET['announcement_id']);
        $sql = "update  tbannouncements set announcement_title=:title,annoucement_body=:body,status=:status where id=:announcement_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':body', $body, PDO::PARAM_STR);
        $query->bindParam(':status', $author, PDO::PARAM_STR);
        $query->bindParam(':announcement_id', $announcementId, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Announcement updated successfully');</script>";
        echo "<script>window.location.href='announcement.php'</script>";


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>SEGI LMS | Edit Announcement</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    </head>
    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Update Announcement</h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Announcement Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $announcementId = intval($_GET['announcement_id']);
                                $sql = "SELECT announcement_title,annoucement_body,status, created_at from  tbannouncements where id=:announcement_id";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':announcement_id', $announcementId, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="announcement_title"
                                                       value="<?php echo htmlentities($result->announcement_title); ?>"
                                                       required/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Body<span style="color:red;">*</span></label>
                                                <textarea class="form-control" type="text" name="announcement_body"
                                                          ><?php echo htmlentities($result->annoucement_body); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="checkbox" type="text" name="status"
                                                       value="<?php echo htmlentities($result->status); ?>"
                                                />
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                                <div class="col-md-12">
                                    <button type="submit" name="update" class="btn btn-info">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>
