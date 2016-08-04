<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 12:06
 */
?>
<div role="tabpanel" class="tab-pane fade <?php if ($active) echo 'in active'; ?> text-center" id="<?php echo $os; ?>_casinos">
<?php
get_template_part('partials/table', 'header');
get_template_part('partials/table', 'sorter');

//content
foreach ($appOperator as $key => $value) {
    if ($count == $numRows) {
        $isCollapsed = true;
        ?>
        <div class="collapse" role="list" id="<?php echo $os; ?>_collapseOperatorTable" aria-expanded="false">
    <?php } else { ?>
        <div class="row tab-content-operator">
            <div class="col-md-2 col-xs-12" data-operator="<?php echo $value['operator']; ?>">
                <?php if ($value['isExclusive']) { ?>
                    <div class="text-uppercase text-center"><strong>exclusive</strong></div>
                <?php } ?>
                <a href="<?php echo operatorPageURL($value['operator'], 'normal', 'table-logo-' . $os); ?>" rel="nofollow" target="_blank">
                    <img
                        src="<?php echo operatorImagePath($value['operator']); ?>"
                        alt="<?php echo $value['operator']; ?>" class="img-responsive">
                </a>
            </div>
            <div class="col-md-2 col-xs-6 col-sm-3 cursor-help">
                <div class="row">
                    <div class="col-xs-12 visible-xs-block">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group btn-group-xs" role="toolbar"
                                     aria-label="max bonus sorting">
                                    <button data-colName="amount" data-sort="asc" type="button"
                                            class="btn btn-default">
                                        <i class="fa fa-sort-asc fa-inverse" aria-hidden="true"></i>
                                    </button>
                                    <button data-colName="amount" data-sort="desc" type="button"
                                            class="btn btn-default">
                                        <i class="fa fa-sort-desc fa-inverse" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <span class="tableHelper">Max Amount</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12"
                         data-amount="<?php echo filter_var($value['maxAmount'], FILTER_SANITIZE_NUMBER_INT); ?>"
                         data-toggle="popover"
                         data-trigger="click"
                         data-placement="top"
                         data-container="#mainContent"
                         title="Details"
                         data-html="false"
                         data-content="<?php echo $value['description']; ?>">
                        <div>
                            <strong><?php echo $value['maxAmount']; ?></strong>
                        </div>
                        <img src="/assets/images/operators-table/info-button.png" alt="info"
                             style="width: 16px">
                    </div>
                </div>
            </div>

            <div class="col-md-1 col-xs-6 col-sm-2 cursor-help" data-payout="<?php echo $value['payout']; ?>">
                <div class="row">
                    <div class="col-xs-12 visible-xs-block text-center">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group btn-group-xs" role="toolbar" aria-label="pay out sorting">
                                    <button data-colName="payout" data-sort="asc" type="button"
                                            class="btn btn-default">
                                        <i class="fa fa-sort-asc fa-inverse" aria-hidden="true"></i>
                                    </button>
                                    <button data-colName="payout" data-sort="desc" type="button"
                                            class="btn btn-default">
                                        <i class="fa fa-sort-desc fa-inverse" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-12"><span class="tableHelper">Payout</span></div>
                        </div>

                    </div>
                    <div class="col-xs-12">
                        <strong><?php echo empty($value['payout']) ? "&mdash;" : round($value['payout'], 1).'%'; ?>
                            </strong></div>
                </div>

            </div>
            <div class="col-md-2 col-xs-4 col-sm-2 cursor-help">
                <div
                    role="button"
                    data-toggle="popover"
                    data-trigger="click"
                    data-placement="top"
                    data-container="#mainContent"
                    title="<?php echo __('Deposit Method', 'mini-strap'); ?>"
                    data-html="true"
                    data-content="
                            <div class='row'>
                            <?php foreach ($value['depositMethods'] as $key1 => $value1) { ?>
                                 <div>
                                    <i class='payment payment-<?php echo $value1; ?>'></i>
                                    <span class='sr-only'><?php echo $value1; ?></span>
                                 </div>
                            <?php } ?>
                            </div>">
                    <img src="/assets/images/operators-table/info-button.png" alt="info" style="width: 16px">
                    <strong><?php echo __('Show Methods', 'mini-strap'); ?></strong>
                </div>
            </div>
            <div class="col-md-1 col-xs-4 col-sm-2">
                <img
                    src="/assets/images/operators-table/live-play-<?php
                    if (empty($value['liveplay']) || is_numeric($value['liveplay'])) {
                        echo "no";
                    } else {
                        echo $value['liveplay'];
                    } ?>.png"
                    alt="live play support">
            </div>
            <div class="col-md-1 col-xs-4 col-sm-3" data-rating="<?php echo $value['rating']; ?>">
                <div class="row">
                    <div class="col-xs-12 visible-xs-block text-center"><span class="tableHelper">Rating</span>
                    </div>
                    <div class="col-xs-12">
                        <div><strong><?php echo $value['rating']; ?></strong></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="row">
                    <div
                        class="col-sm-12 text-uppercase">
                        <a href="<?php echo operatorPageURL($value['operator'], 'normal', 'table-download-button-' . $os); ?>"
                           target="_blank" rel="nofollow"
                           class="btn btn-block hvr-wobble-vertical text-uppercase">
                            <strong><?php echo _x('app-download', 'table', 'mini-strap'); ?></strong>
                        </a>
                    </div>
                    <div
                        class="col-sm-12 text-center">
                        <a href="<?php echo operatorPageURL($value['operator'], '', 'table-download-link-' . $os); ?>">
                            <?php echo $value['operator']; ?> App Info
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    $count++;
} ?>
        <?php if ($isCollapsed) { ?>
    </div>
    <div class="row toggle_bonus_boxes">
        <div class="col-sm-12"
             role="button"
             data-toggle="collapse"
             data-target="#<?php echo $os; ?>_collapseOperatorTable"
             aria-expanded="false"
             aria-controls="<?php echo $os; ?>_collapseOperatorTable">
            <div class="text-center hvr-pulse">
                <img src="/assets/images/arrowdown1orange.png" alt="toggle operators">
                <p class="text-uppercase">
                    <strong><?php echo _x('Show me more', 'table-expand','mini-strap'); ?></strong></p>
            </div>
        </div>
    </div>
<?php } ?>
</div>
