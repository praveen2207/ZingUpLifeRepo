<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['clientId'] = '67751119427-ic6qb1fl9k3amhhuql54hfg6cnqdgr1s.apps.googleusercontent.com';
$config['clientSecret'] = 'Suihi9CoZBNx3EChXQEyAgkN';
$config['redirectUrl'] = 'http://'.$_SERVER['HTTP_HOST'].
		dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/google_login';


