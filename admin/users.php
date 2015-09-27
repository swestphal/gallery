<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect_to("login.php");
} ?>

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
                    </h1>
                    <a href="add_user.php" class="btn btn-primary">Add User</a>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $users = User::find_all();
                            foreach ($users as $user) {
                                echo "<tr>";
                                echo "<td>" . $user->id . "</td>";
                                echo "<td><img class='admin-user-thumbnail'  src=" . $user->get_user_image() . "></td>";
                                echo "<td>" . $user->username;
                                    echo "<div class='action_links'>";
                                        echo "<a href='delete_user.php?id={$user->id}'>Delete</a>";
                                        echo "<a href='edit_user.php?id={$user->id}'>Edit</a>";
                                    echo "</div>";
                                echo "</td>";
                                echo "<td>" . $user->first_name . "</td>";
                                echo "<td>" . $user->last_name . "</td>";
                                echo "</tr>";
                            }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>