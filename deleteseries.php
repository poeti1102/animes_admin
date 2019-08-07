<?php
    session_start();
    if($_SESSION['gm_7548_li'] == "" || count($_SESSION["gm_7548_li"]) <= 0 ){
        if($_SESSION['gm_7548_li'] !== 'OmG_451-LLo3'){
            header("location: index.php");
        }
    }else{
        include('scripts/db.php');
        
        $series_id = $_GET['id'] == "" ? 0 : $_GET['id'];

        $stmt = 'SELECT * FROM `series` WHERE `id` = :series_id';
        $sth = $db->prepare($stmt , array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':series_id' => $series_id));
        $series = $sth->fetch();
        $image = $series['image'];

        if(isset($_POST['delete'])){
            // Delete All Video From Series
            $stmt = "DELETE FROM `videos` WHERE `series_id` = :seriedId";
            $sth = $db->prepare($stmt , array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':seriedId' => $series_id));
            unlink('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($series['name'])));

            // Delete Series
            $stmt = 'DELETE FROM `series` WHERE `id` = :id';
            $sth = $db->prepare($stmt , array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id' => $series_id));

            $stmt = 'SELECT * FROM `series` WHERE `id` = :series_id';
            $sth = $db->prepare($stmt , array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':series_id' => $series_id));
            $series = $sth->fetch();
            $image = $series['image'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#" class="header">ANIMES</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">News <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allseries.php">All Series </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addvideo.php">Add Video </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addseries.php">Add Series </a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group row">
                <label class="col-sm-6 col-form-label text-center">Delete This Series?</label>
                <div class="col-sm-6 text-left">
                    <strong><?=$series['name'];?></strong>
                    <img class="img-thumbnail img-fluid" width=200 height=200 src="<?php echo('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($series['name'])).'/'.$image)?>">
                </div>
            </div>
            <button type="submit" name="delete" class="btn btn-danger col-sm-5 offset-sm-1">Delete</button>
            <a class="btn btn-primary col-sm-5" href="javascript:history.back()" role="button">Back <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        </form>
    </div>
</body>
</html>