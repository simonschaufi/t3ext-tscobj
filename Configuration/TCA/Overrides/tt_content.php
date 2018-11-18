<?php

// Plugin options
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tscobj_pi1'] = 'layout,select_key,pages,recursive';

// Add flexform fields to plugin options
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tscobj_pi1'] = 'pi_flexform';
