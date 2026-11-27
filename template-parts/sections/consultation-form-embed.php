<?php
if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_script('leadconnector-form-embed');
?>
<iframe
    src="https://api.leadconnectorhq.com/widget/form/hkAoJptF0VSu3fKDMUKU"
    id="inline-hkAoJptF0VSu3fKDMUKU"
    data-layout="{'id':'INLINE'}"
    data-trigger-type="alwaysShow"
    data-trigger-value=""
    data-activation-type="alwaysActivated"
    data-activation-value=""
    data-deactivation-type="neverDeactivate"
    data-deactivation-value=""
    data-form-name="RR website form"
    data-height="459"
    data-layout-iframe-id="inline-hkAoJptF0VSu3fKDMUKU"
    data-form-id="hkAoJptF0VSu3fKDMUKU"
    title="Request a consultation form">
</iframe>
<?php $privacy_policy_url = get_privacy_policy_url(); ?>
<?php if ($privacy_policy_url) : ?>
    <p class="business-enquiry-privacy">Your details are handled according to our <a href="<?php echo esc_url($privacy_policy_url); ?>">privacy policy</a>.</p>
<?php endif; ?>
