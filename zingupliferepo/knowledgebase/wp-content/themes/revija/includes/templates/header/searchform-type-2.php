<?php if (mad_custom_get_option('show_search')): ?>

<!--search form-->
 <div class="searchform_wrap ">
	<div class="vc_child h_inherit relative">
	  <?php get_search_form(); ?>
	  <button class="close_search_form">
		<i class="fa fa-times"></i>
	  </button>
	</div>
 </div><!--/ .searchform-wrap -->

<?php endif; ?>
