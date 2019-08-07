<?php
    session_start();
    error_reporting(~E_NOTICE && ~E_WARNING);
    if($_SESSION['gm_7548_li'] == "" || count($_SESSION["gm_7548_li"]) <= 0 ){
        if($_SESSION['gm_7548_li'] !== 'OmG_451-LLo3'){
            header("location: index.php");
        }
    }else{
        include('scripts/db.php');
        $seriesId = $_GET['seriesId'] == "" ? 0 : $_GET['seriesId'];

        $stmt = 'SELECT `id`,`name` FROM `series` GROUP BY `name`';
        $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $series_name = $sth->fetchAll();

        if(isset($_POST['add'])){
            $title = $_POST["title"];
            $seriesId = $_POST["series_name"];
            $server1_name = $_POST["server1_name"];
            $server1_link = $_POST["server1_link"];
            $server2_name = $_POST["server2_name"] == "" ? "" : $_POST["server2_name"] ;
            $server2_link = $_POST["server2_link"] == "" ? "" : $_POST["server2_link"] ;
            $server3_name = $_POST["server3_name"] == "" ? "" : $_POST["server3_name"] ;
            $server3_link = $_POST["server3_link"] == "" ? "" : $_POST["server3_link"] ;
            $server4_name = $_POST["server4_name"] == "" ? "" : $_POST["server4_name"] ;
            $server4_link = $_POST["server4_link"] == "" ? "" : $_POST["server4_link"] ;
            $server5_name = $_POST["server5_name"] == "" ? "" : $_POST["server5_name"] ;
            $server5_link = $_POST["server5_link"] == "" ? "" : $_POST["server5_link"] ;
            $server6_name = $_POST["server6_name"] == "" ? "" : $_POST["server6_name"] ;
            $server6_link = $_POST["server6_link"] == "" ? "" : $_POST["server6_link"] ;

            $stmt = "INSERT INTO `videos`(`series_id`, `title`, `server1_name`, `server1_link`, `server2_name`, `server2_link`, `server3_name`, `server3_link`, `server4_name`, `server4_link`, `server5_name`, `server5_link`, `server6_name`, `server6_link`)
                     VALUES (:series_id , :title , :server1_name , :server1_link , :server2_name , :server2_link , :server3_name , :server3_link , :server4_name , :server4_link , :server5_name , :server5_link , :server6_name , :server6_link)";
            $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':series_id' => $seriesId , ':title' => $title , 
                                ':server1_name' => $server1_name , ':server1_link' => $server1_link ,
                                ':server2_name' => $server2_name , ':server2_link' => $server2_link ,
                                ':server3_name' => $server3_name , ':server3_link' => $server3_link ,
                                ':server4_name' => $server4_name , ':server4_link' => $server4_link ,
                                ':server5_name' => $server5_name , ':server5_link' => $server5_link ,
                                ':server6_name' => $server6_name , ':server6_link' => $server6_link));
            
            $status = "New Video Added!";
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
                <li class="nav-item">
                    <a class="nav-link" href="#">News <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allseries.php">All Series </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="addvideo.php">Add Video </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addseries.php">Add Series </a>
                </li>
            </ul>
        </div>
    </nav>
    <?php if(strlen($status) > 0): ?>
        <div class="alert alert-success" role="alert">
            <strong><?=$status;?></strong>
        </div>
    <?php endif; ?>
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Series</label>
                <div class="col-sm-10">
                    <select class="form-control" name="series_name">
                        <?php foreach($series_name as $name): ?>
                        <option value="<?=$name['id'];?>" <?php if($name['id'] == $seriesId){echo "selected";} ?>><?=$name['name'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 1 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server1_name" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 1 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server1_link" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 2 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server2_name" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 2 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server2_link" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 3 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server3_name" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 3 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server3_link" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 4 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server4_name" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 4 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server4_link" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 5 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server5_name" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 5 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server5_link" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 6 Name</label>
                <div class="col-sm-10">
                    <input type="text" name="server6_name" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Server 6 Link</label>
                <div class="col-sm-10">
                    <input type="text" name="server6_link" class="form-control" >
                </div>
            </div>
            <button type="submit" name="add" class="btn btn-primary col-sm-5 offset-sm-1">Add</button>
            <a class="btn btn-primary col-sm-5" href="allseries.php" role="button">Back <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        </form>
    </div>
</body>
</html>