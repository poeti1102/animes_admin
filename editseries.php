<?php
    session_start();
    error_reporting(~E_NOTICE && ~E_WARNING);
    if($_SESSION['gm_7548_li'] == "" || count($_SESSION["gm_7548_li"]) <= 0 ){
        if($_SESSION['gm_7548_li'] !== 'OmG_451-LLo3'){
            header("location: index.php");
        }
    }else{
        include('scripts/db.php');

        $seriesId = $_GET['id'];
        $stmt = "SELECT * FROM `series` WHERE `id` = :seriesId";
        $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':seriesId' => $seriesId));
        $anime = $sth->fetch();

        $title = $anime['name'];
        $alternative_title = $anime['alternative_name'];
        $rating = $anime['rating'];
        $genres = explode(',',$anime['genres']);
        $desc = $anime['descriptions'];
        $image = $anime['image'];
        $favorite = $anime['favorite'];
        $ongoing = $anime['ongoing'];
        
        if(isset($_POST['edit'])){
            $title = $_POST['title'];
            $alternative_title = $_POST['alternative_title'];
            $rating = $_POST['rating'];
            $genres = explode(',',$_POST['genre']);
            $desc = $_POST['desc'];
            $favorite = $_POST['favorite'];
            $ongoing = $_POST['ongoing'];
            if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])){
                $image_name = $anime['image'];
            }else{
                $image_name = $_FILES['image']['name'];
                $image =$_FILES['image']['tmp_name'];
            }

            if(!file_exists('animes/series/'.$title)){
                $stmt = "UPDATE `series` SET `name`=:title,`alternative_name`=:alternative_title,`rating`=:rating,`genres`=:genres,`descriptions`=:description,`image`=:image_name,`favorite`=:favorite,`ongoing`=:ongoing WHERE `id` = :id";
                $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':title' => $title , ':alternative_title' => $alternative_title , ':rating' => $rating , ':genres' => $_POST['genre'] , ':description' => $desc , ':image_name' => $image_name , ':favorite' => $favorite , ':ongoing' => $ongoing , ':id' => $seriesId));
                if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
                    if(file_exists("animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$anime['image'])){
                        unlink("animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$anime['image']);
                    }
                    move_uploaded_file($image,"animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$image_name);
                }
            }else{
                $stmt = "UPDATE `series` SET `name`=:title,`alternative_name`=:alternative_title,`rating`=:rating,`genres`=:genres,`descriptions`=:description,`image`=:image_name,`favorite`=:favorite,`ongoing`=:ongoing WHERE `id` = :id";
                $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':title' => $title , ':alternative_title' => $alternative_title , ':rating' => $rating , ':genres' => $_POST['genre'] , ':description' => $desc , ':image_name' => $image_name , ':favorite' => $favorite , ':ongoing' => $ongoing , ':id' => $seriesId));
                mkdir('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($title)));                
                if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
                    if(file_exists("animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$anime['image'])){
                        unlink("animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$anime['image']);
                    }
                    move_uploaded_file($image,"animes/series/".preg_replace('/[^A-Za-z0-9\-]/', '', trim($title))."/".$image_name);
                }
            }

            // Re-retrieve data from updated db
            $seriesId = $_GET['id'];
            $stmt = "SELECT * FROM `series` WHERE `id` = :seriesId";
            $sth = $db->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':seriesId' => $seriesId));
            $anime = $sth->fetch();

            $title = $anime['name'];
            $alternative_title = $anime['alternative_name'];
            $rating = $anime['rating'];
            $genres = explode(',',$anime['genres']);
            $desc = $anime['descriptions'];
            $image = $anime['image'];
            $favorite = $anime['favorite'];
            $ongoing = $anime['ongoing'];
            
            $status = "Updated!";
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
                <li class="nav-item active">
                    <a class="nav-link" href="addseries.php">Add Series </a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <?php if(strlen($status) > 0): ?>
        <div class="alert alert-success" role="alert">
            <strong><?=$status;?></strong>
        </div>
    <?php endif; ?>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                <img class="img-thumbnail img-fluid" width=300 height=300 src="<?php echo('animes/series/'.preg_replace('/[^A-Za-z0-9\-]/', '', trim($title)).'/'.$image)?>">
                    <input type="file" name="image" class="form-control-file">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" value="<?=$title;?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Alternative Title</label>
                <div class="col-sm-10">
                    <input type="text" name="alternative_title" class="form-control" value="<?=$alternative_title;?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="desc" rows="5" required><?=$desc;?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Rating</label>
                <div class="col-sm-10">
                    <input type="text" name="rating" class="form-control" value="<?=$rating;?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Genre</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="genre" rows="3" required><?=$anime['genres'];?></textarea>
                    Use comma "," to separate tags
                </div>
            </div>
            <fieldset class="form-group">
              <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Favorite Series</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="favorite" value="1" <?php if($favorite == 1){echo "checked";} ?>>
                    <label class="form-check-label">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="favorite" value="0" <?php if($favorite == 0){echo "checked";} ?>>
                    <label class="form-check-label">
                      No
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <fieldset class="form-group">
              <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Ongoing</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="ongoing" value="1" <?php if($ongoing == 1){echo "checked";} ?>>
                    <label class="form-check-label">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="ongoing" value="0" <?php if($ongoing == 0){echo "checked";} ?>>
                    <label class="form-check-label">
                      No
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <button type="submit" name="edit" class="btn btn-primary col-sm-5 offset-sm-1">Update</button>
            <a class="btn btn-primary col-sm-5" href="allseries.php" role="button">Back <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        </form>
    </div>
    <br><br><br>
</body>
</html>