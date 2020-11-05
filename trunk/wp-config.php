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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Sql1470777_2' );


/** MySQL database username */
define( 'DB_USER', 'Sql1470777' );


/** MySQL database password */
define( 'DB_PASSWORD', '26q51294b4' );


/** MySQL hostname */
define( 'DB_HOST', '89.46.111.231' );


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
define( 'AUTH_KEY',         '!>dr|OY0)MVybnctdui IUk|%v.rQw skpE/{(&UW)_HF;m(6=M,~MUr!5(|P(`%' );

define( 'SECURE_AUTH_KEY',  'a|s_a5LxqiW*%cbG[sXzgI N7G9k:j1hRTX@[v9q:sR9KM;#}pUxVDwzG/X1$bUM' );

define( 'LOGGED_IN_KEY',    'Ii_t*!c9m8B7s/D8J&q&2i}!S8t?5p>~i`xacR}N}7tWhCCyQ>.c?;!R+bSs Dx{' );

define( 'NONCE_KEY',        'Mtdy?Cl5hIx:ORNgi;9,]$9}bv^m3<TYo1}1rpsA3Mc7v(8?@LsGnw-:%P7FG- 5' );

define( 'AUTH_SALT',        'TM&F,L,Y$G0ALD )Oule_1@479<oa~un)lLA}eB`g1ASC//(qBHD^B|uWP<-.C{J' );

define( 'SECURE_AUTH_SALT', ']:-Ih] IKgbzWA5$a>PYDkodc[!=0{zY4}^Mac89Sm{wise1jK-xHt}L@b|qki$J' );

define( 'LOGGED_IN_SALT',   '&}6,d+CbG[;lc*gclB])?j(BNZ8<!M:.rQGyP*}27X>zULg&qHo,jSzdYS*iEX-W' );

define( 'NONCE_SALT',       '6@r&2Sg5qVMmSe?l-C Ac/o<s~@*!F*rKe[^jv~v!0FfeXtRdx%2<e:i1R3bnW=B' );


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_odpm';


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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
