<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        #maincontainer {
            min-height: 100vh;
        }
    </style>
    <title>TechDiscuss</title>
</head>

<body>
    <?php
    include('partials/_dbconnect.php');
    include('partials/_header.php');
    ?>


    <!--Search results-->
    <div class="container my-2.5" id="maincontainer">
        <h1 class="py-2">Search results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
        <?php
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH(`thread_name`,`thread_desc`) against ('$query')";
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $title = $row['thread_name'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?thread_id=$thread_id";
            //Display the result
            echo '<div class="result">
                <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                <p>' . $desc . '</p>
            </div>';
        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid">
                 <div class="container">
                 <p class="display-4">No Results Found</p>
                 <p class="lead">Suggestions:</p>
                 <ul>
                 <li>Make sure that all words are spelled correctly.</li>
                 <li>Try different keywords.</li>
                 <li>Try more general keywords.</li>
                 </ul>
                 </div>
                </div>';
        }
        ?>
    </div>

    <?php include('partials/_footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
</body>

</html>