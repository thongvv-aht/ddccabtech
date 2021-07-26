<?php
define('WP_CACHE', 1); // Added by WP Rocket
 // Added by WP Rocket
 // Added by WP Rocket
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
define( 'DB_NAME', 'p9if43738258289' );

/** MySQL database username */
define( 'DB_USER', 'p9if43738258289' );

/** MySQL database password */
define( 'DB_PASSWORD', 'b@Pi3_(Z.X.1' );

/** MySQL hostname */
define( 'DB_HOST', 'p9if43738258289.db.43738258.a1f.hostedresource.net:3313' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'PP_)KTf3 ;k4>BD-;Zz~md1w}{6/QtO=~f%b]&f0[p8z6rqQ*NX?|;1yyz^&B~R4' );
define( 'SECURE_AUTH_KEY',  '-Qs24:%OHFOvDLT GwS~Ko;SZ(i27QSs-EVr[lLL$L9t@8hsv6?^q4ueST&b1~pu' );
define( 'LOGGED_IN_KEY',    '$=,#Nql9]}zzf?gO0HxQnWc G=zKJ=vD1%|:VH?$l~u^W*rqz8<Bu.8nA:n$A2-)' );
define( 'NONCE_KEY',        '@MoG|;ip9Nv=DKaJvyEp^Xl`S&:AxH,RbNLizG27n+mW(?A9Dj>%=ZC2H=b76:LD' );
define( 'AUTH_SALT',        '`aiWHd?r-8.e6|$A>&a8~RYj`T*@,kUW6Z-8&b:OA;XYp33BVp2~z>K5 ZDTo%uq' );
define( 'SECURE_AUTH_SALT', 'MTV@k3qFPAV<?b@, qq|},J^<0|O~CVKA2;Vx!O>F1zne2ans_5%Pf)$]([Fz/we' );
define( 'LOGGED_IN_SALT',   'yb?T*SIiuZSN]=Ojdx4pD{|*w^~Uc46O_6|jkTP0Iqjdxk7FPKs]>UibPKY@oOt(' );
define( 'NONCE_SALT',       'l>vEn<`/cME}J(P62b`Q~.o|s~WQ)V_|aCmG=}&_@8y(;YX(&BUc<wS_d]*]V^mX' );

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
