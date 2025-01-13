<?php
require "config.php"; 

if (isset($_POST['submit'])) {
    if (empty($_POST['url'])) {
        echo "The input is empty.";
    }else {
        $url = $_POST['url'];
        $insert = $conn->prepare("INSERT INTO url (url) VALUES (:url)");
        $insert->execute([':url'=>$url]);
    }
}

$select = $conn->prepare("SELECT * FROM url");
$select->execute();
$rows = $select->fetchAll(pdo::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {overflow: hidden;}
            
            .margin {
                margin-top: 200px
            }
        </style>
    </head>
    <body>
        <div class="conatiner">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form class="card p-2 margin" method="post" action="index.php">
                        <div class="input-group">
                        <input type="text" name="url" class="form-control" placeholder="your url">
                            <div class="input-group-append">
                                <input type="submit" name="submit" class="btn btn-success" value="Shorten">
                            </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>

        <div class="conatiner">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                            <th scope="col">Long url</th>
                            <th scope="col">Short url</th>
                            <th scope="col">Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row): ?>
                            <tr>
                            <th scope="row"><?= $row->url ?></th>
                            <td> <a href="http://shorten.test/url?id=<?= $row->url_id ?>" target="_blank">http://shorten.test/<?= $row->url_id ?></a> </td>
                            <td><?= $row->clicks ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                 </div>
             </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
        <!-- Core theme JS-->
    </body>
</html>


   