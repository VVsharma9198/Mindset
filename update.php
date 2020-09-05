
<?php
            $servername = "localhost";
            $username = "sharma";
            $password = "sharma@9198";
            $dbname = "sharma";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if(!$conn){
                die("Failed to connect database" .mysqli_error($connection));
            }

            if(isset($_GET['edit-todo'])){
                $e_id = $_GET['edit-todo'];
            }

            if(isset($_POST['update'])){
                $edit_todo = $_POST['todo'];

                $queryi = "UPDATE todo SET t_name = '$edit_todo' WHERE t_id = $e_id";
                $run = mysqli_query($conn,$queryi);

                if($run){
                    header("Location:todo.php?updated");
                }else{
                    die("Fail");
                }

            }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TODO</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
        <script src="todo.js" type="text/javascript"></script>
        <link rel="stylesheet" href="stylee.css">
    </head>
    <body>
        <div>
            <div class="container">
                <div class="todo">
                    <h1>TODO Application</h1>
                    <form action="" method="POST">

                        <?php
                            $query = "SELECT * FROM todo WHERE t_id = $e_id";
                            $edit = mysqli_query($conn,$query);
                            $data = mysqli_fetch_array($edit);
                        ?>

                        <div class="input-area">
                            <input class="form-control" type="text" required name="todo" placeholder="" value="<?php echo $data['t_name']; ?>">
                            <input class="butt" value="Update" name="update" type="submit">
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </body>
</html>