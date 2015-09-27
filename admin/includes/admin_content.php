<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php


            $found_user=Photo::find_all();


                foreach($found_user as $user){
                 echo $user->filename;
                }
//
//            $found_user=User::find_user_by_id(2);
//            echo $found_user->username;
//
//            $found = User::verify_user("Marie","pfote");
//            if($found)echo ("Password correct");
//            if($found) {
//                $session->login($user_found);
////                redirect_to("index.php");
//            echo ($session->is_signed_in());
//            }



//            $users = new User();
//            $users->username="Bello";
//            $users->first_name = "Bellolino";
//            $users->last_name = "Müller";
//            $users->password = "knochen";
//            echo $users->save();
//           echo $users->username;

//$photos = Photo::find_all();
//foreach($photos as $photo) {
//echo $photo->title;
//}
//            $photo = new Photo();
//            $photo->title = "phototitel";
//            echo $photo->save();

            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
