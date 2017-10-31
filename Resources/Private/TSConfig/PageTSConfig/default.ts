TCAdefaults.tt_content {
	imageorient = 100
	imagecols = 1
}

TCEFORM.tt_content {
	imagewidth.disabled = 1
	imageheight.disabled = 1
	imageborder.disabled = 1
	imagecaption_position.disabled = 1
	image_noRows.disabled = 1
	imagecols.disabled = 1
}

tx_customresponsiveimages {
	seliconsPath = EXT:customresponsiveimages/Resources/Public/Icons/selicons/
	groups {
		abovetext {
			# Empty label means that there will be no optgroup
			label =
		}
		belowtext {
			# Empty label means that there will be no optgroup
			label =
		}
		intext {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:group.intext.label
		}
		besidetext {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:group.besidetext.label
		}
		gallery {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:group.gallery.label
		}
	}
	items {
		# Group "abovetext"
		100 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.abovetext.100
			icon = above-100.gif
			group = abovetext
		}
		101 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.abovetext.50
			group = abovetext
		}
		102 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.abovetext.33
			group = abovetext
		}
		103 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.abovetext.25
			group = abovetext
		}
		# Group "belowtext"
		110 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.belowtext.100
			icon = below-100.gif
			group = belowtext
		}
		111 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.belowtext.50
			group = belowtext
		}
		112 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.belowtext.33
			group = belowtext
		}
		113 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.belowtext.25
			group = belowtext
		}
		# Group "intext"
		120 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.left.50
			icon = intext-left-50.gif
			group = intext
		}
		121 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.left.33
			icon = intext-left-33.gif
			group = intext
		}
		122 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.left.25
			icon = intext-left-25.gif
			group = intext
		}
		123 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.left.12
			group = intext
		}
		130 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.right.50
			icon = intext-right-50.gif
			group = intext
		}
		131 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.right.33
			icon = intext-right-33.gif
			group = intext
		}
		132 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.right.25
			icon = intext-right-25.gif
			group = intext
		}
		133 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.intext.right.12
			group = intext
		}
		# Group "besidetext"
		140 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.left.50
			icon = besidetext-left-50.gif
			group = besidetext
		}
		141 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.left.33
			icon = besidetext-left-33.gif
			group = besidetext
		}
		142 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.left.25
			icon = besidetext-left-25.gif
			group = besidetext
		}
		143 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.left.12
			group = besidetext
		}
		150 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.right.50
			icon = besidetext-right-50.gif
			group = besidetext
		}
		151 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.right.33
			icon = besidetext-right-33.gif
			group = besidetext
		}
		152 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.right.25
			icon = besidetext-right-25.gif
			group = besidetext
		}
		153 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.besidetext.right.12
			group = besidetext
		}
		# Group "gallery"
		160 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.gallery.2
			icon = gallery-2.gif
			group = gallery
		}
		161 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.gallery.3
			group = gallery
		}
		162 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.gallery.4
			icon = gallery-4.gif
			group = gallery
		}
		163 {
			label = LLL:EXT:customresponsiveimages/Resources/Private/Language/locallang.xlf:item.gallery.6
			group = gallery
		}
	}
}