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
    <title>TechDiscuss</title>
</head>

<body>
    <?php 
        include('partials/_dbconnect.php');
        include('partials/_header.php');
		
      ?>
    <?php
            $id = $_GET['thread_id'];
            $sql ="SELECT * FROM `threads` WHERE thread_id=$id";
            $result = mysqli_query($conn,$sql);
            $noresult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noresult = false;
                $title = $row['thread_name'];
                $desc = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT email FROM `users` where Sno=$thread_user_id";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $posted_by = $row2['email'];
            }
    ?>

      <?php
       $showAlert = false;
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $comment = $_POST['comment'];
            $comment = str_replace("<","&lt;",$comment);
            $comment = str_replace(">","&gt;",$comment);
            $sno = $_POST['sno'];
          $sql = "INSERT INTO `comment`(`comment_content`, `thread_id`, `commented_by`, `comment_time`) VALUES ('$comment','$id','$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showAlert = true;
        }
          if($showAlert){
              echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success</strong> Your comment has been added!.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
    ?>

    <div class="jumbotron container my-4">
        <h1 class="display-4"><?php echo $title; ?></h1>
        <p class="lead"><?php echo $desc; ?>
        </p>
        <hr class="my-4">
        <p>This is a peer to peer forum. Spam / Advertising / Self-promote in the forums is not allowed.
            Do not post copyright-infringing material.
            Do not post “offensive” posts, links or images.
            Do not cross post questions.
            Do not PM users asking for help.
            Remain respectful of other members at all times.</p>
        <p><strong>Posted by: <em><?php echo $posted_by; ?></em></strong></p>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
        echo '<div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">
                <label for="comment">Type your comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    }
    else{
        echo'
        <div class="container">
        <h1 class="py-2">Post a comment</h1>
        <p class="lead">You are not logged in. Please login to be able to comment.</p>
        </div>';
    }
    ?>
    
    
    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php
            $id = $_GET['thread_id'];
            $sql ="SELECT * FROM `comment` WHERE `thread_id`=$id";
            $result = mysqli_query($conn,$sql);
            $noresult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noresult = false;
                $id = $row['comment_id'];
                $comment = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_user_id= $row['commented_by'];
                $sql2 = "SELECT email FROM `users` where Sno=$thread_user_id";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '<div class="media my-3">
                <img src="user.png" width="54px" class="mr-3" alt="...">
                <div class=""media-body>
                <p class="font-weight-bold my-0">'.$row2['email'].' at '.$comment_time.'
                    </p>'
                .$comment.'
                </div>
                </div>';
            }
            if($noresult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4">No comments found.</p>
                <p class="lead">Be the first person to comment.</p>
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