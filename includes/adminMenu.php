<?PHP
	$page = basename($_SERVER["PHP_SELF"]);
?>
<aside id="left-panel">
  <div class="login-info"> <span>
    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"> <img src="img/avatars/avatar.png" alt="me" class="online" /> <span> Administraator </span> </a> </span> </div>
  <nav>
    <ul>  
	  <li <?php if($page=='my_account.php') { echo ('class="active"');}?>> <a href="my_account.php"><i class="fa fa-lg fa-fw fa-home"></i>&nbsp;Minu konto</a></li>

	  <li <?php if(($page=='category.php') || ($page=='sub_category.php') || ($page=='sub_sub_category.php') || ($page=='add_product.php') || ($page=='product_list.php') || ($page=='edit_product.php') || ($page=='brand.php') || ($page=='product_csv.php')) { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Toode</span></a>
        <ul>
          <li <?php if($page=='brand.php') { echo ('class="active"');}?>> <a href="brand.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Bränd</a></li>
          <li <?php if($page=='category.php') { echo ('class="active"');}?>> <a href="category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Kategooria</a></li>
          <li <?php if($page=='sub_category.php') { echo ('class="active"');}?>> <a href="sub_category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Alamkategooria</a></li>
          <li <?php if($page=='sub_sub_category.php') { echo ('class="active"');}?>> <a href="sub_sub_category.php"><i class="fa fa-lg fa-fw fa-th-list"></i>&nbsp;Alam alamkategooria</a></li>
		  <!-- <li <?php if($page=='add_product.php') { echo ('class="active"');}?>> <a href="add_product.php"><i class="fa fa-lg fa-fw fa-deviantart"></i>&nbsp;Add Product</a></li> -->
		  <li <?php if(($page=='product_list.php') || ($page=='edit_product.php')) { echo ('class="active"');}?>> <a href="product_list.php"><i class="fa fa-lg fa-fw fa-sitemap"></i>&nbsp;Tootenimekiri</a></li>
		  <li <?php if($page=='product_csv.php') { echo ('class="active"');}?>> <a href="product_csv.php"><i class="fa fa-lg fa-fw fa-file-excel-o"></i>&nbsp;Toote CSV</a></li>
        </ul>
      </li>
	  <li <?php if(($page=='member.php') || ($page=='viewMember.php')) { echo ('class="active"');}?>> <a href="member.php"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Liige</span></a></li>  
      <li <?php if($page=='order.php') { echo ('class="active"');}?>> <a href="order.php"><i class="fa fa-lg fa-fw fa-truck"></i>&nbsp;Tellimuste loend</a></li>
      
	  <li <?php if(($_GET['PageID'] == '1') || ($_GET['PageID'] == '2') || ($_GET['PageID'] == '3') || ($_GET['PageID'] == '4') || ($_GET['PageID'] == '5') || ($_GET['PageID'] == '7')) { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Hallake CMS-i</span></a>
        <ul>
          <li <?php if($_GET['PageID'] == '1') { echo ('class="active"');} ?>><a href="page.php?PageID=1">Meist</a></li>
          <li <?php if($_GET['PageID'] == '2') { echo ('class="active"');} ?>><a href="page.php?PageID=2">Kättetoimetamise teave</a></li>
          <li <?php if($_GET['PageID'] == '3') { echo ('class="active"');} ?>><a href="page.php?PageID=3">Privaatsuspoliitika</a></li>
          <li <?php if($_GET['PageID'] == '4') { echo ('class="active"');} ?>><a href="page.php?PageID=4">
Tingimused & amp; Tingimused</a></li>
          <li <?php if($_GET['PageID'] == '5') { echo ('class="active"');} ?>><a href="page.php?PageID=5">Võta meiega ühendust</a></li>
          <li <?php if($_GET['PageID'] == '7') { echo ('class="active"');} ?>><a href="page.php?PageID=7">Saidi kaart</a></li>
		  <li <?php if($_GET['PageID'] == '7') { echo ('class="active"');} ?>><a href="page.php?PageID=9">Tellimismudel</a></li>
        </ul>
      </li>
	  <li <?php if($_GET['maID'] == '8') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">E-posti mall</span></a>
        <ul>
          <li <?php if($_GET['maID'] == '8') { echo ('class="active"');} ?>><a href="mail_content.php?maID=8">Registreerimine</a></li>
        </ul>
      </li>
      <li <?php if($page=='coupon.php') { echo ('class="active"');}?>> <a href="coupon.php"><i class="fa fa-lg fa-fw fa-list"></i>kupongi kood</a></li>
      <li <?php if($page=='followUs.php') { echo ('class="active"');}?>> <a href="followUs.php"><i class="fa fa-lg fa-fw fa-share-alt"></i>Sotsiaalmeedia</a></li>
	  <li <?php if($page=='contact_us.php') { echo ('class="active"');}?>> <a href="contact_us.php"><i class="fa fa-lg fa-fw fa-envelope"></i>Võta meiega ühendust</a></li>
      <li <?php if($page=='link.php') { echo ('class="active"');}?>> <a href="link.php" title="Page Link"><i class="fa fa-lg fa-fw fa-link"></i>SEO link</a></li>
	  <li <?php if($page=='banner.php') { echo ('class="active"');}?>> <a href="banner.php" title="Home Banner"><i class="fa fa-lg fa-fw fa-picture-o"></i>Kodubänner</a></li>
    </ul>

  </nav>
</aside>