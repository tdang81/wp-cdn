<?php

namespace DM\WpCdn;

/**
 * Class Config
 * @package DM\WpCdn
 */
class Config
{
    /**
     * @var Config
     */
    protected static $instance;

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getCdnUrl()
    {
        if (!defined('DM_CDN_URL')) {
            return '';
        }

        return DM_CDN_URL;
    }
}