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

namespace Causal\Tscobj\Backend\EventListener;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

final class PageContentPreviewRenderingEventListener
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        if ($event->getTable() !== 'tt_content') {
            return;
        }
        if ($event->getRecord()['CType'] === 'list' && $event->getRecord()['list_type'] === 'tscobj_pi1') {
            $row = $event->getRecord();
            $flexForm = GeneralUtility::xml2array($row['pi_flexform']);

            $itemContent = 'TS: ' . $this->pi_getFlexFormValue($flexForm, 'object');

            $event->setPreviewContent($itemContent);
        }
    }

    /**
     * Return value from somewhere inside a FlexForm structure
     *
     * @param array $T3FlexForm_array FlexForm data
     * @param string $fieldName Field name to extract. Can be given like "test/el/2/test/el/field_templateObject" where each part will dig a level deeper in the FlexForm data.
     * @param string $sheet Sheet pointer, eg. "sDEF
     * @param string $lang Language pointer, eg. "lDEF
     * @param string $value Value pointer, eg. "vDEF
     * @return string|null The content.
     */
    private function pi_getFlexFormValue(
        array $T3FlexForm_array,
        string $fieldName,
        string $sheet = 'sDEF',
        string $lang = 'lDEF',
        string $value = 'vDEF'
    ): ?string {
        $sheetArray = $T3FlexForm_array['data'][$sheet][$lang];
        if (is_array($sheetArray)) {
            return $this->pi_getFlexFormValueFromSheetArray($sheetArray, explode('/', $fieldName), $value);
        }

        return null;
    }

    /**
     * Returns part of $sheetArray pointed to by the keys in $fieldNameArray
     *
     * @param array $sheetArray Multidimensiona array, typically FlexForm contents
     * @param array $fieldNameArr Array where each value points to a key in the FlexForms content - the input array will have the value returned pointed to by these keys. All integer keys will not take their integer counterparts, but rather traverse the current position in the array an return element number X (whether this is right behavior is not settled yet...)
     * @param string $value Value for outermost key, typ. "vDEF" depending on language.
     * @return mixed The value, typ. string.
     * @see pi_getFlexFormValue()
     */
    private function pi_getFlexFormValueFromSheetArray(array $sheetArray, array $fieldNameArr, string $value): mixed
    {
        $tempArr = $sheetArray;
        foreach ($fieldNameArr as $v) {
            if (MathUtility::canBeInterpretedAsInteger($v)) {
                if (is_array($tempArr)) {
                    $c = 0;
                    foreach ($tempArr as $values) {
                        if ($c == $v) {
                            $tempArr = $values;

                            break;
                        }
                        $c++;
                    }
                }
            } else {
                $tempArr = $tempArr[$v];
            }
        }

        return $tempArr[$value];
    }
}
