<?php

namespace DM\WpCdn;

/**
 * Class Bootstrap
 * @package DM\DMBuilder
 */
class Bootstrap
{
    /**
     * @var Bootstrap
     */
    protected static $instance;

    /**
     * DMBuilder constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Bootstrap
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *
     */
    public function init()
    {
        add_filter('wp_get_attachment_url', array(Replacer::getInstance(), 'replaceUrl'), 99, 1);
        add_filter('post_thumbnail_html', array(Replacer::getInstance(), 'replaceUrl'), 99, 1);
        add_filter('wp_get_attachment_image_src', array(Replacer::getInstance(), 'replaceUrlSrc'), 99, 1);
    }
}