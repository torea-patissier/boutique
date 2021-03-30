<?php
require_once('../html_partials/header.php');
?>
<main>
<div class="img_produit">
<h1>Image produit</h1>
</div>
<description>
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit eius doloremque nisi odio consequatur pariatur non consequuntur aperiam quisquam 
quaerat quae reiciendis rem, ipsa temporibus sit! Consequatur accusamus explicabo veniam aliquam, tempora eum odio quam. Voluptas quaerat ut
 asperiores, nisi dignissimos officiis nam saepe sit, voluptates, temporibus aliquam possimus molestias.
</description>
<input type="text" value="Délais">
<input type="text" value="Prix">
<input type="text" value="Quantité">
<input type="text" value="Panier">
</main>
<!-- <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SY5AKB2FYPAYU">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form> -->

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="WLHLZHEKLWZWU">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>


<?php

require_once('../html_partials/footer.php');
?>