<div id="popupFreeBetlist" style="padding-left: 30px; padding-right: 30px;">

    <div class="bonusinfo listcurrb col-xs-12 noPadding" style="margin-top: -30px;">
        <h4><span>AKTUELLE WETTBONUS ANGEBOTE OHNE EINZAHLUNG</span></h4>
    </div>
    <div class="col-xs-12 bonusinfoTable noPadding" style="color: #333; margin-bottom: 15px;">
        <?php
        $fblCounter = 0;
        $fblMaxCoun = 500;
        foreach($GLOBALS['DB']['operators'] as $key => $value){
            foreach($value['bonuses'] as $x => $y){
                if (($y['options']['type'] == 'No-Deposit') && ($fblCounter < $fblMaxCoun)) {
                    $fblCounter++;
                    ?>
                    <div class="row" id="roww">
                    <div class="col-sm-3 col-xs-4">
                        <a href="<?php echo getUrl($value['shortname'], 1); ?>" style="display: inline-block">

                            <img src="/assets/images/logos_105x53/'.str_replace(" ","-",strtolower($value['shortname']));?>_105x53.png" style="max-width: 95%;">
                        </a>
                    </div>
                    <div class=" col-sm-4 col-xs-6" style="margin-top: 5px; font-weight: bold;">
                        <a href="<?php echo getUrl($value['shortname'], 1) ?>" class="title" style="color: #333; text-transform: uppercase; font-size: 0.8em;">
                            <?php echo $value['shortname'].' GUTSCHEIN ohne Einzahlung';?>
                        </a>
                    </div>
                    <div class=" col-sm-1 col-xs-2" style="padding-top: 7px; font-weight: bold; font-size: 0.8em;" >
                        <?php if (is_numeric($y['options']['amount']['eur'])) { ?>
                            <span class="nodepositbonus" id="bonusImg"><?php echo $y['options']['amount']['eur'];?>€</span>
                        <?php } else  {?>
                            <span class="nodepositbonus" id="bonusImg"><?php echo $y['options']['amount']['usd'];?>$</span>
                        <?php }?>
                    </div>
                    <div class="col-sm-4 col-xs-12 text-center">
                        <a href="<?php echo getUrl($value['shortname'], 1) ?>" class="buttons-smGreen buttons-orangeGrad hvr-wobble-horizontal" id="btgobutton" style="margin-top: 7px;">
                            ANZEIGEN <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    </div><?php
                }
            }
        }
        ?>
    </div></div>