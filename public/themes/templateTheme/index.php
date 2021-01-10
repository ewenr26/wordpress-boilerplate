<?php

use Timber\Timber;

$context = Timber::context();
$context['test'] = 'test';

Timber::render('index.twig', $context);
