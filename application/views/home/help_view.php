
     <div class="padB10">
         <?php						  
		foreach($chat as $item){												
		?>
         <div class="padB4">            
            <?php
			if($item['chat_type']==0){
			?>
            <a href="ymsgr:sendim?<?php echo $item['chat_nick'];?>"><img src="http://opi.yahoo.com/online?u=<?php echo $item['chat_nick'];?>&m=g&t=2" border="0"/></a>        	
            <?php
			}else{
			?>
            <a href="skype:<?php echo $item['chat_nick'];?>?chat"><img src="<?php echo base_url();?>public/home/images/iconskype.png" /></a>
            <?php
			}
			?>
         </div>
     	<div style="padding-bottom:10px;">        	
            <?php
			if($item['chat_type']==0){
			?>
            <a class="clorBlue" href="ymsgr:sendim?<?php echo $item['chat_nick'];?>"><strong><?php echo $item['chat_name'];?></strong></a>
            <?php
			}else{
			?>
            <a class="clorBlue" href="skype:<?php echo $item['chat_nick'];?>?chat"><strong><?php echo $item['chat_name'];?></strong></a>
            <?php
			}
			?>
        </div>
        <?php } ?>
     </div>
     
