<?php

/*  Write To File
/* ---------------------------------------------------------------------- */


 if (!function_exists('revija_connect_fs')) {
	function revija_connect_fs($url, $method, $context, $fields = null)
	{
	  global $wp_filesystem;
	  if(false === ($credentials = request_filesystem_credentials($url, $method, false, $context, $fields))) 
	  {
		return false;
	  }

	  //check if credentials are correct or not.
	  if(!WP_Filesystem($credentials)) 
	  {
		request_filesystem_credentials($url, $method, true, $context);
		return false;
	  }

	  return true;
	}
 }
 
 
if (!function_exists('revija_write_to_file')) {
	
	function revija_write_to_file($file, $text = '', $verify = true)
	{
	  global $wp_filesystem;

	  $url = wp_nonce_url("themes.php?page=revija", "filesystem-nonce");
	 

	  if(revija_connect_fs($url, "", $file))
	  {
		$dir = $wp_filesystem->find_folder($file);
		$file = trailingslashit($dir) . "revija.css";
		$wp_filesystem->put_contents($file, $text, FS_CHMOD_FILE);

		return true;
	  }
	  else
	  {
		return new WP_Error("filesystem_error", "Cannot initialize filesystem");
	  }
	}
	
}
 
 

/*  Create folder
/* ---------------------------------------------------------------------- */

 if (!function_exists('revija_backend_create_folder')) {
	 function revija_backend_create_folder(&$folder, $addindex = true) {
		 if (is_dir($folder) && $addindex == false) {
			 return true;
		 }
		 $created = wp_mkdir_p(trailingslashit($folder));
		 @chmod($folder, 0777);

		 if ($addindex == false) return $created;

		 $index_file = trailingslashit($folder) . 'index.php';
		 if (file_exists($index_file)) {
			 return $created;
		 }

		 
		 return $created;
	 }
 }



/*  Elements decode
/* ---------------------------------------------------------------------- */

if (!function_exists('revija_deep_decode')) {

	function revija_deep_decode($elements) {
		if (is_array($elements) || is_object($elements)) {
			foreach ($elements as $key=>$element) {
				$elements[$key] = revija_deep_decode($element);
			}
		} else {
			$elements = html_entity_decode($elements, ENT_COMPAT, get_bloginfo('charset'));
		}
		return $elements;
	}

}




/*  Get Option
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_custom_get_option')) {
	function mad_custom_get_option($key = false, $default = "") {
		global $revija_global_data;

		$result = $revija_global_data->options;

		if (is_array($key)) {
			$result = $result[$key[0]];
		} else {
			$result = $result['revija'];
		}

		if (isset($result[$key])) {
			$result = $result[$key];
		} else if ($key == false) {
			$result = $result;
		} else {
			$result = $default;
		}

		if ($result == "") { $result = $default; }
		return $result;
	}
}