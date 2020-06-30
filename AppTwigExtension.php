<?php

use Twig\Extension\AbstractExtension;

class AppTwigExtension extends AbstractExtension {

    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('findPageNumber', [
                $this, 'pageNumber'
                ]),
        ];
    }

    public function pageNumber( $slug, $pages_slug) {
        $index = array_search($slug, $pages_slug);
         return  $index;
    }
}