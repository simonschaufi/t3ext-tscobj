<?php
	/***************************************************************
	 * Copyright notice
	 *
	 * (c) 2004 macmade.net
	 * All rights reserved
	 *
	 * This script is part of the TYPO3 project. The TYPO3 project is 
	 * free software; you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation; either version 2 of the License, or
	 * (at your option) any later version.
	 *
	 * The GNU General Public License can be found at
	 * http://www.gnu.org/copyleft/gpl.html.
	 *
	 * This script is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/
	
	/**
	 * Wizard to show TS template.
	 *
	 * @author		Jean-David Gadina (macmade@gadlab.net)
	 * @version		1.0
	 */
	
	/**
	 * [CLASS/FUNCTION INDEX OF SCRIPT]
	 * 
	 * SECTION:		1 - INIT
	 *     121:		function main
	 * 
	 * SECTION:		2 - MAIN
	 *     224:		function moduleContent
	 *     275:		function makeLinks
	 *     301:		function showTemplate($conf,$pObj=false)
	 * 
	 * SECTION:		3 - UTILITIES
	 *    374:		function printContent
	 *    387:		function addStyles
	 *    412:		function getConfigArray
	 *    445:		function updateData($object)
	 * 
	 *				TOTAL FUNCTIONS: 8
	 */
	
	// Default initialization of the module
	unset($MCONF);
	require('conf.php');
	require($BACK_PATH . 'init.php');
	require($BACK_PATH . 'template.php');
	$LANG->includeLLFile('EXT:tscobj/wiz1/locallang.php');
	require_once(PATH_t3lib . 'class.t3lib_scbase.php');
	
	// Required classes for getting the TS template
	require_once (PATH_t3lib.'class.t3lib_page.php');
	require_once (PATH_t3lib.'class.t3lib_tstemplate.php');
	
	class tx_tscobj_wiz1 extends t3lib_SCbase {
		
		// Available content objets
		var $cTypes = array(
			'HTML',
			'TEXT',
			'COBJ_ARRAY',
			'COA',
			'COA_INT',
			'FILE',
			'IMAGE',
			'IMG_RESOURCE',
			'CLEARGIF',
			'CONTENT',
			'RECORDS',
			'HMENU',
			'CTABLE',
			'OTABLE',
			'COLUMNS',
			'HRULER',
			'IMGTEXT',
			'CASE',
			'LOAD_REGISTER',
			'RESTORE_REGISTER',
			'FORM',
			'SEARCHRESULT',
			'USER',
			'USER_INT',
			'PHP_SCRIPT',
			'PHP_SCRIPT_INT',
			'PHP_SCRIPT_EXT',
			'TEMPLATE',
			'MULTIMEDIA',
			'EDITPANEL',
		);
		
		
		
		
		
		/***************************************************************
		 * SECTION 1 - INIT
		 *
		 * Base module functions.
		 ***************************************************************/
		
		
		/**
		 * Creates the page
		 * 
		 * This function creates the basic page in which the module will
		 * take place.
		 * 
		 * @return		Void
		 * @see			addStyles
		 * @see			moduleContent
		 */
		function main() {
			global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
			
			// Store variables from TCE
			$this->P = t3lib_div::_GP('P');
			
			// Draw the header.
			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" method="POST">';
			
			// JavaScript
			$this->doc->JScode = '
				<script type="text/javascript" language="Javascript" charset="iso-8859-1">
					<!--
					script_ended = 0;
					function jumpToUrl(URL) {
						document.location = URL;
					}
					//-->
				</script>
				<script type="text/javascript" language="Javascript" charset="iso-8859-1">
					<!--
					// Function for swapping element classes
					function tx_tscobj_swapClasses(element) {
						if (document.getElementById) {
							liClass = document.getElementById(element).className;
							document.getElementById(element).className = (liClass == "open") ? "closed" : "open";
							document.getElementById(element + "-img").src = (liClass == "open") ? "' . t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/ol/plusbullet.gif','',1) . '" : "' . t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/ol/minusbullet.gif','',1) . '";
						}
					}
					// Function for expanding/collapsing all elements
					var expanded = 0;
					function tx_tscobj_expAll() {
						if (document.getElementsByTagName) {
							var listItems = document.getElementsByTagName("li");
							for (i = 0; i < listItems.length; i++) {
								listItems[i].className = (expanded) ? "closed" : "open";
								id = listItems[i].id;
								if (id.substr(id.length - 1,id.length) == ".") {
									var picture = id + "-img";
									document.getElementById(picture).src = (expanded) ? "' . t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/ol/plusbullet.gif','',1) . '" : "' . t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/ol/minusbullet.gif','',1) . '";
								}
							}
							expanded = (expanded == 1) ? 0 : 1;
						}
					}
					-->
				</script>
			';
			
			// Add CSS styles for the module
			$this->doc->inDocStyles = $this->addStyles();
			
			// Access check
			$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
			$access = is_array($this->pageinfo) ? 1 : 0;
			
			if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id)) {
				
				// Admin user
				if ($BE_USER->user['admin'] && !$this->id) {
					$this->pageinfo = array('title'=>'[root-level]','uid'=>0,'pid'=>0);
				}
				
				// Build current path
				$headerSection = $this->doc->getHeader('pages',$this->pageinfo,$this->pageinfo['_thePath']).'<br>'.$LANG->sL('LLL:EXT:lang/locallang_core.php:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);
				
				// Start page content
				$this->content .= $this->doc->startPage($LANG->getLL('title'));
				$this->content .= $this->doc->header($LANG->getLL('title'));
				$this->content .= $this->doc->spacer(5);
				$this->content .= $this->doc->divider(5);
				
				// Render content
				$this->moduleContent();
			}
			
			// Spacer
			$this->content .= $this->doc->spacer(10);
		}
		
		
		
		
		
		/***************************************************************
		 * SECTION 2 - MAIN
		 *
		 * Main module functions.
		 ***************************************************************/
		
		/**
		 * Creates the module's content
		 * 
		 * This function creates the module's content.
		 * 
		 * @return		Void
		 * @see			updateData
		 * @see			makeLinks
		 * @see			getConfigArray
		 * @see			showTemplate
		 */
		function moduleContent() {
			global $LANG;
			
			// DEBUG ONLY - Show template
			#t3lib_div::debug($conf);
			
			// Object has been selected?
			if ($id = t3lib_div::_GP('tsobj')) {
				
				// Update flexform data
				$this->updateData($id);
				
				// Return to TCE form
				header('Location: ' . t3lib_div::locationHeaderUrl($this->P["returnUrl"]));
				
			} else {
				
				// Start section
				$this->content .= $this->doc->sectionBegin();
				
				// Description
				$this->content .= '<div style="padding: 5px; border: dashed 1px #666666;">' . $LANG->getLL('description') . '<br /><strong>' . $LANG->getLL('instructions') . '</strong></div>';
				
				// Spacer
				$this->content .= $this->doc->spacer(5);
				
				// Create links
				$this->content .= $this->makeLinks();
				
				// Get TypoScript template for current page
				$conf = $this->getConfigArray();
				
				// Show TS template hierarchy
				$this->content .= $this->showTemplate($conf);
				
				// Create links
				$this->content .= $this->makeLinks();
				
				// End section
				$this->content .= $this->doc->sectionEnd();
			}
		}
		
		/**
		 * Creates links
		 * 
		 * This function creates the links to return to TCE forms and
		 * to expand/collapse all sections of the TS template.
		 * 
		 * @return		The two links
		 */
		function makeLinks() {
			global $LANG;
			
			// Storage
			$htmlCode = array();
			
			// Back link
			$htmlCode[] = '<a href="' . $this->P["returnUrl"] . '">' . $LANG->getLL('backlink') . '</a><br />';
			
			// Show all link
			$htmlCode[] = '<a href="javascript:tx_tscobj_expAll();">' . $LANG->getLL('showall') . '</a>';
			
			// Return links
			return implode(chr(10),$htmlCode);
		}
		
		/**
		 * Show TS template hierarchy
		 * 
		 * This function displays the TS template hierarchy as HTML list
		 * elements. Each section can be expanded/collapsed.
		 * 
		 * @param		$object		A section of the TS template
		 * @param		$object		The path to the current object
		 * @return		
		 */
		function showTemplate($conf,$pObj=false) {
			
			// Storage
			$htmlCode = array();
			
			// Start list
			$htmlCode[] = '<ul>';
			
			// Process each object of the configuration array
			foreach($conf as $key=>$value) {
				
				// TS object ID
				$id = $pObj . $key;
				
				// Check if object is a container
				if (is_array($value)) {
					
					// Check if object has a content type
					if (substr($key,0,strlen($key) - 1) != $lastKey) {
						
						// No content type - Process sub configuration
						$subArray = $this->showTemplate($value,$id);
						
						// Check if objects are available
						if ($subArray) {
							
							// Add container
							$htmlCode[] = '<li class="closed" id="' . $id . '"><div class="container"><a href="javascript:tx_tscobj_swapClasses(\'' . $id . '\')"><img id="' . $id . '-img" ' . t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/ol/plusbullet.gif','') . ' alt="" hspace="0" vspace="0" border="0" align="middle"></a>&nbsp;' . $key . $subArray . '</div></li>';
						}
					}
				}
				else if (in_array($value,$this->cTypes)) {
					
					// Memorize key
					$lastKey = $key;
					
					// Link parameters
					$linkParams = '?P[returnUrl]=' . urlencode($this->P['returnUrl']) . '&P[table]=' . $this->P['table'] . '&P[uid]=' . $this->P['uid'] . '&tsobj=' . $id;
					
					// TS object
					$htmlCode[] = '<li><div class="object"><strong><a href="index.php' . $linkParams . '" title="' . $id . '">' . $key . '</a></strong> ('. $value . ')</div></li>';
				}
			}
			
			// End list
			$htmlCode[] = '</ul>';
			
			// Check if objects have been detected
			if (count($htmlCode) > 2) {
				
				// Return hierarchy
				return implode(chr(10),$htmlCode);
			}
		}
		
		
		
		
		
		/***************************************************************
		 * SECTION 3 - UTILITIES
		 *
		 * General purpose functions.
		 ***************************************************************/
		
		/**
		 * Prints the page
		 * 
		 * This function closes the page, and writes the final
		 * rendered content.
		 * 
		 * @return		Void
		 */
		function printContent() {
			$this->content .= $this->doc->endPage();
			echo($this->content);
		}
		
		/**
		 * Add CSS styles
		 * 
		 * This functions reads the module's stylesheet and replace some
		 * colors to add skinning compatibility.
		 * 
		 * @return		CSS styles, ready to be included in a <style> tag
		 */
		function addStyles() {
			
			// Get stylesheet path
			$path = t3lib_extMgm::extPath('tscobj') . 'wiz1/stylesheet.css';
			
			// Read stylesheet
			$styles = t3lib_div::getURL($path);
			
			// Replace color markers
			$styles = str_replace('###COLOR1###',$this->doc->bgColor5,$styles);
			$styles = str_replace('###COLOR2###',$this->doc->bgColor6,$styles);
			$styles = str_replace('###COLOR3###',$this->doc->bgColor3,$styles);
			
			// Return CSS styles
			return $styles;
		}
		
		/**
		 * Get TS template
		 * 
		 * This function creates instances of the class needed to render
		 * the TS template, and gets it as a multi-dimensionnal array.
		 * 
		 * @return		An array containing all the available TS objects
		 */
		function getConfigArray() {
			
			// Initialize the page selector
			$this->sys_page = t3lib_div::makeInstance('t3lib_pageSelect');
			$this->sys_page->init(true);
			
			// initialize the TS template
			$this->tmpl = t3lib_div::makeInstance('t3lib_TStemplate');
			$this->tmpl->init();
			
			// Avoid an error
			$this->tmpl->tt_track = 0;
			
			// Get rootline for current PID
			$rootline = $this->sys_page->getRootLine($this->P['pid']);
			
			// Start TS template
			$this->tmpl->start($rootline);
			
			//Return configuration array
			return $this->tmpl->setup;
		}
		
		/**
		 * Update flexform
		 * 
		 * This function updates the flexform data with the selected TS
		 * object. If the flexform data does not exist, the function
		 * creates it.
		 * 
		 * @param		$object		The TS object path
		 * @return		Void
		 */
		function updateData($object) {
			
			// Get current record
			$record = t3lib_BEfunc::getRecord($this->P['table'],$this->P['uid']);
			
			// Get flexform data
			$flex = $record['pi_flexform'];
			
			// Check if data exsists
			if ($flex) {
				
				// Convert XML data to an array
				$flexArray = t3lib_div::xml2array($flex);
				
				// Update data
				$flexArray['data']['sDEF']['lDEF']['object']['vDEF'] = $object;
				
			} else {
				
				// Create new array
				$flexArray = array(
					'data' => array(
						'sDEF' => array(
							'lDEF' => array(
								'object' => array('vDEF' => $object),
							),
						),
					),
				);
			}
			
			// XML Declaration
			$flexData = '<?xml version="1.0" encoding="iso-8859-1" standalone="yes" ?' . '>';
			
			// Add new data
			$flexData .= chr(10) . t3lib_div::array2xml($flexArray,'',0,'T3FlexForms');
			
			// Update database
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->P['table'],'uid=' . $this->P['uid'],array('pi_flexform'=>$flexData));
		}
	}
	
	// XCLASS inclusion
	if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tscobj/wiz1/index.php']) {
		include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tscobj/wiz1/index.php']);
	}
	
	// Make instance
	$SOBE = t3lib_div::makeInstance('tx_tscobj_wiz1');
	$SOBE->init();
	
	// Start module
	$SOBE->main();
	$SOBE->printContent();
?>
