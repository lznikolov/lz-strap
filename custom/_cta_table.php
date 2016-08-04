<!-- BONUS TABLE-->
<div class="row" id="bonus_table">
    <div class="col-sm-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" id="liTab1" class="active">
                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Wettgutscheine</a>
            </li>
            <li role="presentation" id="liTab2">
                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Gutscheine ohne Einzahlung</a>
            </li>
            <li role="presentation" id="liTab3">
                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Handy Gutscheine</a>
            </li>
        </ul>

        <?php
        $include1 = 'wp-content/themes/mini-strap/custom/table/tab1.php';
        $include2 = 'wp-content/themes/mini-strap/custom/table/tab2.php';
        $include3 = 'wp-content/themes/mini-strap/custom/table/tab3.php';
        ?>

        <!-- Tab panes -->
        <div class="tab-content">
            <!--Tab 1-->
            <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                <?php include($include1); ?>
            </div>
            <!--Tab 2-->
            <div role="tabpanel" class="tab-pane fade" id="tab2">
                <?php include($include2); ?>
            </div>
            <!--Tab 3-->
            <div role="tabpanel" class="tab-pane fade" id="tab3">
                <?php include($include3); ?>
            </div>
        </div>
    </div>
</div>