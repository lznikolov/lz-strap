<div class="mainContent-miniTitle" id="inhaltsverzeichnis">
    <span class="glyphicon glyphicon-link marginRightGlyph"></span>Inhaltsverzeichnis
</div>

<div class="container relativeContainer noPadding internalNav">
    <div class="row">
        <nav class="col-xs-12 bs-docs-sidebar">
            <ul id="sidebar" class="nav nav-stacked">
                <?php
                echo '
                    <li><a href="#h1" class="internalNav-anchor">
                        <span class="vertical-align">'.$GLOBALS['ctaAnchorTitles'][0].'</span>
                    </a></li>';
                $hAnchorsCount = 0;
                foreach ((array) $GLOBALS['ctaAnchorTitles'] as $key => $value) {
                    if ($key < 1) {
                        continue;
                    }
                    else {
                        echo '
                        <li><a href="#hAnchor' . $hAnchorsCount . '" class="internalNav-anchor"><span class="vertical-align">' . $value . '</span></a></li>
                        ';
                        $hAnchorsCount++;
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
</div>