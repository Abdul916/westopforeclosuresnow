<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'westopforeclosuresnow' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'cj,AelD=^6&oB9dH2Q<{0_j<!9l<l}qQ ;zFW->j6n9!W:HeeLuL%{G=gjL,qK,$' );
define( 'SECURE_AUTH_KEY',  'ZAr:IcME~+-t/H&+K?KN5a]p2=B,|+QZWtgF-TO-!~G|~G+ P6^vEIW#X<~uU>q}' );
define( 'LOGGED_IN_KEY',    '2A)u3i+3ujlKhrtiBtGJ0ZRz#,W=)=_IxD74#BbrF6!yyImZ*,|SMoGxT$)<dmln' );
define( 'NONCE_KEY',        '0CD<rj4iyu9);wn)jog&FE7O5!#`)^t.bFrM[s:5s:lghqbE6C@{oTmjU#,=i|%r' );
define( 'AUTH_SALT',        'O7_2mUc`]4 C3.ajc;EubBZ2woA*`>-/(_lc* FS+c[.hW=`e>1_#D+VYQNpoPe`' );
define( 'SECURE_AUTH_SALT', 'a ;ttrAUr:ky.+#gr@Mh-aO?CaI[[9wnE~:t0@b0yhw/rx2pS0KTCM =U[k3k7CB' );
define( 'LOGGED_IN_SALT',   'ahR8.*TdBD36eu#{/UO?xTxp$D9x-a!l0gYm7eGO@~Bu/}:gF)4,s3S]Q{2bLd_a' );
define( 'NONCE_SALT',       '_/zgU%BNF81eS=#ANoa![}LUzr($eG{gaGiyA2Mp31j0iwOO&EEoBo~+;rKe1)R1' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
