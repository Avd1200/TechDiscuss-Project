<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Threadlist</title>
</head>

<body>
    <?php 
        include('partials/_dbconnect.php');
        include('partials/_header.php');
		
      ?>
    <?php
        $id = $_GET['cat_id'];
        $sql ="SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat_name = $row['category_name'];
            $cat_desc = $row['category_description'];
        }

      ?>

    <?php
       $showAlert = false;
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $title = str_replace("<","&lt;",$title);
            $title = str_replace(">","&gt;",$title);

            $desc = str_replace("<","&lt;",$desc);
            $desc = str_replace(">","&gt;",$desc);

          $sno = $_POST['sno'];
          $sql = "INSERT INTO `threads`(`thread_name`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title','$desc','$id','$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showAlert = true;
        }
          if($showAlert){
              echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success</strong> Your thread has been added! please wait for the community to respond.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $cat_name; ?> forums</h1>
            <p class="lead"><?php echo $cat_desc?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum.No Spam / Advertising / Self-promote in the forums is not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
 <?php

   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
        <h2 class="my-3">Start a Discussion</h2>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <div class="form-group">
                <label for="desc">Elaborate your concern</label>
                <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
   }
   else{
    echo '
    <div class="container">
      <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
    </div>
    ';
   }
 ?>
    
   <div class="container mb-5">
        <h2 class="my-3">Browse Questions</h2>
        <?php
            $id = $_GET['cat_id'];
            $sql ="SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $thread_name = $row['thread_name'];
                    $thread_desc = $row['thread_desc'];
                    $id = $row['thread_id'];
                    $thread_time = $row['timestamp'];
                    $thread_user_id= $row['thread_user_id'];
                    $sql2 = "SELECT email FROM `users` where Sno=$thread_user_id";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                
                    echo'<div class="media my-3">
                    <img src="user.png" width="50px" class="mr-3" alt="...">
                    <div class="media-body">
                        
                        <h5 class="mt-0"><a href="thread.php?thread_id='.$id.'">'.$thread_name.'</a></h5>
                        '.$thread_desc.'</div>'.'<div class="font-weight-bold my-0">Asked by: '.$row2['email'].' at '.$thread_time.'
                    </div>'.
                '</div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No threads found</h1>
                  <p class="lead"><b>Be the first person to ask a question</b></p>
                </div>
              </div>';
            }
       ?>
    </div>
    <?php include('partials/_footer.php');
     ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
</body>

</html>