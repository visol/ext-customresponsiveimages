<?php
namespace Visol\Customresponsiveimages\Hook;

/**
 * This file is part of the TYPO3 CMS project.
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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Add additional items to the tt_content imageorient
 *
 * @author	Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @package	TYPO3
 * @subpackage	tx_customresponsiveimages
 */
class ImageorientItemsProcFunc {

	/**
	 * @param $imageorientConfig
	 * @return array
	 */
	public function setImageorientItems(&$imageorientConfig) {
		$pageTsConfig = BackendUtility::getPagesTSconfig(GeneralUtility::_GET('id'));
		$pageTsConfig = GeneralUtility::removeDotsFromTS($pageTsConfig);

		if (array_key_exists('tx_customresponsiveimages', $pageTsConfig)) {
			$responsiveImageConfiguration = $pageTsConfig['tx_customresponsiveimages'];
		} else {
			$responsiveImageConfiguration = array();
		}

		$groupedItems = array();
		$i = 0;
		foreach ($responsiveImageConfiguration['items'] as $imageorient => $item) {
			$groupedItems[$item['group']][$i][] = $GLOBALS['LANG']->sL($item['label']);
			$groupedItems[$item['group']][$i][] = $imageorient;
			$groupedItems[$item['group']][$i][] = array_key_exists('icon', $item) && !empty($item['icon']) ? $responsiveImageConfiguration['seliconsPath'] . $item['icon'] : NULL;
			$i++;
		}

		$imageOrientItems = array();
		foreach ($responsiveImageConfiguration['groups'] as $groupName => $group) {
			if (array_key_exists('label', $group) && !empty($group['label'])) {
				$imageOrientItems[] = array($GLOBALS['LANG']->sL($group['label']), '--div--');
			}
			if (array_key_exists($groupName, $groupedItems)) {
				foreach ($groupedItems[$groupName] as $item) {
					array_push($imageOrientItems, $item);
				}
			}

		}

		$imageorientConfig['items'] = $imageOrientItems;
	}

}
