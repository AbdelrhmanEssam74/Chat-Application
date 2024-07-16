<?php global $page, $templates, $img, $database;
include 'init.php';
$page = 'profile';
require $database . 'chat_user.php';
// Create a new instance of the ChatUser class
$user_object = new ChatUser;
// $profile_img_path = str_replace("../", "", $user_object->getUserProfile()); // ar/images/img_name_with_userid.png
?>
<?php include $templates . 'header.php' ?>
<?php include $templates . 'navBar.php' ?>
<div class="container profile mt-4">
  <hr class="mt-0 mb-4">
  <div class="row">
    <div class="col-xl-4">
      <!-- Profile picture card-->
      <div class="card mb-4 mb-xl-0">
        <div class="card-header">Profile Picture</div>
        <div class="card-body text-center">
          <!-- Profile picture image-->
          <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
          <!-- Profile picture help block-->
          <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
          <!-- Profile picture upload button-->
          <button class="btn btn-primary" type="button">Upload new image</button>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <!-- Account details card-->
      <div class="card mb-4">
        <div class="card-header">Account Details</div>
        <div class="card-body">
          <form>
            <!-- Form Group (username)-->
            <div class="mb-3">
              <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
              <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
            </div>
            <!-- Form Group (email address)-->
            <div class="mb-3">
              <label class="small mb-1" for="inputEmailAddress">Email address</label>
              <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
            </div>
            <!-- Save changes button-->
            <button class="btn btn-primary float-end" type="button">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $templates . 'footer.php' ?>