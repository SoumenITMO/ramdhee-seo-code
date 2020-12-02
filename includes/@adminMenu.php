<?PHP
	$page = basename($_SERVER["PHP_SELF"]);
?>
<aside id="left-panel">
  <div class="login-info"> <span>
    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"> <img src="img/avatars/avatar.png" alt="me" class="online" /> <span> Administrator </span> </a> </span> </div>
  <nav>
    <ul>  
	  <li <?php if($page=='my_account.php') { echo ('class="active"');}?>> <a href="my_account.php"><i class="fa fa-lg fa-fw fa-home"></i>&nbsp;My Account</a></li>

	  <li <?php if(($page=='category.php') || ($page=='sub_category.php') || ($page=='sub_sub_category.php') || ($page=='add_product.php') || ($page=='product_list.php') || ($page=='edit_product.php') || ($page=='brand.php') || ($page=='product_csv.php')) { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Product</span></a>
        <ul>
          <li <?php if($page=='brand.php') { echo ('class="active"');}?>> <a href="brand.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Brand</a></li>
          <li <?php if($page=='category.php') { echo ('class="active"');}?>> <a href="category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Category</a></li>
          <li <?php if($page=='sub_category.php') { echo ('class="active"');}?>> <a href="sub_category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Sub Category</a></li>
          <li <?php if($page=='sub_sub_category.php') { echo ('class="active"');}?>> <a href="sub_sub_category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Sub Sub Category</a></li>
		  <!-- <li <?php if($page=='add_product.php') { echo ('class="active"');}?>> <a href="add_product.php"><i class="fa fa-lg fa-fw fa-deviantart"></i>&nbsp;Add Product</a></li> -->
		  <li <?php if(($page=='product_list.php') || ($page=='edit_product.php')) { echo ('class="active"');}?>> <a href="product_list.php"><i class="fa fa-lg fa-fw fa-sitemap"></i>&nbsp;Product List</a></li>
		  <li <?php if($page=='product_csv.php') { echo ('class="active"');}?>> <a href="product_csv.php"><i class="fa fa-lg fa-fw fa-file-excel-o"></i>&nbsp;Product CSV</a></li>
        </ul>
      </li>
	  <li <?php if(($page=='member.php') || ($page=='viewMember.php')) { echo ('class="active"');}?>> <a href="member.php"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Member</span></a></li>  
      <li <?php if($page=='order.php') { echo ('class="active"');}?>> <a href="order.php"><i class="fa fa-lg fa-fw fa-truck"></i>&nbsp;Order List</a></li>
      
	  <li <?php if(($_GET['PageID'] == '1') || ($_GET['PageID'] == '2') || ($_GET['PageID'] == '3') || ($_GET['PageID'] == '4') || ($_GET['PageID'] == '5') || ($_GET['PageID'] == '7')) { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Manage CMS</span></a>
        <ul>
          <li <?php if($_GET['PageID'] == '1') { echo ('class="active"');} ?>><a href="page.php?PageID=1">About Us</a></li>
          <li <?php if($_GET['PageID'] == '2') { echo ('class="active"');} ?>><a href="page.php?PageID=2">Delivery Information</a></li>
          <li <?php if($_GET['PageID'] == '3') { echo ('class="active"');} ?>><a href="page.php?PageID=3">Privacy Policy</a></li>
          <li <?php if($_GET['PageID'] == '4') { echo ('class="active"');} ?>><a href="page.php?PageID=4">Terms &amp; Conditions</a></li>
          <li <?php if($_GET['PageID'] == '5') { echo ('class="active"');} ?>><a href="page.php?PageID=5">Contact Us</a></li>
          <li <?php if($_GET['PageID'] == '7') { echo ('class="active"');} ?>><a href="page.php?PageID=7">Site Map</a></li>
        </ul>
      </li>
	  <li <?php if($_GET['maID'] == '8') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Email Template</span></a>
        <ul>
          <li <?php if($_GET['maID'] == '8') { echo ('class="active"');} ?>><a href="mail_content.php?maID=8">Registration</a></li>
        </ul>
      </li>
      <li <?php if($page=='coupon.php') { echo ('class="active"');}?>> <a href="coupon.php"><i class="fa fa-lg fa-fw fa-list"></i>Coupon Code</a></li>
      <li <?php if($page=='followUs.php') { echo ('class="active"');}?>> <a href="followUs.php"><i class="fa fa-lg fa-fw fa-share-alt"></i>Social Media</a></li>
	  <li <?php if($page=='contact_us.php') { echo ('class="active"');}?>> <a href="contact_us.php"><i class="fa fa-lg fa-fw fa-envelope"></i>Contact Us</a></li>
      <li <?php if($page=='link.php') { echo ('class="active"');}?>> <a href="link.php" title="Page Link"><i class="fa fa-lg fa-fw fa-link"></i>SEO Link</a></li>
    </ul>

  </nav>
</aside>