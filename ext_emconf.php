<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content element from TypoScript',
    'description' => 'A plugin which lets you use any TypoScript object as a normal content element.',
    'category' => 'plugin',
    'state' => 'stable',
    'author' => 'Simon Schaufelberger',
    'author_email' => 'simonschaufi+tscobj@gmail.com',
    'author_company' => '',
    'version' => '4.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.10-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
