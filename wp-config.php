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
define('DB_NAME', 'milk-seller');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '.');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'H1=?V}!r> ;B-eO&,u 5I[+y/B?.C>wd(_x<;UsG`~9XbIJ1n@7hRk[&$@FU;eN4');
define('SECURE_AUTH_KEY',  '/Xtg4T{k-a4m^K&wk2,B9NL6pzD-0qPs!jY<x@Q!0Z[*QCx1Q=i!.|zQjkVjhjK6');
define('LOGGED_IN_KEY',    'Fun)as[|@YAxfNu9 #}vo=R!Sl}j@l<}7,dt:QZQ*u%bI1lL/Pd~bMr*Y>0yLPu~');
define('NONCE_KEY',        '3Z>+>NTaXRmWqR2VQ${|Al<EJfs:f:;~y#:9z]!HRLGg_ g0/#]8Yc yd8JvfK]o');
define('AUTH_SALT',        '|a|ncLD<EkE ZN[dMpmyi(Wk&h/I#NzHj-{tXfCclK9h|):N(u[i6,M=V (az8$#');
define('SECURE_AUTH_SALT', 'o1S<s$puPdl3ed?NUOTZR7;hM%yd8!{7;ZDftSEZvTtL @lTxlQ[OLhJ4a==;:*,');
define('LOGGED_IN_SALT',   '6ul(Zo?&[HN#u8(#$z;#J{OTpFAgJCkM@ G*{}Q$..h 9F-TL$*|B~:0Vwc:Ga},');
define('NONCE_SALT',       'w6eb,#Dw^bE8pDYHP=q@%,3R4W9$+y:@N7b$~d{a+J&TG.tl!(]5WnnGA;ochc(c');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');