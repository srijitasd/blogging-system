<?php include 'includes/header.php';
        require "../includes/dbh.inc.php"?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h2 class="page-header">
                             Admin Panel
                        </h2>
					<div class="col-sm-6">
						<form action="includes/categories.inc.php" method="post">
							<div class="form-group">
								<input type="text" name="cat_title" placeholder="Category Title" class="form-control">
							</div>
							<div class="form-group">
								<input type="submit" name="cat_submit" value="Add Category" class="btn btn-primary">
							</div>
						</form>

						</div>
               
						</div>
                <!-- /.row -->
            </div>
        </div>
        <div class="container table-container">
        <div class="col-sm-12 col-md-12">
                   <table class="table table-striped mx-auto">
                    <thead>
                        <th class="text-center">Category-Id</th>
                        <th class="text-center">Category-Title</th>
                        <th class="text-center">Operations</th>
                        </thead>
                            <tbody>
                        <?php
                            showCategory($conn);
                        ?>
                            </tbody>
                   </table>

            </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <div class="container-fluid">
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php

function showCategory($conn) {
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        ?>

        <tr>
        <td class="text-center"><?php echo $cat_id;?></td>
        <td class="text-center"><?php echo $cat_title;?></td>
        <td class="text-center"><a href="categories.php?cat_id=<?php echo $cat_id;?>"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php
    };
}

function deletecat($conn) {
    if (isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];
        $sql = "DELETE from categories WHERE cat_id = $cat_id";
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            header("location: categories.php?cat=error");
        } else {
            header("location: categories.php?cat=success");
        }
        
    }
}



deletecat($conn);



?>
