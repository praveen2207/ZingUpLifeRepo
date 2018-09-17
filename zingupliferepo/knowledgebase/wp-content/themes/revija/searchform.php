<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<input type="text" autocomplete="off" name="s" id="s"  placeholder="<?php esc_attr_e( 'Type text and hit enter', 'revija' ) ?>"  value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" />
</form>
