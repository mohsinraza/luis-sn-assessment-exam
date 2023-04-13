<?php

    $img_url = sn_get_small_logo_url();
    $img_class = 'default_image';
    $upgrade_url = $card_settings['product_url'] . '&' . sn_get_cart_parameters() . '&currency=' . $card_settings['product_currency_code'];

    if ($card_settings['has_nclex']) {
        $class_cover="pricing_option_card--nclex__cover";
        $header_title = "<strong>NCLEX<sup>®</sup> Preparation</strong><br> Membership";
    } else {
        $class_cover="pricing_option_card--simplenursing__cover";
        $header_title = "<strong>SimpleNursing Premium</strong><br> Membership";
    }

?>

<div class="pricing_option_card pricing_option_card--simplenursing mt-4">
    <a href="<?php echo $upgrade_url ?>">
        <div class="pricing_option_card__cover <?php echo $class_cover ?>">
            <span class="pricing_option_card__plan_name"><?php echo $card_settings['product_name'] ?></span>
            <br />for <strong><?php echo $card_settings['product_currency'] .  $card_settings['product_price'] ?></strong>
        </div>
        <div class="pricing_option_card__description pricing_option_card--simplenursing__description">
            <div class="btn">
                Upgrade Now
            </div>
        </div>
    </a>
</div>
