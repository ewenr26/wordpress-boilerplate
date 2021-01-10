<?php

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;

class TemplateTheme
{
    public function __construct()
    {
        add_action('init', [$this, 'loadPostTypes'], 0);
        add_action('init', [$this, 'loadTaxonomies'], 0);

        $this->loadCustomFields();
    }
    public function loadPostTypes()
    {
        $cpts = Yaml::parseFile(__DIR__ . '/config/post-types.yaml');
        foreach ($cpts['post-types'] as $label => $content) {
            $content['label'] = $label;
            register_post_type($label, $content);
        }
    }
    public function loadTaxonomies()
    {
        $cpts = Yaml::parseFile(__DIR__ . '/config/taxonomies.yaml');
        foreach ($cpts['taxonomies'] as $label => $content) {
            $postType = $content['post-type'];
            register_taxonomy($label, $postType, $content);
        }
    }
    public function loadCustomFields()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/config/custom-fields');
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                include $file->getRealPath();
            }
        }
    }
}

$theme = new TemplateTheme();
$timber = new Timber\Timber();
