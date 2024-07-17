<?php global $templates, $img, $database;
include 'init.php';
$page = 'profile';
require $database . 'chat_user.php';
$username = $_SESSION['user']['user_name'];
$email = $_SESSION['user']['user_email'];
// $profile_img_path = str_replace("../", "", $user_object->getUserProfile()); // ar/images/img_name_with_userid.png
?>
<?php include $templates . 'header.php' ?>
<?php include $templates . 'navBar.php' ?>
    <div class="notifications"></div>
    <div class="container profile mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="updateData.php" method="post" id="updateForm">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to
                                    other users on the site)</label>
                                <input class="form-control" id="inputUsername" type="text"
                                       placeholder="Enter your username" value="<?php echo $username ?>">
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                       placeholder="Enter your email address" value="<?php echo $email?>">
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary float-end" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include $templates . 'footer.php' ?>