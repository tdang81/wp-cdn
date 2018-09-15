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
     * @param $url
     * @return string
     */
    public function replaceUrl($url)
    {
        $cdnUrl = Config::getInstance()->getCdnUrl();

        if (empty($cdnUrl)) {
            return $url;
        }

        $replacedSource = str_replace(get_home_url(), $cdnUrl, $url);

        return $replacedSource;
    }

    /**
     * @param $content
     * @return string
     */
    public function replaceImageUrl($content)
    {
        $cdnUrl = Config::getInstance()->getCdnUrl();

        if (empty($cdnUrl)) {
            return $content;
        }

        $replacedSource = str_replace(get_home_url(), $cdnUrl, $content);

        $replacedSource = preg_replace(
            array(
                '/\\\'/wp-content/uploads/',
                '/\"/wp-content/uploads/'
            ),
            $cdnUrl,
            $replacedSource
        );

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

    /**
     * @param $images
     * @return mixed
     */
    public function replaceUrlSrcSet($images)
    {
        foreach ($images as $key => $image) {
            $images[$key]['url'] = $this->replaceUrl($image['url']);
        }

        return $images;
    }
}