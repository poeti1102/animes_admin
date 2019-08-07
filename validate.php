<?php
    if ($_POST["key"] == "") {
        header("location: index.php");
    }

    $key = hash('adler32', $_POST["key"]);
    
    include('scripts/db.php');

    $sql = "SELECT * FROM `login`";
    $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute();
    $data = $sth->fetch();

    $syskey = $data['login_key'];
    if($key != $syskey){
        header("location: index.php");
    }else{
        session_start();
        $_SESSION['gm_7548_li'] = 'OmG_451-LLo3';
        header("location: admin.php");
    }

?>