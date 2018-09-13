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
        echo 'WP CDN';
    }
}