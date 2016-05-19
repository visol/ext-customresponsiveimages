Custom Responsive Images for TYPO3 CMS
==========================================

This extension provides a set of configurations for responsive images in TYPO3 considering the column width of the content.

Installation
------------
* Install extension
* Activate "enableDefaultConfiguration" in EM if you want presets in the Text w/image and Image elements to be loaded automatically. If you don't do this, you will need to take care of adding items to the "imageorient" fields yourself.
* Add the Static TypoScript file.
* Embed Resources/Public/JavaScript/picturefill.3.0.1.min.js to your website.
* Add CSS styles. You can also use the Less file in Resources/Private/Stylesheets.

**Important:** Since responsive image use is complex and needs to be adapted for each website, this is not just a plug and play extension (and not intended to be one).

Customize
----------
The default TSconfig delivers presets for a lot of combinations:

* Full width images above and below text
* 50%/33%/25%/12.5% images in text or besides text
* Galleries with 2, 3, 4 or 6 pictures in a row

You can add additional items or remove items using Page TSConfig, see ```tx_customresponsiveimages.items```.

The output configuration is done in ```plugin.tx_customresponsiveimages```. By default, 6 variants of an image are generated:

* Default variant for screen sizes > 991px
* Middle variant for screen sizes > 414px and < 991 px
* Small variant for screen sizes < 415px
* A hi-res variant for each of these variants generating pictures with the double size.

The size of an image depends on the column it is located in. Therefore, the maximum size needs to be set for each column and for each collection. Please make sure that you define the maximum width for each collection and colPos in ```colPosWidths```. If this is missing, it falls back to the ```fallbackWidth``` (default: 1000px).

The ```widthFactorByImageOrient``` defines the factor that is used to determine the width of a generated image.

**Example:**

* The maximum width of the column is 800 pixels.
* The imageorient is "In text 1/4" (value: 122).
* The image must have a size of 200 pixels because it needs to cover 1/4 of the maximum width. Therefore the factor is 0.25.


    plugin.tx_customresponsiveimages {
    	widthFactorByImageorient {
    	    122 = 0.25
        }
    }

In some cases, you might want to define different factors for different collections, e.g. because you want an image that has 25% size on a desktop be displayed as a 50% image on a Smartphone. While you will adjust the visual output by a CSS media query, you will also need a bigger picture than calculated. 

**Example:**

* The maximum width of column 0 is 800 pixels on Desktop, 600 pixels on medium size devices and 400 pixels on smartphones.
* The imageorient is "In text 1/4" (value: 122).
* The default and medium version of the image should be 1/4 the size of the column, the small version should be 1/2 the size of the column.


    plugin.tx_customresponsiveimages {
    	widthFactorByImageorient {
	    	122 {
	    		default = 0.25
	    		# on a small device, maximum width is 1/2
	    		small = 0.5
		}
        }
    }

This will generate the following versions of the image:

* Default/desktop version 800 * 0.25 = 200 Pixels
* Middle version 600 * 0.25 = 150 Pixels
* Smartphone version 400 * 0.5 = 200 Pixels
* Its retina versions

Galleries
---------

For galleries, you will most likely have the thumbnails with identical sizes. Therefore, by default a special configuration (galleryDefault, galleryMiddle, gallerySmall) is applied to all gallery presets (imageorient 160, 161, 162, 163).

The thumbnail width is determined the same way normal images are. The thumbnail height is determined by the ```galleryAspectRatio``` configuration. It is set to 0.666666 (2/3) by default. If you want e.g. square thumbnails, you can set it to 1.

Most likely, you will want to crop the thumbnails instead of squashing them. Therefore, you can set the ```cropConfiguration``` for these styles. So if you want to crop thubnails for all default gallery types, you can just use the default:


    plugin.tx_customresponsiveimages {
    	cropConfiguration {
	    	160 = c
	    	161 = c
	    	162 = c
	    	163 = c
    	}
    }

**Example:**

* You have a gallery with 4 images in a row (imageorient 142) in colPos 0 and the default width of this column is 800px.
* Each gallery image will have a width of 200px.
* Because the aspectRatio is set to 0.66666 by default and the cropConfiguration is set, your thumbnails will be cropped and have 200*132 pixels size.

**Hint:**

If the ```galleryAspectRatio``` is set to 0, the images in the gallery maintain their original proportions and the cropConfiguration is ignored.

Drawbacks
----------

For an optimal image output, this solution requires that a colPos is only used once, even if you use different backend layouts.

**Example:**

* You have a backend layout "Full width", where colPos 0 is displayed with a maximum size of 1000 pixels. You have another backend layout "50%/50%", where colPos 0 is displayed with a maximum size of 500 pixels.
* In this case, you need to set the maximum size for this column to 1000 pixels. As a consequence, the images for your backend layout "50%/50%" are unnecessarily twice as big as needed.

Credits
--------

Developed by visol digitale Dienstleistungen GmbH, www.visol.ch

Uses the ```<picture>``` tag for responsive image rendering and the pictureFill solution at https://github.com/scottjehl/picturefill (version 3).
