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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\wamp64\www\studentloan-v2\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'test_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'OaX$-* A}MDFJf)mIgt`?`1=NzDfn@}bX}rTTU*X~hjXt>(lw7RS<Qb(WJ~t=5wf' );
define( 'SECURE_AUTH_KEY',  'YlyzI|I:avKh$*J#dYj[Ek&u@e H:PC[@%>oWx`W&fyC?ysH;LoyVx]b*04~|l5_' );
define( 'LOGGED_IN_KEY',    'e:F*zh0Es[o(p6KP!7T3Cg2aZemBO=; a2uwddmI`<EN*,L|}jmyib-Q%!:R]As8' );
define( 'NONCE_KEY',        'U GMDExBO7.y51Jrs$DwbXHsOOn9Z)J/Th]-pvw.a@/R^{BvWH}xEzyJl1.S$zA3' );
define( 'AUTH_SALT',        '&E*dF@hXB8o3`3tT+:@X.4kI1D:`.S@E{IlFb9#Msj&(j<S/-Z<=?+X8e<l.ltqt' );
define( 'SECURE_AUTH_SALT', 'ldH<f/uz5z%S1~Tjy!?]0lL>87Lae9]P4Ja?=QT2^pBYcLi##cH-)*)1u`#qTfP[' );
define( 'LOGGED_IN_SALT',   'g||*=7r=hCl9o_ 4k46]f2O{%7m-&iS7}.@QJ+W O&iFugRUCVFtnERX>0=^.4:e' );
define( 'NONCE_SALT',       'gKQf3AD@!qlGYe; <c4Q 6>8;4q<xp-V2bl]Hpcb5q59Dp:fd^COfo^$2?z1vv.n' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
