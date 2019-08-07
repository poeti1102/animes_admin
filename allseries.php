<?php
    session_start();
    if($_SESSION['gm_7548_li'] == "" || count($_SESSION["gm_7548_li"]) <= 0 ){
        if($_SESSION['gm_7548_li'] !== 'OmG_451-LLo3'){
            header("location: index.php");
        }
    }else{
        include('scripts/db.php');
        $stmt = "SELECT * FROM `series`";
        $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $data = $sth->fetchAll();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

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
            <?php foreach($data as $series): ?>
            <?php
                $title = $series['name'];
                $alternative_title = $series['alternative_name'];
                $rating = $series['rating'];
                $genres = explode(',',$series['genres']);
                $desc = $series['descriptions'];
                $image = $series['image'];
                $favorite = $series['favorite'];
                $ongoing = $series['ongoing'];
            ?>
                <div class="col-sm-3 p-4">
                    <div class="card">
                        <img class="card-img-top img-thumbnail img-fluid" src="<?php echo('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($title)).'/'.$image)?>">
                        <div class="card-body">
                            <h6 class="card-title"><?=$title;?></h6>
                            <a href="anime.php?seriesId=<?php echo $series['id']; ?>" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>`
        </div>
    </div>
</body>
</html>