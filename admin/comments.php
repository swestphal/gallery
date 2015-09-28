<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect_to("login.php");
}
    $comments = Comment::find_all();
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
                        COMMENTS
                    </h1>

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Body</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($comments as $comment) {
                                echo "<tr>";
                                echo "<td>" . $comment->id . "</td>";
//                                echo "<td><img class='admin-user-thumbnail'  src=" . $user->get_user_image() . "></td>";
                                echo "<td>" . $comment->author;
                                echo "<div class='action_links'>";
                                echo "<a href='delete_comment.php?id={$comment->id}'>Delete</a>";
                                echo "<a href='edit_comment.php?id={$comment->id}'>Edit</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "<td>" . $comment->body . "</td>";
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