<?php
/**
 * File: wpglobus.php
 *
 * @package   WPGlobus
 * @author    TIV.NET INC, Alex Gor (alexgff) and Gregory Karpinsky (tivnet)
 * @copyright 2015-2016 TIV.NET INC. / WPGlobus
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3
 */

// <editor-fold desc="WordPress plugin header">
/**
 * Plugin Name: WPGlobus
 * Plugin URI: https://github.com/WPGlobus/WPGlobus
 * Description: A WordPress Globalization / Multilingual Plugin. Posts, pages, menus, widgets and even custom fields - in multiple languages!
 * Text Domain: wpglobus
 * Domain Path: /languages/
 * Version: 1.7.5
 * Author: WPGlobus
 * Author URI: http://www.wpglobus.com/
 * Network: false
 * License: GPL-3.0
 * License URI: http://www.gnu.org/licenses/gpl.txt
 */
// </editor-fold>
// <editor-fold desc="GNU Clause">
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3, as
 * published by the Free Software Foundation.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
// </editor-fold>
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPGLOBUS_VERSION', '1.7.5' );
define( 'WPGLOBUS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * WP Requirements library.
 *
 * @since   1.6.4
 */
if ( is_readable( dirname( __FILE__ ) . '/vendor/bemailr/wp-requirements/wpr-loader.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/bemailr/wp-requirements/wpr-loader.php';
}

/** @todo Get rid of these */
// @codingStandardsIgnoreStart
global $WPGlobus;
global $WPGlobus_Options;
// @codingStandardsIgnoreEnd

/**
 * Compatibility functions.
 *
 * @since   1.6.4
 */
require_once dirname( __FILE__ ) . '/includes/compat/mbstring.php';

/**
 * Abstract class for plugins.
 *
 * @since   1.6.1
 */
require_once dirname( __FILE__ ) . '/includes/class-wpglobus-plugin.php';

require_once dirname( __FILE__ ) . '/includes/class-wpglobus-config.php';
require_once dirname( __FILE__ ) . '/includes/class-wpglobus-utils.php';
require_once dirname( __FILE__ ) . '/includes/class-wpglobus-wp.php';
require_once dirname( __FILE__ ) . '/includes/class-wpglobus-widget.php';
require_once dirname( __FILE__ ) . '/includes/class-wpglobus.php';

require_once dirname( __FILE__ ) . '/includes/class-wpglobus-core.php';

/**
 * Initialize
 * @todo Rename uppercase variables.
 */
// @codingStandardsIgnoreStart
WPGlobus::$PLUGIN_DIR_PATH = plugin_dir_path( __FILE__ );
WPGlobus::$PLUGIN_DIR_URL  = plugin_dir_url( __FILE__ );
// @codingStandardsIgnoreEnd
WPGlobus::Config();

require_once dirname( __FILE__ ) . '/includes/class-wpglobus-filters.php';
require_once dirname( __FILE__ ) . '/includes/wpglobus-controller.php';

/**
 * Support for Yoast SEO
 */
require_once dirname( __FILE__ ) . '/includes/wpglobus-yoastseo.php';

/**
 * Support of theme option panels and customizer
 * @since 1.4.0
 */
require_once dirname( __FILE__ ) . '/includes/admin/customize/wpglobus-customize.php';

/**
 * WPGlobus customize options
 * @since 1.4.6
 */
require_once dirname( __FILE__ ) . '/includes/admin/class-wpglobus-customize-options.php';
WPGlobus_Customize_Options::controller();

// TODO remove this old updater.
require_once dirname( __FILE__ ) . '/updater/class-wpglobus-updater.php';

/**
 * TIVWP Updater.
 *
 * @since 1.5.9
 */
if (
	version_compare( PHP_VERSION, '5.3.0', '>=' )
	&& file_exists( dirname( __FILE__ ) . '/vendor/tivwp/updater/updater.php' )
) {
	require_once dirname( __FILE__ ) . '/vendor/tivwp/updater/updater.php';
}

/**
 * In admin area
 */
if ( WPGlobus_WP::in_wp_admin() ) :

	/**
	 * Admin page helpers
	 *
	 * @since 1.6.5
	 */
	require_once dirname( __FILE__ ) . '/includes/admin/class-wpglobus-admin-page.php';

	/**
	 * HelpDesk
	 *
	 * @since 1.6.5
	 */
	require_once dirname( __FILE__ ) . '/includes/admin/helpdesk/class-wpglobus-admin-helpdesk.php';
	WPGlobus_Admin_HelpDesk::construct();

	/**
	 * Admin page central.
	 *
	 * @since 1.6.6
	 */
	require_once dirname( __FILE__ ) . '/includes/admin/central/class-wpglobus-admin-central.php';
	WPGlobus_Admin_Central::construct();

endif;

/*EOF*/
