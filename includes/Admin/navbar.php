<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-3">
    <div class="container">
      <a href="blog.php" class="navbar-brand">ONLINELEARNAL</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"><span
          class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="dashboard.php" class="nav-link ">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="posts.php" class="nav-link">Posts</a>
          </li>
           <li class="nav-item px-2">
            <a href="categories.php" class="nav-link">C / S</a>
          </li>
         <!--   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          C/S
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="categories.php">Categories</a>
                    <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="subjects.php">Subjects</a>
        </div>
      </li> -->
          <li class="nav-item px-2">
            <a href="admin.php" class="nav-link">Users</a>
          </li>
          <li class="nav-item px-2">
            <a href="comments.php" class="nav-link">Comments</a>
          </li>
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-user"></i> Welcome <?php echo $_SESSION["UserName"];?>
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item text-success">
                <i class="fas fa-user-circle"></i> Profile
              </a>
              <a href="#" class="dropdown-item">
                <i class="fas fa-cog"></i> Manage Admin
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger">
              <i class="fas fa-user-times"></i> Logout
            </a>
          </li>
          
        </ul>

        <!--<ul class="navbar-nav ml-auto">-->
          
        <!--</ul>-->
      </div>
    </div>
  </nav>