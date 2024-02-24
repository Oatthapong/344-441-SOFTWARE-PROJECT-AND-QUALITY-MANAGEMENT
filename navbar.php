<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #D9D9D9;">
  <div class="container">
    <a class="navbar-brand" href="index.php">หน้าหลัก</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav mr-auto flex-grow-1">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">หมวดหมู่</a>
          <div class="dropdown-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="categoryC.php">รายวิชาเลือก</a>
            <a class="dropdown-item" href="categoryF.php">รายวิชาเสรี</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-md-0 mr-3" method="POST" action="search.php">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="height: 2.5rem; background-color: #D9D9D9; border-radius: 1rem 0 0 1rem;"><i class="fas fa-search fa-sm"></i></span>
                </div>
                <input name="searchInput" class="form-control border-top border-dark" style="background-color: #D9D9D9; border-radius: 0 1rem 1rem 0;" type="text" placeholder="ค้นหา" aria-label="Search" oninput="search()">
            </div>
        </form>
      <ul class="navbar-nav flex-grow-1">
      </ul>
      <ul class="navbar-nav flex-grow-2">
        <li class="nav-item ml-3 my-auto h3">
          <a class="nav-link" href="profile.php">
            <i class="fas fa-user-circle"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
