<?php

namespace Volk\SecureImg\BbCode\Renderer;

use XF\BbCode\Renderer\Html as BaseHtml;

class Html extends BaseHtml
{
    protected function allowedHosts()
    {
        $allowedHosts = [];
        $app = \XF::app();
        $mediaSites = $app->finder('XF:BbCodeMediaSite')->fetch();
        
        return array_filter(array_map(function ($mediaSite) {
            return parse_url($mediaSite->site_url, PHP_URL_HOST);
        }, $mediaSites->toArray()));
    }

    protected function isHostAllowed($host)
    {
        $allowedHosts = $this->allowedHosts();
        if (empty($allowedHosts)) {
            return true; 
        }
        $host = strtolower($host);
        foreach ($allowedHosts as $allowedHost) {
            $allowedHost = strtolower($allowedHost);
            if ($host === $allowedHost || strpos($host, '.' . $allowedHost) !== false) {
                return true; 
            }
        }
        return false;
    }

    public function renderTagImage(array $children, $option, array $tag, array $options)
    {
        $url = $this->renderSubTreePlain($children);

        $validUrl = $this->getValidUrl($url);
        if (!$validUrl) {
            return $this->filterString($url, $options);
        }

        $host = parse_url($validUrl, PHP_URL_HOST);
        if (!$host || !$this->isHostAllowed($host)) {
            $unknownSourceText = \XF::phrase('image_from_unknown_source')->render();
            return '<a href="' . htmlspecialchars($validUrl) . '">' . $unknownSourceText . '</a>';
        }

        $censored = $this->formatter->censorText($validUrl);
        if ($censored != $validUrl) {
            return $this->filterString($url, $options);
        }

        if ($options['noProxy']) {
            $imageUrl = $validUrl;
        } else {
            $linkInfo = $this->formatter->getLinkClassTarget($validUrl);
            if ($linkInfo['local']) {
                $imageUrl = $validUrl;
            } else {
                $imageUrl = $this->formatter->getProxiedUrlIfActive('image', $validUrl);
                if (!$imageUrl) {
                    $imageUrl = $validUrl;
                }
            }
        }

        $displayAttrs = $this->processImageDisplayModifiers(
            $option,
            $this->getDefaultImageDisplayOptions($options)
        );

        $params = [
            'lightbox' => !empty($options['lightbox']),
            'alignClass' => $displayAttrs['class'] ?? '',
            'styleAttr' => $displayAttrs['style'] ?? '',
            'alt' => $displayAttrs['alt'] ?? '',
            'width' => $displayAttrs['width'] ?? '',
            'height' => $displayAttrs['height'] ?? '',
            'displayAttrs' => $displayAttrs
        ];

        return $this->getRenderedImg($imageUrl, $validUrl, $params);
    }

    protected function getRenderedImg($imageUrl, $validUrl, array $params = [])
    {
        $params['imageUrl'] = $imageUrl;
        $params['validUrl'] = $validUrl;

        return $this->templater->renderTemplate('public:bb_code_tag_img', $params);
    }
}