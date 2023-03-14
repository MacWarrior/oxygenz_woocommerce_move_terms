<?php
/*
Plugin Name: Oxygenz - Woocommerce : Move terms
Description: Move terms before payment on checkout page
Version: 1.0
Author: Oxygenz
*/

add_filter( 'woocommerce_checkout_show_terms', 'disable_woocommerce_checkout_show_terms_filter');
function disable_woocommerce_checkout_show_terms_filter(){
        return false;
}

add_action('woocommerce_review_order_before_payment', 'move_terms_and_conditions', 90);
function move_terms_and_conditions()
{
    if ( wc_terms_and_conditions_checkbox_enabled() ) : ?>
        <p class="form-row validate-required">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // WPCS: input var ok, csrf ok. ?> id="terms" />
                <span class="woocommerce-terms-and-conditions-checkbox-text"><?php wc_terms_and_conditions_checkbox_text(); ?></span>&nbsp;<abbr class="required" title="<?php esc_attr_e( 'required', 'woocommerce' ); ?>">*</abbr>
            </label>
            <input type="hidden" name="terms-field" value="1" />
        </p>
<?php
    endif;
}
