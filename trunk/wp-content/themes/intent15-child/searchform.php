<form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div width='30px'>
		<ul id="header-social" style="width:300px">
		<li><input type="text" id="s" name="s" onblur="if(this.value=='')this.value='<?php _e('Enter your search...','intent'); ?>';" 
		onfocus="if(this.value=='<?php _e('Enter your search...','intent'); ?>')this.value='';" value="<?php _e('Enter your search...','intent'); ?>" />
		</li>
		<?php 
		$ul = preg_replace('<<ul id="header-social">>', '', wpb_social_media_links(array('id'=>'header-social')));
    	$ul = preg_replace('<</ul>>', '', $ul);
		echo $ul; 
		?>
		</ul>
	</div>
</form>