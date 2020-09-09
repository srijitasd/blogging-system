<?php

require "../../includes/dbh.inc.php";

if (isset($_POST['cat_submit'])) {
    $cat_title = $_POST['cat_title'];
    if (empty($cat_title)) {
        header("location: ../categories.php?error=empty");
        exit();
    }
    else{
        $sql = "SELECT cat_title FROM categories WHERE cat_title=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../admin.php?error=sqlerror");
            exit();
        }

        else   {
            mysqli_stmt_bind_param($stmt, "s", $cat_title);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ( $resultCheck > 0) {
                header("location: ../categories.php?error=alreadySet");
                exit();

            }
            else {
                $sql = "INSERT INTO categories (cat_title) VALUES (?) ";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../categories.php?error=sqlerror");
                exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $cat_title);
                    mysqli_stmt_execute($stmt);
                    header("location: ../categories.php?error=success");
                    exit();
                }
            }
        }
    }
}

function showCategory() {
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        echo "<tr>";
        echo "<td>".$cat_id."</td>";
        echo "<td>".$cat_title."</td>";
        echo "</tr>";
    }
};

?>