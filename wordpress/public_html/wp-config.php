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
define('DB_NAME', 'lamearts_wp318');

/** MySQL database username */
define('DB_USER', 'lamearts_wp318');

/** MySQL database password */
define('DB_PASSWORD', ')Sv5)nF97P');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'mta1aswbgpslcn9a8wmvfypydrdphxtxs6zi3hhrwpjnslcf6qizxohmxsyuyylj');
define('SECURE_AUTH_KEY',  'upemexb7xums10gkw9evbgmftbl6bu8ownao3oqwpkw2eorcexv9vhbxfsok2ujd');
define('LOGGED_IN_KEY',    'ux9el1oeneozvln6lbpdrmrklp4zqcm0ddtvogaeb8xc9ib6yavfenlw6qqwb2p1');
define('NONCE_KEY',        's0w9xbxxyzpq2ih5jyy203s5i6gtzjyszsw6mcbootiexmeijsym0dxzaxjdcm5w');
define('AUTH_SALT',        'wfhrx9uuat80mgbgbsomr3mvnq09dv9c5k3hhuge2rlg4anbx9yxjjlzkvpmnj1g');
define('SECURE_AUTH_SALT', 'vvwp1eewqs3vrma5vmsbizxot5ghnhjvduhjd170aj3uqxk9g0n4yyrb58pei2cl');
define('LOGGED_IN_SALT',   '2o2f6cedxexmvlpehgkhprxle9s6i04qqihdhknx7qipayd6iigofycdeagxwjin');
define('NONCE_SALT',       'ylqi31sivbgmb6w6mvknfyhgxfugbmaqmytocebipcfdw7uj1eopxtkrodwbr3fa');

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
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
