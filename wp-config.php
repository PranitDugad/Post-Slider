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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '}j4. BAh 5=mREPiD]qT+j)cEYEXMVdMxpGVY}C%Bp)w@0]?uX>D=xvia/+{ZkF)' );
define( 'SECURE_AUTH_KEY',   '/^zI: Wfh^qdhcur0(?(-*Gq_!{[XmiT#CH>!U#;ciN+pU@(64(M]qs_s%aj)U3!' );
define( 'LOGGED_IN_KEY',     'Hkg={tmm4$WP_~Dd-BUC4f]X=nLzA*F|#*H>}$!>njvfu<x[rPU0~0}CT$@Po&$&' );
define( 'NONCE_KEY',         '41W$|q&DT=$42WU7/-;xU^GM1Ch;yF]5xl(y,KvvnbH46426{&Lg6d_,lf)^Nj2d' );
define( 'AUTH_SALT',         'AB4E&6t;:|9<CjTeM49,(+MRx/U`rJ:z>}YQM~kvxS$?]xPDrBCUwFzk(*p{lE^U' );
define( 'SECURE_AUTH_SALT',  '!%C]I0=0H8n:obfo{YGxwFS0,iw j{,<00 `LHr&-Oa@;*9N!IjCfx0yj{fW+exY' );
define( 'LOGGED_IN_SALT',    ';A/:mDP,!MuM5k]pqaqxy;OF6Q}>`#e=BDq8fb^&*M2vT[4q?qsQ_oWMP}cP~t%z' );
define( 'NONCE_SALT',        '!|Zl.QK>UC ]{3X5v3y~n^4[WcLG_K?&NSI+:[a|1D%.L+!8hhc|MN9q6KN?ZY]?' );
define( 'WP_CACHE_KEY_SALT', 'ZnnOy9&WN7$N;&v#l7;8Itde]TNgcb](9mV4E+%RsExSjZ(q{-L|scZWPd8f]mSD' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
