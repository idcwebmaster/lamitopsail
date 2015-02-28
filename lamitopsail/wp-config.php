<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

//test commit via git

// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lamitops_wp_z2q5');

/** MySQL database username */
define('DB_USER', 'lamitops_wp_z2q5');

/** MySQL database password */
define('DB_PASSWORD', '6FABEDCar0q1y8g2b7o3k5');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'u-bt8)Jv0j?+3U4O:-S~xqpvU&>}0##RQ|#Vy|X>p>)XrWIm8Gbj]Bb-EsG|,&|5');
define('SECURE_AUTH_KEY',  '!L#+B0H.AdYMGN@?/>z-A`(VxMuPzkf[8-f]dcjt+3P)sGyP8|jORZzTxnei1_|3');
define('LOGGED_IN_KEY',    'aYkSe+<0mAC+p^AX{Q/3$`YMQkmxm1-t3%rSKij WVOQ7aFx7pU4gJfc(u^}&>zy');
define('NONCE_KEY',        'J}mP,F1(R([M|N O&vT:tsw-n_].428XG@Vx?Ai_Ic62dwqz|VO)28+f]+5pCn!*');
define('AUTH_SALT',        'vcZ&H-MI%eT+Kg-NZVA{+LuTuerIE%n|Amf6#JutNB;2JJ6|+f+He13I QCq$-nK');
define('SECURE_AUTH_SALT', 'Hj=,W8uMJu)W2?nT+5w3,@GP`B^Ck0KfWs+Yg9Ms%Q@8 <BcH1Hqn(qW pYF|=r0');
define('LOGGED_IN_SALT',   '6O>pYhnzL+@Ls.Db9iJ(s+bb}+9v(I(U-@*(SR+|o8#dFhs{,u^2mqJK!NKyvT*w');
define('NONCE_SALT',       '^zFi]]to?wr#u|WRcHQcM%3es4)S7a&P<K`K!&?y+QHng|Qghe*X8v1,k!*ER?qS');


$table_prefix = 'wp_z2q5b8n3_';

define('WPLANG', '');
//
define('WP_HOME','http://www.lamitopsail.org');
define('WP_SITEURL','http://www.lamitopsail.org');



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
