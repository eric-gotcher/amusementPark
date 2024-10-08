<!-- Link to main stylesheet -->
<link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">

<nav class="navbar navbar-light bg-light justify-content-between">
  <a href="index.php" class="navbar-brand">
    <img src="images/logo.png" width="40" height="40" alt="logo">
  </a>
  <form class="form-inline search-bar" method="GET" action="index.php">
    <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Search" aria-label="Search"
      autocomplete="off" value="<?php if (isset ($_GET['keyword']))
        echo $_GET['keyword']; ?>">
    <i class="fa-solid fa-magnifying-glass"></i>
  </form>
</nav>

<script>
  const search_button = document.querySelector(".fa-magnifying-glass");
  const form = document.querySelector(".search-bar");
  search_button.addEventListener("click", () => {
    form.submit();
  });
</script>