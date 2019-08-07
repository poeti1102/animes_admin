<?php
    session_start();
    if($_SESSION['gm_7548_li'] == "" || count($_SESSION["gm_7548_li"]) <= 0 ){
        if($_SESSION['gm_7548_li'] !== 'OmG_451-LLo3'){
            header("location: index.php");
        }
    }else{
        include('scripts/db.php');

        $seriesId = $_GET['seriesId'];
        $stmt = "SELECT * FROM `series` WHERE `id` = :seriesId";
        $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':seriesId' => $seriesId));
        $anime = $sth->fetch();

        $stmt = "SELECT * FROM `videos` WHERE `series_id` = :seriesId";
        $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':seriesId' => $seriesId));
        $episodes = $sth->fetchAll();


        $title = $anime['name'];
        $alternative_title = $anime['alternative_name'];
        $rating = $anime['rating'];
        $genres = explode(',',$anime['genres']);
        $desc = $anime['descriptions'];
        $image = $anime['image'];
        $favorite = $anime['favorite'];
        $ongoing = $anime['ongoing'];
        
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
                <li class="nav-item active">
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
        <div class="row">
            <div class="col-sm-4">
                <img class="card-img-top img-thumbnail img-fluid" src="<?php echo('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($title)).'/'.$image)?>">
            </div>
            <div class="col-sm-8">
                <h4><strong><?=$title;?></strong></h4>
                <p><b>Alternative title: </b><?=$alternative_title;?></p>
                <p><b>Rating: </b><?=$rating;?></p>
                <p><b>Gneres: </b> <?php foreach($genres as $genre){echo '<span class="badge badge-pill badge-warning">'.$genre.'</span> ';} ?></p>
                <p><b>Gneres: </b> <?php if($ongoing == 1){echo '<span class="badge badge-pill badge-success">Ongoing</span>';}else{echo '<span class="badge badge-pill badge-primary">Completed</span>';} ?></p>
                <p><b>Description: </b></p>
                <p><?=$desc;?></p>

                <a href="editseries.php?id=<?=$anime['id']?>"><button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                <a href="deleteseries.php?id=<?=$anime['id']?>"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            </div>
        </div>
        <hr>
        <div class="row">
            <h2 class="col-sm-4">Episodes</h2>
            <p class="col-sm-8"><a href="addvideo.php?seriesId=<?=$anime['id']?>"><button class="btn btn-success">Add New <i class="fa fa-plus" aria-hidden="true"></i></button></a></p>
            <br>

            <?php foreach($episodes as $episode): ?>
                <div class="col-sm-4 p-2">
                    <h5><?=$episode['title'];?></h5>
                </div>
                <div class="col-sm-2 p-2">
                    <a href="editvideo.php?id=<?=$episode['id']?>&seriesId=<?=$anime['id'];?>"><button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                    <a href="deletevideo.php?id=<?=$episode['id']?>&seriesId=<?=$anime['id'];?>"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                </div>
                <div class="col-sm-6 p-2">
                    <?php if($episode['server1_name'] != ""){echo '<a href="'.$episode['server1_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server1_name'].'</button></a>';}?>
                    <?php if($episode['server2_name'] != ""){echo '<a href="'.$episode['server2_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server2_name'].'</button></a>';}?>
                    <?php if($episode['server3_name'] != ""){echo '<a href="'.$episode['server3_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server3_name'].'</button></a>';}?>
                    <?php if($episode['server4_name'] != ""){echo '<a href="'.$episode['server4_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server4_name'].'</button></a>';}?>
                    <?php if($episode['server5_name'] != ""){echo '<a href="'.$episode['server5_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server5_name'].'</button></a>';}?>
                    <?php if($episode['server6_name'] != ""){echo '<a href="'.$episode['server6_link'].'" target="_blank"><button class="btn btn-warning">'.$episode['server6_name'].'</button></a>';}?>
                    
                </div>
            <?php endforeach; ?>
    </div>
</body>
</html>