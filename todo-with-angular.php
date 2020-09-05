
<?php
            $servername = "localhost";
            $username = "sharma";
            $password = "sharma@9198";
            $dbname = "sharma";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if(!$conn){
                die("Failed to connect database" .mysqli_error($connection));
            }

            $query = "SELECT * FROM todo";
            $display = mysqli_query($conn, $query);

            if(isset($_POST['update'])){	
                $name = $_POST['todo'];
                $query = "INSERT INTO todo (t_name) VALUES('$name')";
            	if (mysqli_query($conn, $query)) {
                   header("Location:todo.php?todo-added");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

            if(isset($_GET['delete_todo'])){
                $delete_todo = $_GET['delete_todo'];
                $queryi = "DELETE FROM todo WHERE t_id = $delete_todo";
                if (mysqli_query($conn, $queryi)) {
                    header("Location:todo.php?todo-delete");
                 } else {
                     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
        <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="stylee.css">
        
    </head>
    <body  ng-app="sa_delete" ng-controller="controller" ng-init="show_data()">
        <div>
            <div class="container">
                <div class="todo">
                    <h1>TODO Application</h1>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


                        <div class="input-area">
                            <input class="form-control" type="text" ng-model="todoinput" required name="todo" placeholder="Enter">
                            <input class="butt" value="ADD" name="update" type="submit">
                        </div>
                    </form>
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($display)){
                                    $t_id = $row['t_id'];
                                    $t_name = $row['t_name'];
                            ?>

                            <tr ng-repeat="x in names">
                                <td><?php echo $t_id ?></td>
                                <td><?php echo $t_name ?></td>
                                <td><a href="update.php?edit-todo=<?php echo $t_id ?>" class="butt" (click)="toggleloading">Edit</a></td>
                                <td><button class="btn btn-danger" ng-click="delete_data(x.id)" >Remove</button></td>
                            </tr>

                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <script>
            var app = angular.module("sa_delete", []);
            app.controller("controller", function($scope, $http){
                $scope.show_data = function(){
                    $http.get("<?php echo $result ?>")
                    .success(function(data){
                        $scope.names = data;
                    });
                }
                $scope.delete_data = function(id){
                    if (confirm("sure")){
                        $http.post("<?php echo $queryi ?>", {
                            'id' = id
                        })
                        .success(function(data){
                            alert(data);
                            $scope.show_data();
                        });
                    }else{
                        return false;
                    }
                }
            });
        </script>
    </body>
</html>