<?php

declare(strict_types=1);

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

namespace Causal\Tscobj\FormEngine\FieldControl;

use TYPO3\CMS\Backend\Form\AbstractNode;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class renders the wizard icon behind the "TypoScript object path" field
 */
class ImportDataControl extends AbstractNode
{
    public function render()
    {
        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);

        $urlParameters = [
            'P' => [
                'table' => $this->data['tableName'],
                'uid' => $this->data['databaseRow']['uid'],
                'field' => $this->data['fieldName'],
                'returnUrl' => $this->data['returnUrl'],
            ],
        ];

        return [
            'iconIdentifier' => 'actions-cog',
            'title' => 'LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.flexform_pi1.wizards.object',
            'linkAttributes' => [
                'href' => (string)$uriBuilder->buildUriFromRoute('wizard_typoscript_browser', $urlParameters),
            ],
        ];
    }
}
