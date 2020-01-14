<?php

$EM_CONF['tscobj'] = [
    'title' => 'Content element from TypoScript',
    'description' => 'A plugin which lets you use any TypoScript object as a normal content element.',
    'category' => 'plugin',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author' => 'Simon Schaufelberger',
    'author_email' => 'simonschaufi+tscobj@gmail.com',
    'author_company' => '',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'php' => '7.0.0-7.99.99',
            'typo3' => '8.7.0-8.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
