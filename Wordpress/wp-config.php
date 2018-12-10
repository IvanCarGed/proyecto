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
define('DB_NAME', 'carreira_wp693');

/** MySQL database username */
define('DB_USER', 'carreira_wp693');

/** MySQL database password */
define('DB_PASSWORD', 'APRf5QYTESqwzs2');

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
define('AUTH_KEY',         'jutyxgwaud59raniwvnbtqu3ulgnrzfxe70z7itqztb4zfh9gkuuora4nc7tukfe');
define('SECURE_AUTH_KEY',  't9qneanxtxdyaafzarkdfyz35u6eqz9odsfzb7mb6l9mr4f2gxwuitkfzc9yh0q8');
define('LOGGED_IN_KEY',    'fj26fsbqsakgfdwwjg5kewuwixwdf5faza4abn3bcla2nh3ktsciksx8pc1rlupg');
define('NONCE_KEY',        'dezdhigut4vp8yyvckn74k5o1mvu2hwob1nwwni672gyxetn4ipmjbqhe6gdy8ym');
define('AUTH_SALT',        'e61tcf9vohpxblhaichpqgk3d6efikvxhw26dm9uu83oaeruneug02pblbfrwmjg');
define('SECURE_AUTH_SALT', 'nndrlgvxqw5tudkifpmogck5di11c6e6vqlz6jpzke2jwqtrxvkg1e3juqoptoo3');
define('LOGGED_IN_SALT',   'afx4vybmwwk8ofjobtrxvvv2g8wn8ni1l0tubwgvpulrdyplt7f17xhbrixrauij');
define('NONCE_SALT',       'ytusre5fkb4ulnqh0fbkrmbcv6xwjzuxjxspgskuemwfghxwa2sgxwhqowecbaez');

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
