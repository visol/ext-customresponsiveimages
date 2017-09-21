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

/**
 * Userfunc to get responsive image widths
 *
 * @author    Jonas Renggli <jonas.renggli@visol.ch>
 * @author    Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @package    TYPO3
 * @subpackage    tx_customresponsiveimages
 */
class Images
{

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    public $cObj;

    /**
     * Image aspect ratio for galleries
     *
     * @var float
     */
    private $galleryAspectRatio;

    /**
     * Configuration for collections, built from TypoScript
     *
     * @var array
     */
    private $collections;

    public function buildCollectionsFromConfiguration()
    {
        $responsiveImageConfiguration = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_customresponsiveimages.'];
        $responsiveImageConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::removeDotsFromTS($responsiveImageConfiguration);

        $this->galleryAspectRatio = $responsiveImageConfiguration['galleryAspectRatio'];

        foreach ($responsiveImageConfiguration['colPosWidths'] as $collectionName => $colPosWidths) {
            $this->collections[$collectionName]['colPosWidths'] = $colPosWidths;
            foreach ($responsiveImageConfiguration['widthFactorByImageorient'] as $imageorient => $widthFactorByImageorient) {
                if (is_array($widthFactorByImageorient)) {
                    // The factor changes from collection to collection, e.g. because a picture that is 1/16 size on desktop becomes 1/4 on mobile
                    if (array_key_exists($collectionName, $widthFactorByImageorient)) {
                        $this->collections[$collectionName]['widthFactorByImageorient'][$imageorient] = $widthFactorByImageorient[$collectionName];
                    } elseif (array_key_exists('default', $widthFactorByImageorient)) {
                        // If configuration for current collection is missing, switch to default if available
                        $this->collections[$collectionName]['widthFactorByImageorient'][$imageorient] = $widthFactorByImageorient['default'];
                    } else {
                        // fall back to fallbackWidth
                        $this->collections[$collectionName]['widthFactorByImageorient'][$imageorient] = $responsiveImageConfiguration['fallbackWidth'];
                    }
                } else {
                    // The factor is identical for all collections
                    $this->collections[$collectionName]['widthFactorByImageorient'][$imageorient] = $widthFactorByImageorient;
                }
            }
            foreach ($responsiveImageConfiguration['cropConfiguration'] as $imageorient => $cropConfiguration) {
                $this->collections['cropConfiguration'][$imageorient] = $cropConfiguration;
            }
        }
    }

    /**
     * Get image width based on colPos and imageorient
     *
     * @param string $content
     * @param array $conf
     * @return string
     */
    public function getImageWidth($content = '', $conf = [])
    {
        $conf = $conf['userFunc.'];

        $this->buildCollectionsFromConfiguration();

        $collection = $this->cObj->cObjGetSingle($conf['collection'], $conf['collection.']);
        $colPos = $this->cObj->cObjGetSingle($conf['colPos'], $conf['colPos.']);
        $imageorient = $this->cObj->cObjGetSingle($conf['imageorient'], $conf['imageorient.']);

        $collectionSettings = array_key_exists($collection,
            $this->collections) ? $this->collections[$collection] : $this->collections['default'];

        $width = array_key_exists($colPos,
            $collectionSettings['colPosWidths']) ? $collectionSettings['colPosWidths'][$colPos] : $collectionSettings['colPosWidths'][0];
        $factor = array_key_exists($imageorient,
            $collectionSettings['widthFactorByImageorient']) ? $collectionSettings['widthFactorByImageorient'][$imageorient] : 1;
        $width = $width * $factor;

        return floor($width);
    }

    /**
     * Get the cropped image width based on colPos and imageorient
     * e.g. 300c
     *
     * @param string $content
     * @param array $conf
     * @return string
     */
    public function getCroppedImageWidth($content = '', $conf = [])
    {
        $width = $this->getImageWidth($content, $conf);
        $croppedImageWidth = floor($width) . $this->getCropValue($conf);
        return $croppedImageWidth;
    }

    /**
     * Get the cropped image height based on colPos and imageorient
     * respecting the defined aspect ratio
     * e.g. 200c
     *
     * @param string $content
     * @param array $conf
     * @return string
     */
    public function getCroppedImageHeight($content = '', $conf = [])
    {
        $width = $this->getImageWidth($content, $conf);
        if ($this->galleryAspectRatio > 0) {
            $croppedImageHeight = floor($width * $this->galleryAspectRatio) . $this->getCropValue($conf);
        } else {
            // If the galleryAspectRatio is 0, this means we want original proportions, so we return 0 as height
            $croppedImageHeight = 0;
        }
        return $croppedImageHeight;
    }

    /**
     * Return the image crop suffix ("c") if set for the current imageorient
     *
     * @param $conf
     * @return mixed
     */
    public function getCropValue($conf)
    {
        $conf = $conf['userFunc.'];
        $imageorient = $this->cObj->cObjGetSingle($conf['imageorient'], $conf['imageorient.']);
        $crop = $this->collections['cropConfiguration'][$imageorient];
        return $crop;
    }

}
