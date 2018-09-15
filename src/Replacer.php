<?php

namespace DM\WpCdn;

/**
 * Class Replacer
 * @package DM\WpCdn
 */
class Replacer
{
    /**
     * @var Replacer
     */
    protected static $instance;

    /**
     * DMBuilder constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Replacer
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param $source
     * @return string
     */
    public function replaceUrl($source)
    {
        $cdnUrl = Config::getInstance()->getCdnUrl();

        if (empty($cdnUrl)) {
            return $source;
        }

        $replacedSource = str_replace(get_home_url(), $cdnUrl, $source);

        return $replacedSource;
    }

    /**
     * @param $image
     * @return mixed
     */
    public function replaceUrlSrc($image)
    {
        $image[0] = $this->replaceUrl($image[0]);

        return $image;
    }
}