<?php

    global $sn_current_user;
    $is = New SN_INFUSIONSOFT();

    if (is_null($sn_current_user)) return;

    $infusionsoft_duration = get_field('infusionsoft_membership_duration', 'options');
    $user_is_id=$sn_current_user->get_infusionsoft_id();
    $user_tags = $is->get_user_tags($user_is_id);

    $user_tags  = new \stdClass();
    $user_tags->tags = array();
    $user_tags->tags[0] = new \stdClass();
    $user_tags->tags[0]->tag = New \stdClass();
    $user_tags->tags[0]->tag->id = -1; //special tag ID for this upgrade

    $upgrade_cards=get_upgrade_cards($infusionsoft_duration, $user_tags);

    $class_cover="pricing_option_card--nclex__cover";
    $header_title = "<strong>NCLEX<sup>®</sup> Preparation</strong><br> Membership";
?>

<div class="modal fade" id="modalNclexUpgrade" tabindex="-1" role="dialog" aria-labelledby="modalNclexUpgradeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="card--upgrade__heading text-center pb-2">
                    <h5 class="mb-0 font-weight-bold">
                        Pass the NCLEX® on your first try!
                    </h5>
                    Upgrade for full access
                </div>

                <div class="card--pricing__benefits">
                    <ul>
                        <li class="li--with-icon li--questions"><strong>1,500 NCLEX<sup>®</sup></strong> style prep questions</li>
                        <li class="li--with-icon li--video-based-rationales">In-depth, <strong>video-based</strong> rationales</li>
                        <li class="li--with-icon li--analytics"><strong>Detailed analytics</strong> tracks learning  progress and performance compared to your peers</li>
                    </ul>
                </div>

                <div class="container-fluid">
                    <div class="row">

                        <?php if(count($upgrade_cards)>0): ?>
                            <?php
                                foreach($upgrade_cards as $card):

                                    // If there is a new section, close and create another row
                                    if ($card['new_row']) echo "</div><div class='row'>";

                                    ?>
                                        <!-- cards_cta__item -->
                                        <div class="col-12 col-md-4 p-1">
                                          <?php
                                            set_query_var( 'card_settings', $card );
                                            get_template_part('template-parts/modal/modal-nclex-upgrade-card');
                                            ?>
                                        </div>
                                        <!-- /cards_cta__item -->
                                    <?php

                                    // $row++;
                                endforeach
                            ?>
                        <?php endif ?>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- .container -->

                <div class="row text-center mt-2">
                    <div class="col-12 ">
                        <a class="product-learn-more" href="https://simplenursing.com/nclex" target="_blank">Learn more about the NCLEX<sup>®</sup> membership</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<style type="text/css">

</style>
