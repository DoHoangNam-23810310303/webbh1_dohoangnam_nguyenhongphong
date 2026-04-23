<?php

if (! defined('ABSPATH')) {
    exit;
}

class LP_Stats_Addon
{
    public function init() {
        add_action('admin_init', array($this, 'load_textdomain'));
        add_action('wp_dashboard_setup', array($this, 'register_dashboard_widget'));
        add_shortcode('lp_total_stats', array($this, 'render_shortcode'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
    }

    public function load_textdomain() {
        load_plugin_textdomain('lp-stats-addon', false, dirname(plugin_basename(LP_STATS_ADDON_FILE)) . '/languages');
    }

    public function enqueue_assets() {
        wp_register_style(
            'lp-stats-addon',
            LP_STATS_ADDON_URL . 'assets/lp-stats-addon.css',
            array(),
            LP_STATS_ADDON_VERSION
        );

        wp_enqueue_style('lp-stats-addon');
    }

    public function register_dashboard_widget() {
        if (! current_user_can('manage_options')) {
            return;
        }

        wp_add_dashboard_widget(
            'lp_stats_addon_dashboard_widget',
            __('LearnPress Stats Dashboard', 'lp-stats-addon'),
            array($this, 'render_dashboard_widget')
        );
    }

    public function render_dashboard_widget() {
        echo $this->render_stats_html(true); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    public function render_shortcode() {
        return $this->render_stats_html(false);
    }

    private function get_stats() {
        global $wpdb;

        $stats = array(
            'total_courses'       => 0,
            'total_students'      => 0,
            'completed_courses'   => 0,
            'learnpress_detected' => 0,
        );

        $course_post_type = defined('LP_COURSE_CPT') ? LP_COURSE_CPT : 'lp_course';
        $order_post_type  = defined('LP_ORDER_CPT') ? LP_ORDER_CPT : 'lp_order';

        $stats['total_courses'] = (int) $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(ID)
                FROM {$wpdb->posts}
                WHERE post_type = %s
                AND post_status IN ('publish', 'private')",
                $course_post_type
            )
        );

        $has_learnpress_posts = $stats['total_courses'] > 0;
        $lp_user_items_table  = $wpdb->prefix . 'learnpress_user_items';

        if ($this->table_exists($lp_user_items_table)) {
            $has_learnpress_posts         = true;
            $stats['learnpress_detected'] = 1;
            $stats['total_students']      = (int) $wpdb->get_var(
                "SELECT COUNT(DISTINCT user_id)
                FROM {$lp_user_items_table}
                WHERE user_id > 0
                AND item_type = 'lp_course'"
            );

            $stats['completed_courses'] = (int) $wpdb->get_var(
                "SELECT COUNT(*)
                FROM {$lp_user_items_table}
                WHERE item_type = 'lp_course'
                AND status = 'completed'"
            );
        } else {
            $stats['total_students'] = (int) $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(DISTINCT post_author)
                    FROM {$wpdb->posts}
                    WHERE post_type = %s
                    AND post_status IN ('lp-completed', 'lp-processing', 'lp-pending', 'lp-on-hold')",
                    $order_post_type
                )
            );

            $stats['completed_courses'] = (int) $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(ID)
                    FROM {$wpdb->posts}
                    WHERE post_type = %s
                    AND post_status = %s",
                    $order_post_type,
                    'lp-completed'
                )
            );
        }

        if ($has_learnpress_posts) {
            $stats['learnpress_detected'] = 1;
        }

        return $stats;
    }

    private function table_exists($table_name) {
        global $wpdb;

        $result = $wpdb->get_var(
            $wpdb->prepare('SHOW TABLES LIKE %s', $table_name)
        );

        return $result === $table_name;
    }

    private function render_stats_html($is_admin_widget = false) {
        $stats = $this->get_stats();

        ob_start();
        ?>
        <div class="lp-stats-addon <?php echo esc_attr($is_admin_widget ? 'is-admin' : 'is-frontend'); ?>">
            <div class="lp-stats-addon__header">
                <h3><?php esc_html_e('Thong ke LearnPress', 'lp-stats-addon'); ?></h3>
                <p><?php esc_html_e('Tong hop nhanh du lieu khoa hoc va tien do hoc vien.', 'lp-stats-addon'); ?></p>
            </div>

            <?php if (! $stats['learnpress_detected']) : ?>
                <div class="lp-stats-addon__notice">
                    <?php esc_html_e('Chua phat hien du lieu LearnPress. Hay kich hoat LearnPress va tao khoa hoc mau truoc khi xem thong ke.', 'lp-stats-addon'); ?>
                </div>
            <?php endif; ?>

            <div class="lp-stats-addon__grid">
                <div class="lp-stats-addon__card">
                    <span class="lp-stats-addon__label"><?php esc_html_e('Tong so khoa hoc', 'lp-stats-addon'); ?></span>
                    <strong class="lp-stats-addon__value"><?php echo esc_html(number_format_i18n($stats['total_courses'])); ?></strong>
                </div>

                <div class="lp-stats-addon__card">
                    <span class="lp-stats-addon__label"><?php esc_html_e('Tong so hoc vien da dang ky', 'lp-stats-addon'); ?></span>
                    <strong class="lp-stats-addon__value"><?php echo esc_html(number_format_i18n($stats['total_students'])); ?></strong>
                </div>

                <div class="lp-stats-addon__card">
                    <span class="lp-stats-addon__label"><?php esc_html_e('Khoa hoc hoan thanh', 'lp-stats-addon'); ?></span>
                    <strong class="lp-stats-addon__value"><?php echo esc_html(number_format_i18n($stats['completed_courses'])); ?></strong>
                </div>
            </div>
        </div>
        <?php

        return (string) ob_get_clean();
    }
}
