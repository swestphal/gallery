<?php include("includes/header.php"); ?>
<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 2;
$items_total_count = Photo::count_all();

$pages = ceil($items_total_count / $items_per_page);

$paginate = new Pagination($page, $items_per_page, $items_total_count);

$query = "SELECT * FROM photos ";
$query .= " LIMIT {$items_per_page} ";
$query .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_this_query($query);

?>


<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php
            foreach ($photos as $photo):
                ?>

                <div class="col-xs-6 col-md-3">
                    <a href="<?php echo 'photo.php?id=' . $photo->id; ?>" class="thumbnail">
                        <img class="gallery_photo img-responsive"
                             src="<?php echo "admin/" . $photo->get_picture_path(); ?>" alt="">
                    </a>
                </div>


                <?php
            endforeach; ?>
        </div>
    </div>
    <div class="row">
        <?php
        if ($pages > 1) : ?>
            <div class="text-center">
                <nav>
                    <ul class="pager">
                        <li class="prev">
                            <?php if ($paginate->has_prev()) : ?>
                                <a class="pull-left" href="<?php echo 'index.php?page='.$paginate->prev();?>" aria-label="Previous">
                                    <span aria-hidden="true">Prev</span>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li class="next">
                            <?php if ($paginate->has_next()): ?>
                                <a class="pull-right" href="<?php echo 'index.php?page='.$paginate->next(); ?>" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <ul class="pagination">
                        <?php for ($index = 1; $index <= $pages; $index++) : ?>
                            <li <?php echo ($index==$page) ? 'class="active"' : null ;?>><a  href="<?php echo 'index.php?page=' . $index."\">"; echo $index; ?></a></li>
                        <?php endfor ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>
<!--    <!-- Blog Sidebar Widgets Column -->
<!--    <div class="col-md-4">-->
<!---->
<!---->
<!--        --><?php //include("includes/sidebar.php"); ?>
<!---->
<!---->
<!--    </div>-->
<!-- /.row -->

<?php include("includes/footer.php"); ?>
