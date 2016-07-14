 <div class="header-banner">		
<a href="http://imgur.com/ILkEKuN"><img src="http://i.imgur.com/IqfERXO.png" title="Hosted by imgur.com" /></a>
</div>


<?php

if(of_get_option('banner_code')!=""){
echo '
      <div id="bnftr">
'.of_get_option('banner_code').'
      </div>';
} else {
echo '
      <div id="bnftr-none"></div>';
}

?>