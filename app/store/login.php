<?php
include_once '../../resources/store/test.php';
include_once 'frontEnd/header.php';
include_once 'frontEnd/topNav.php';

echo "<body>
        <!-- Page Content -->
          <div class='container'>
            <header>
              <h1 class='text-center'>Login</h1>
                <div class='col-sm-4 col-sm-offset-5'>         
                  <form class='' action='' method='post' enctype='multipart/form-data'>
                    <div class='form-group'><label for=''>
                      username<input type='text' name='username' class='form-control'></label>
                    </div>
                    <div class='form-group'><label for='password'>
                      Password<input type='text' name='password' class='form-control'></label>
                    </div>

                    <div class='form-group'>
                      <input type='submit' name='submit' class='btn btn-primary' >
                    </div>
                  </form>
                </div>  
            </header>
          </div>
      </body>";
      
include_once 'frontEnd/footer.php';
?>
