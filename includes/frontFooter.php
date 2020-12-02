<?PHP	
	$followUs = $general_cls_call->select_query("*", SOCIAL_MEDIA, "WHERE id=:id", array(':id'=>1), 1);
	if(isset($_POST['btnNewsletter']))
	{
		extract($_POST);
		$field = "email, date";
		$value = ":email, :date";
		$addExecute=array(
			':email'	=>$general_cls_call->specialhtmlremover($txtNemail),
			':date'		=>date('F j, Y')
		);
		$general_cls_call->insert_query(NEWSLETTER, $field, $value, $addExecute);
		$sucNeMsg = 'Your request send successfully.';
	}
?>
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <img class="img-responsive" src="<?PHP echo DOMAIN_NAME; ?>image/logo5.jpg" title="" alt="" width="100" height="200" />
			<p>Autoriõigused &copy; ramadhee.ee <?PHP echo date('Y'); ?>.<br> Kõik õigused kaitstud.</p>
			<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
          </div>
          
          

          
          
          <div class="column col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5>Toiduallergiad</h5>
            <ul>
			<li><a href="<?PHP echo DOMAIN_NAME.'seo/'.'food_allergies.php'; ?>">Toiduallergiad</a></li>
			  </ul>
			
            <h5>Teave</h5>
            <ul>
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(16); ?>">About Us</a></li> -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'.'about.php'; ?>">Umbes Meist</a></li>
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(17); ?>">Delivery Information</a></li>  -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'.'delivery_information.php'; ?>">Kättetoimetamise teave</a></li>  
			  
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(18); ?>">Privacy Policy</a></li> -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'."privacy-policy.php"?>">Privaatsuspoliitika</a></li>
			  
			  
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(19); ?>">Terms &amp; Conditions</a></li> -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'."terms_conditions.php" ?>">Kasutustingimused</a></li>
			  
			  <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(19); ?>">Terms &amp; Conditions</a></li> -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'."subscription.php" ?>">Tellimismudel</a></li>
			  			 
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(26); ?>">Return Policy</a></li> -->
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'."return.php" ?>">Naaseb Tagasimaksed ja tühistamised</a></li>
			  
			  
            </ul>
          </div>
          <div class="column col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <h5>KASUTAJATUGI</h5>
            <ul>
              <!-- <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(4); ?>">Contact Us</a></li> -->
			  
			  <li><a href="<?PHP echo DOMAIN_NAME.'seo/'.'contact_us.php'; ?>">Võta meiega ühendust</a></li>
			  
              <!--<li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(20); ?>">Site Map</a></li>-->
              
              <li>
			    <div class="social pull-left flip"> 
				<a href="javascript:void(0)" target="_blank"><img data-toggle="tooltip" src="<?PHP echo DOMAIN_NAME; ?>image/socialicons/facebook.png" alt="Facebook" title="Facebook"></a>
				<a href="<?PHP echo $followUs->twitter; ?>" target="_blank"><img data-toggle="tooltip" src="<?PHP echo DOMAIN_NAME; ?>image/socialicons/twitter.png" alt="Twitter" title="Twitter"></a>
				<a href="<?PHP echo $followUs->google_plus; ?>" target="_blank"><img data-toggle="tooltip" src="<?PHP echo DOMAIN_NAME; ?>image/socialicons/google_plus.png" alt="Google+" title="Google+"></a>
				<a href="<?PHP echo $followUs->linkedin; ?>" target="_blank"><img data-toggle="tooltip" src="<?PHP echo DOMAIN_NAME; ?>image/socialicons/linkedin.png" alt="Linkedin" title="Pinterest"></a>
				</div>
			  </li>
			  
            </ul>
            
       
          </div>
		  <form name="nfrm" method="post" action="">
          <div class="column col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <h5>Infoleht</h5>
		<?PHP
			if(isset($sucNeMsg) && $sucNeMsg != '')
			{
		?>
			<div class="alert alert-success fade in">
			  <button class="close" data-dismiss="alert">X</button><i class="fa-fw fa fa-check"></i><strong>Edu</strong><br /><ul><?PHP echo $sucNeMsg; ?></ul> 
			</div>
		<?PHP
			}
		?>
            <div class="form-group">
              <label class="control-label" for="Telli">Registreeruge, et saada värskeimaid uudiseid ja värskendusi.</label>
              <input type="email" required placeholder="E-posti aadress" name="txtNemail" class="form-control">
            </div>
            <input type="submit" name="btnNewsletter" value="Telli" class="btn btn-primary"> </br>
			<div>
				<img src="https://ramadhee.ee/logo-white-ziticity.png" alt="Ziticitys" width="120" height="50">
			</div>
			<div>
				<img src="https://ramadhee.ee/Mastercard_logo.jpg" alt="Visa and Master Card" width="50" height="35">
				<img src="https://ramadhee.ee/visa_logo.jpg" alt="Visa and Master Card" width="50" height="35">
				
			</div>
          </div>
		  </form>
        </div>
      </div>
    </div>
    <div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>

  <script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>
<!--Start of Zendesk Chat Script-->
<script src="//code.tidio.co/io9bqbjypjdho2irasbwpsj5bjm8bzmn.js" async></script>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?66VgCRij066lDcxZZfj7AvrS5ypA2Ozc";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
 <!--End of Zendesk Chat Script-->
