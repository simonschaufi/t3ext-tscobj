<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content element from TypoScript',
    'description' => 'A plugin which lets you use any TypoScript object as a normal content element.',
    'category' => 'plugin',
    'state' => 'stable',
    'uploadfolder' => 0,
    'clearCacheOnLoad' => 0,
    'author' => 'Simon Schaufelberger',
    'author_email' => 'simonschaufi+tscobj@gmail.com',
    'author_company' => '',
    'version' => '3.0.3',
    'constraints' => [
        'depends' => [
            'typo3' => '11.4.0-11.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
