
<div class="sideBarContainer">
<input type="checkbox" id="check"></input>
    <label for="check">
      <i class="fa fa-bars" id="btn"></i>
      <i class="fa fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
			<img src="assets/images/LOGO.png">
		</span>
        <div class="navItem" onclick='openPage("search.php")'>
				<span role='link' tabindex='0'  class="navItemLink SearchBar">
					<p>Search</p>
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>

        <div class="navItem" onclick="openPage('browse.php')">
				<span role="link" tabindex="0"  class="navItemLink">Browse</span>
			</div>
			<div class="navItem" onclick="openPage('yourMusic.php')">
				<span role="link" tabindex="0"  class="navItemLink">Your Music</span>
			</div>
			<div class="navItem" onclick="openPage('settings.php')">
				<span role="link" tabindex="0"  class="navItemLink"><?php echo $_SESSION['user'] ?></span>
			</div>
		<div class="group">
			
		</div>
    </div>
</div>