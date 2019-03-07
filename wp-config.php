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
define( 'DB_NAME', 'studentloan_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=3l6Bk&5NmS!+klVa6vUIn U;5&sU7=yxk8fZLJA1bOyIquDQkMP4SnbEy9r-(d.' );
define( 'SECURE_AUTH_KEY',  'eU!9dY/|~#Mg&Y+wG|`R1;0`q~E6H`5L6BYw9jhDg.qu#7!-T,>1LAbRpiLr9^vc' );
define( 'LOGGED_IN_KEY',    'Zj$],:CV-16OiwGdv= n<{pT8JRqeI<vO#]9 ;<Q+>87+oZ#gGm25nJ4gX~SkU@h' );
define( 'NONCE_KEY',        '#DHF+n-o5%]P7Z8wLP|F^@b?u+;Ebgk#tmRj_d$&C[G8N7ZEbzJoDVQ$%qb/u4(}' );
define( 'AUTH_SALT',        'KO*kPYP5O(jkC,aHcKYPfE<)I).Q^9Vj,93 dZRX{K[dSUj46oiIopS![.Ub7H.N' );
define( 'SECURE_AUTH_SALT', 're]%G[}R2-ZN,z-wX!WuS9&5;vZ}h0 2,UR7cbdu8wO]6P#h;5p?pCxb&c^Sa|+i' );
define( 'LOGGED_IN_SALT',   'a|zbW=1hG&]%iTHZ/y!*#o)ro1S~018v3pyRPJMf#(|}UAq0V,QGj$4Yl8+-6Lm?' );
define( 'NONCE_SALT',       '5tiW[P0B8X~+95efh+=FhK+M 2Vi!2)mz`X~%ph8$~*[4[Jd,yew$hGXE/;Hdr+g' );

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
define( 'WP_MEMORY_LIMIT', '256M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
