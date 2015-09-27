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
                        PHOTOS
                        <small>Subheading</small>
                    </h1>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File Name</th>
                                <th>Size</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $photos = Photo::find_all();
                            foreach ($photos as $photo) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<img class='admin-photo-thumbnail'  src=" . $photo->get_picture_path() . ">";
                                    echo "<div class='pictures_link'>";
                                        echo "<a href='delete_photo.php?id={$photo->id}'>Delete</a>";
                                        echo "<a href='edit_photo.php?id={$photo->id}'>Edit</a>";
                                        echo "<a href='view_photo.php?id={$photo->id}'>View</a>";
                                    echo "</div>";
                                echo "</td>";
                                echo "<td>" . $photo->id . "</td>";
                                echo "<td>" . $photo->title . "</td>";
                                echo "<td>" . $photo->size . "</td>";
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