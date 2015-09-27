<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect_to("login.php");
}

if (empty($_GET['id'])) {
    redirect_to("users.php");
} else {
    $user = User::find_by_id($_GET['id']);
}


if (isset($_POST['update'])) {
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];

    if (empty($_FILES['user_image'])) {
        $user->save();
    } else {
        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();
    }
    redirect_to("edit_user.php?id=".$user->id );
}
?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include('includes/top_nav.php'); ?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php"); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        USERS
                        <small>Subheading</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            <img src="<?php echo $user->get_user_image(); ?>" class="admin-user-thumbnail">
                        </div>

                        <div class="col-md-6">


                            <div class="form form-group">
                                <input type="file" name="user_image" class="form-control">
                            </div>

                            <div class="form form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control"
                                       value="<?php echo $user->username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                       value="<?php echo $user->first_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                       value="<?php echo $user->last_name; ?>">

                            </div>
                            <div class="form form-group">
                                <label for="caption">Password</label>
                                <input type="password" name="password" class="form-control"
                                       value="<?php echo $user->password; ?>">

                            </div>
                            <div class="form form-group">
                            <a href="delete_user.php?id=<?php echo $user->id;?>" name="delete" class="btn btn-danger pull-left">Delete</a>
                                <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                            </div>

                        </div>


                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>