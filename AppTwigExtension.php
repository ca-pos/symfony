<?php

use Twig\Extension\AbstractExtension;

class AppTwigExtension extends AbstractExtension {

    public function getFunctions()
    {
        return [
            // new \Twig\TwigFunction('findPage', [
            //     $this, 'findPage'
            //     ]),
            new \Twig\TwigFunction('nextPage', [
                $this, 'nextPage'
                ]),
            new \Twig\TwigFunction('previousPage', [
               $this, 'previousPage'
                ]),
            // new \Twig\TwigFunction('findPageNumber', [
            //     $this, 'findPageNumber'
            //     ]),
        ];
    }

    /**
     * renvoie le slug de la page suivante
     *
     * @param string $section
     * @param int $current
     * @param array $pages_slug
     * @return string
     */
    public function nextPage( $section, $current,  $pages_slug) {

        $maxIndexPage = count($pages_slug[$section]);
        $maxIndexSection = count( array_keys($pages_slug));
        $current++;
        // la page suivante est dans la même section
        if( $current < $maxIndexPage ) {

            return $pages_slug[$section][$current];
        }
        // on est à la dernière page d'une section
        // si on n'est pas à la dernière section,
        // la page suivante est la première page de la section suivante
        elseif (array_search($section, array_keys($pages_slug)) < $maxIndexSection -  1) {
            $index = array_search($section, array_keys($pages_slug)) + 1;
            $section = array_keys($pages_slug)[$index];

            return $pages_slug[$section][0];
        }
        // si on est à la dernière page de la dernière section
        // on revient à l'accueil
        else {
            return 'accueil';
        }
    }
    /**
     * renvoie le slug de la page précédente
     *
     * @param string $section
     * @param int $current
     * @param array $pages_slug
     * @return string
     */
    public function previousPage( $section, $current, $pages_slug) {
        // la page précédente est dans la même section
        if( $current > 0) {
            return $pages_slug[$section][--$current];
        }
        // on est à la première page d'une section
        // si ce n'est pas la première section
        // la page précédente est la dernière page de la section précédente
        elseif ( array_search($section, array_keys($pages_slug)) > 0 ) {
            $index = array_search($section, array_keys($pages_slug)) - 1;
            $section = array_keys($pages_slug)[$index];
            $lastPageNumber = count($pages_slug[$section]) - 1;

            return $pages_slug[$section][$lastPageNumber];
        }
        // si on est à la première page de la première section
        // on revient à l'accueil
        else {
            return 'accueil';
        }
    }


}