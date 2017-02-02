<?php include('../includes/functions.php'); ?>
<?php
session_start();
if(isset($_SESSION['firstname'])) {
    include('../template/logged_in_header.php');
}
else {
    include('../template/header.php');
}
?>

    <style><?php include '../style.css'; ?></style>

<!--    <div class="modal fade" id="register-team" tabindex="-1" role="dialog">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <button type="button" class="close" data-dismiss="modal" area-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                    <h4 class="modal-title">Create Your Team!</h4>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form class="register-team" action="teampage.php" method="post">-->
<!--                        <div class="form-group row">-->
<!--                            <label for="team_name" class="register-label col-form-label col-sm-4">Team Name</label>-->
<!--                            <div class="col-sm-8">-->
<!--                                <input type="text" name="teamname" class="form-control" id="tname" placeholder="team name">-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group row">-->
<!--                            <label for="team_name" class="register-label col-form-label col-sm-4">Finish Date</label>-->
<!--                            <div class="col-sm-8">-->
<!--                                <div class="input-group finish-date">-->
<!--                                    <input type="text" id="datepicker" name="finish-date">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div class="form-group row">-->
<!--                            <label for="team-goal" class="register-label col-form-label col-sm-4">Mileage Goal</label>-->
<!--                            <div class="col-sm-8">-->
<!--                                <input type="text" name="miles-goal" class="form-control" id="miles-goal" placeholder="mileage goal">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <button type="submit" name="submit" id="datepicker" class="btn btn-primary team-register-submit center-block">Submit</button>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


    <div class="container team-page">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center"><?php echo $_SESSION['firstname'] . "&#39;s Team Page";  ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#register-team">Create Your Team!</button>
            </div>
        </div>
    </div>


<?php include('../template/footer.php'); ?>