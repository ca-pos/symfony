<?php

use Twig\Extension\AbstractExtension;

class AppTwigExtension extends AbstractExtension {

    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('findPageNumber', [
                $this, 'pageNumber'
                ]),
            new \Twig\TwigFunction('nextPage', [
                $this, 'nextPage'
                ]),
            new \Twig\TwigFunction('previousPage', [
               $this, 'previousPage'
                ]),
    
        ];
    }

    public function pageNumber( $slug, $pages_slug) {
        $index = array_search($slug, $pages_slug);
         return  $index;
    }

    public function nextPage( $slug, $pages_slug) {
        $maxIndex = count($pages_slug)-1;
        $page = $this->pageNumber( $slug, $pages_slug);
        $result = ($page >= $maxIndex)?0:+$page+1;
        
        return $result;
    }

    public function previousPage( $slug, $pages_slug) {
        $page = $this->pageNumber( $slug, $pages_slug);
        $result = ($page <= 0)?0:+$page-1;

        return $result;
    }


}