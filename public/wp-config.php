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
define( 'DB_NAME', 'drakefsi_db');

/** MySQL database username */
define( 'DB_USER', 'drakefsi_user');

/** MySQL database password */
define( 'DB_PASSWORD', 'Drake_161');

/** MySQL hostname */
define( 'DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3f07570d34c5c76aacedc188dd98ab9bedecf8f7');
define( 'SECURE_AUTH_KEY',  '0edb2c2279ba54ef400bd79fcdee3ff94f4100cd');
define( 'LOGGED_IN_KEY',    'f9b4b8a743e4c8262f010cbbc1a4ee89d683aed2');
define( 'NONCE_KEY',        '6ba4b5c5396caeb996b86b6845eb0cc70826fb81');
define( 'AUTH_SALT',        '01ff80db85d8c120ee63391d3229247b8b6dea71');
define( 'SECURE_AUTH_SALT', '5b9150bdd72d52c5242c200ebed46f2096571160');
define( 'LOGGED_IN_SALT',   'c4897ad0f02ec2798b6e5616037fd8d37217c7b1');
define( 'NONCE_SALT',       '0b67b89d7d05d38fa483adb8d8bb901bf1faad7c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
