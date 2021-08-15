<?php
function alu_scripts()
{
    if (is_single() || is_page()) {
        wp_enqueue_script('alu', ALU_CDN . "/static/js/index.js", array(), ALU_VERSION);
        wp_enqueue_script('alu', ALU_CDN . "/static/css/style.css", array(), ALU_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'alu_scripts', 20, 1);

add_filter('smilies_src', 'alu_smilies_src', 1, 10);
function alu_smilies_src($img_src, $img, $siteurl)
{
    $img = rtrim($img, "gif");
    return ALU_CDN . '/static/img/' . $img . 'gif';
}

function alu_get_wpsmiliestrans()
{
    global $wpsmiliestrans;
    $wpsmilies = array_unique($wpsmiliestrans);
    $output = '';
    foreach ($wpsmilies as $alt => $src_path) {
        $output .= '<a class="add-smile" data-action="addSmile" data-smilies="' . $alt . '"><img class="wp-smiley" src="' . ALU_CDN . '/static/img/' . $src_path . '" /></a>';
    }
    return $output;
}

function alu_smilies_reset()
{
    global $wpsmiliestrans, $wp_smiliessearch;

    if (!get_option('use_smilies'))
        return;

    $wpsmiliestrans = array(
        ':mrgreen:' => 'Alu/icon_mrgreen.gif',
        ':neutral:' => 'Alu/icon_neutral.gif',
        ':twisted:' => 'Alu/icon_twisted.gif',
        ':arrow:' => 'Alu/icon_arrow.gif',
        ':shock:' => 'Alu/icon_eek.gif',
        ':smile:' => 'Alu/icon_smile.gif',
        ':???:' => 'Alu/icon_confused.gif',
        ':cool:' => 'Alu/icon_cool.gif',
        ':evil:' => 'Alu/icon_evil.gif',
        ':grin:' => 'Alu/icon_biggrin.gif',
        ':idea:' => 'Alu/icon_idea.gif',
        ':oops:' => 'Alu/icon_redface.gif',
        ':razz:' => 'Alu/icon_razz.gif',
        ':roll:' => 'Alu/icon_rolleyes.gif',
        ':wink:' => 'Alu/icon_wink.gif',
        ':cry:' => 'Alu/icon_cry.gif',
        ':eek:' => 'Alu/icon_surprised.gif',
        ':lol:' => 'Alu/icon_lol.gif',
        ':mad:' => 'Alu/icon_mad.gif',
        ':sad:' => 'Alu/icon_sad.gif',
        '8-)' => 'Alu/icon_cool.gif',
        ':-(' => 'Alu/icon_sad.gif',
        ':-)' => 'Alu/icon_smile.gif',
        ':-?' => 'Alu/icon_confused.gif',
        ':-D' => 'Alu/icon_biggrin.gif',
        ':-P' => 'Alu/icon_razz.gif',
        ':-o' => 'Alu/icon_surprised.gif',
        ':-x' => 'Alu/icon_mad.gif',
        ':-|' => 'Alu/icon_neutral.gif',
        ';-)' => 'Alu/icon_wink.gif',
        ':(' => 'Alu/icon_sad.gif',
        ':)' => 'Alu/icon_smile.gif',
        ':?' => 'Alu/icon_confused.gif',
        ':|' => 'Alu/icon_neutral.gif',
        ':!:' => 'Alu/icon_exclaim.gif',
        ':?:' => 'Alu/icon_question.gif',
    );
}
add_action('init', 'alu_smilies_reset');


add_filter('comment_form_defaults', 'alu_add_smilies_to_comment_form');
function alu_add_smilies_to_comment_form($default)
{
    $commenter = wp_get_current_commenter();
    $default['comment_field'] .= '<p class="comment-form-smilies">' . alu_get_wpsmiliestrans() . '</p>';
    return $default;
}
