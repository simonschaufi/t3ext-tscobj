<?php

use Causal\Tscobj\Controller\Wizard\TypoScriptBrowser;

return [
    'wizard_typoscript_browser' => [
        'path' => '/wizard/typoscript-browser',
        'target' => TypoScriptBrowser::class . '::mainAction',
    ],
];
