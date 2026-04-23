<?php
/**
 * Plugin Name: LearnPress Stats Dashboard
 * Plugin URI: https://example.com/learnpress-stats-dashboard
 * Description: Hien thi thong ke tong so khoa hoc, hoc vien da dang ky va khoa hoc hoan thanh cho LearnPress.
 * Version: 1.0.0
 * Author: Student Project
 * Author URI: https://example.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: lp-stats-addon
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if (! defined('ABSPATH')) {
    exit;
}

define('LP_STATS_ADDON_VERSION', '1.0.0');
define('LP_STATS_ADDON_FILE', __FILE__);
define('LP_STATS_ADDON_PATH', plugin_dir_path(__FILE__));
define('LP_STATS_ADDON_URL', plugin_dir_url(__FILE__));

require_once LP_STATS_ADDON_PATH . 'includes/class-lp-stats-addon.php';

function lp_stats_addon_bootstrap() {
    $plugin = new LP_Stats_Addon();
    $plugin->init();
}

lp_stats_addon_bootstrap();
