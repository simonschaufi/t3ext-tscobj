<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * (c) Simon Schaufelberger
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Causal\Tscobj\Controller\Wizard\TypoScriptBrowser;

return [
    'wizard_typoscript_browser' => [
        'path' => '/wizard/typoscript-browser',
        'target' => TypoScriptBrowser::class . '::mainAction',
    ],
];
