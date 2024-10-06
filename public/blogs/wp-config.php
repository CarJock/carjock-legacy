<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
// Load environment variables from Laravel .env
$path = __DIR__ . '/../..'; // Adjust this according to your Laravel path
$envFile = $path . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv(sprintf('%s=%s', $key, $value));
            $_ENV[$key] = $value;
        }
    }
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WP_DB_DATABASE') );

/** Database username */
define( 'DB_USER', getenv('DB_USERNAME') );

/** Database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );

/** Database hostname */
define( 'DB_HOST', getenv('DB_HOST') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FORCE_SSL_ADMIN', false);


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
define( 'AUTH_KEY',         'RznPKqdulYVWzM84.<VJCiR]q4xr|bH PV`M$nwT+7b2_smy)2%g[q-lE3H=eiti' );
define( 'SECURE_AUTH_KEY',  '8]nH?~45h>`:Z!c#I)Y_ NQXH!-b6-@u%;xy50e6AP(M5m[XiN*~ig]J{l-~+L&l' );
define( 'LOGGED_IN_KEY',    'wz+Rwg0>#w?mEI/pTL-ASPyHDEaimgvuR^{m`3{L~EU0GbZHQN)%1t<k93-7K<b%' );
define( 'NONCE_KEY',        's`tcx_?l?HQaJa 2nJzWUCK^m0)X4ODeWH!`cJSMH*hDos*q5V7o[$[M_:D7G Y6' );
define( 'AUTH_SALT',        '=xA5MAUn?PE-<Yus^*z?;506Dusp$FGU!z/}O^dr2c7L+XR3oh3s+)m/Ch;Euiav' );
define( 'SECURE_AUTH_SALT', '>bo^s8Cg^7SnF^Vg&yP(}YA9w@EH,ZM_s&xm1$^%WX/H3)oeidY5kZdA2}X-|>pj' );
define( 'LOGGED_IN_SALT',   'S>oID?]iHc3_)J:Pu]Lma!e]p@d#@/smV;`P/<;>XD5lJ&Fv0`r=oH7j)V0[V(#3' );
define( 'NONCE_SALT',       '.r>s!^MW#P,}]/yH}]Q/N])mf^W2EG2$y)uN;mVd-*_v^d!CPmj&eSi?U)uGR5Kz' );

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
