<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'zingupli_demo');

/** MySQL database username */
define('DB_USER', 'zingupli_demo');

/** MySQL database password */
#define('DB_PASSWORD', 'zingup');
define('DB_PASSWORD', '@rfx#ZnS=(Dr');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sZ8wZEbDe:Q+_D!Wu|E$wIvowT01]%i+i&V>@c-k4G=^F([3JUGc9EJidX9.:h|K');
define('SECURE_AUTH_KEY',  '?PfMQ:h wa8BN`:Ca{ViW$/CBcClrm6B{|,.=GkS:=2W k.F5ha$;Q-nkwR/Z6I|');
define('LOGGED_IN_KEY',    '(zm}~8*aV`?#fAGB!fr;td2+B3?5@F3LNvzFM MNkq`:8|f1?O,M~{D48F}7ZWyV');
define('NONCE_KEY',        'i}9| `BLrDF|FS2eCWqvu.5S+@}x64+.-ms|Nn@_{@`{)=;b<|7byyngQb-Pcf:P');
define('AUTH_SALT',        'x|ZCC*6;xcz?S^MZu@=|Jc,JK-ByR& H9/a*[+zt55A0f.K:t0-GUY auF@,AYu-');
define('SECURE_AUTH_SALT', 'JSK?^DB$6dvz--TbL~p[ ,_~(|m%4LfCfn~SZ!dG|$:>s;aV8;XUzMks9j2B$R)=');
define('LOGGED_IN_SALT',   ']MJdWum71`FSJm-CdU]Wjg>=2Z2}:<K)!}[l(ee_u6gJm,vP|!tYOS|H{6fB&^ ,');
define('NONCE_SALT',       '_yT06Txjyag|,p-M!feMWzB53=]C8:Q5<vouwQZ-Xr19] 4%7XK={ N%|G4nJA55');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
