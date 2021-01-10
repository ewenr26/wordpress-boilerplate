<?php

use WordPlate\Acf\Fields\Email;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Location;

register_extended_field_group([
    'title' => 'Fake Post',
    'fields' => [
        Text::make('Title')
            ->instructions('Add the employee title.')
            ->required(),
        Email::make('Email address', 'email')
            ->instructions('Add the employee email address.')
            ->required(),
        Text::make('Phone number', 'phone')
            ->instructions('Add the employee phone number.'),
    ],
    'location' => [
        Location::if('post_type', 'fake-post'),
    ],
]);
