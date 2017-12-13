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
define('DB_NAME', 'example');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ',U:yCgMPe98xIphZ _Iqiv%WkB{nx)Ftzo|W{Ua~f{KpKkz5S/6 #aBD~Og Vffb');
define('SECURE_AUTH_KEY',  'B[cj+|hm}jk&Yl^XyML{&#4|GvYL0q4D jKnPLzubP]b(@.#}LPJAE{[KruxrEWn');
define('LOGGED_IN_KEY',    'rHEvI/BDh~~9/o`{$~Tb+=/P68D|bOXP}wRlze#T4(t<FS(l0Ce_^f^TfR{18?%=');
define('NONCE_KEY',        'U~-YarpFA+=&9{v^Hz{|L=<XH|c-,TN,;ydQ7uBvxl Y&?o#|@NNL1Y=`)uPvS;/');
define('AUTH_SALT',        'Knd{#W+}v48PJ)5Sf9*1AlA/Ou!Q|w>xbKblS+g)4MxvVbCS_hCS3@|V>EU9q(JX');
define('SECURE_AUTH_SALT', 'g@~nxlF:PZ/0QW7T-uiXqIf*,q@H=FW:#_4z :?8f9&e fK4IUF-?=|?7e1[QYe-');
define('LOGGED_IN_SALT',   'Z9rl$ERj-2okI8{F$OW&:b0^V&D$o4h.3Z|}o%S{Z6V=AkDL5gPCWDng=k7Hny*&');
define('NONCE_SALT',       'xQsu.,1.UIka>)<k~MF6<K)h#C?agCK&BN,(ca7G5JacFk2H-uC4FQ.5[eFr!dR]');

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
