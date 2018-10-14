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
        if (!$this->isAttachment($url)) {
            return $url;
        }

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

    /**
     * @param $url
     * @return bool
     */
    protected function isAttachment($url)
    {
        $pos = strrpos($url, ".");
        if ($pos === false) {
            return false;
        }

        $ext = strtolower(trim(substr($url, $pos)));

        $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif", ".pdf");

        if (in_array($ext, $imgExts)) {
            return true;
        }

        return false;
    }
}
