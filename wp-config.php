<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'brief' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[<XY9aqK*,,+r(L+~<>C1$3Q<*bV)ruUc(s<s/^4[V=^S?+Q=]#%yRNmhybUS;7}' );
define( 'SECURE_AUTH_KEY',  'm tk_L}sx+mI:F#||:RZq&[W0z2QOw3,w(VhH@VxwD+Q/eC9ns=Rc:/6t|EHj4%g' );
define( 'LOGGED_IN_KEY',    'Ncc[;6;kBn3P_K~9 qYeRUrF[u~wZi@R9U|m}kMHOkD#SE%UY2)q?6hCm1=nl@Q~' );
define( 'NONCE_KEY',        'jz29Rg*mjEu`b2.i.G0m_yUp+.}dM+ewDKF}&-HZ@mLBu5Mh.0!5P@#hFT-+D[-k' );
define( 'AUTH_SALT',        'r7E*+&FO<D#|sQ 0??T+NM6Y5<*>=uwJAwSFE@gjd!(fGwCV[YR;^V}f2WS92t*9' );
define( 'SECURE_AUTH_SALT', 'UFBh|o7o#&0o)U0K5e-yj#_YcATO]Aw}3F2wzz~RCx>vVR=^B14#lNn4;}d`u*:5' );
define( 'LOGGED_IN_SALT',   'TptYi]&:=nFjGULM[ ljE:*<}xRNLF7~B;QI@iIMZaX?c#ew|Fa^b0=qYN+w6hKy' );
define( 'NONCE_SALT',       'p,&IQWm3R[x1 ;uaS-D,J8~%,NLjIH!mWCJTPL#2AtR_OK^se9)a)3YfGU~e]G$f' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

// Autoriser tous les types de fichier depuis la librairie des médias
define( 'ALLOW_UNFILTERED_UPLOADS', true );

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
