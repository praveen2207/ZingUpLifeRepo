
<form method="get" class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>"  >
	<input type="text" autocomplete="off" name="s" id="s"  placeholder="<?php esc_attr_e( 'Search', 'revija' ) ?>"  value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" >
	<button class=""><i class="fa fa-search"></i></button>
</form>
