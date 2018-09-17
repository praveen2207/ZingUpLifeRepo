<?php 
function getVideoThumbUrl ($url) {
	if (!is_string($url) || empty($url)) return false;

	$url = str_replace("&amp;", "&", $url);
	$arr = parse_url($url);
	$arr['host'] = str_replace('www.', '', $arr['host']);

	switch ($arr['host']) {
		case 'rutube.ru':
			if (preg_match("/\/tracks\/(.+)\.html/i", $arr['path'], $matches)) {
				$xml = simplexml_load_file("http://rutube.ru/cgi-bin/xmlapi.cgi?rt_mode=movie&rt_movie_id=".$matches[1]."&utf=1");
				if ($xml) {
					$url = (string) $xml->response->movie->thumbnailLink;
				}
			}
			break;

		case 'video.rutube.ru':
			if (preg_match("/\/(.+)/i", $arr['path'], $matches)) {
				$s[0] = substr($arr['path'], 1, 2);
				$s[1] = substr($arr['path'], 3, 2);
				$url = "http://tub.rutube.ru/thumbs/".$s[0]."/".$s[1]."/".$matches[1]."-1-1.jpg";
			}
			break;
		
		case 'youtu.be':
			if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches)) {
				$url = "http://img.youtube.com/vi/".$matches[0]."/0.jpg";
			}
			break;

		case 'youtube.com':
			if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtube/)[^&\n]+#", $url, $matches)) {
				$url = "http://img.youtube.com/vi/".$matches[0]."/0.jpg";
			}
			break;

		case 'player.vimeo.com':
			preg_match('/(\d+)/', $url, $matches);
			$xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$matches[0].'.xml');
			if ($xml) {
				$url = (string) $xml->video->thumbnail_medium;
			}
			break;

		case 'vimeo.com':
			preg_match('/(\d+)/', $url, $matches);
			$xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$matches[0].'.xml');
			if ($xml) {
				$url = (string) $xml->video->thumbnail_medium;
			}
			break;

		default:
			$url = "";
			break;
	}
	return $url;
}






