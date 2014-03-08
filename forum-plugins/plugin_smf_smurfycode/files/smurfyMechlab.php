<?php
/**
 * smurfy MWO Mechlab plugin
 *
 * version smf 2.0*
 */

if (!defined('SMF'))
    die('-');

function smurfyMechlab_codes(&$codes)
{
    global $modSettings, $settings, $context, $txt, $scripturl;
    foreach ($codes as $tag => $dump) {
        if ($dump['tag'] == 'smurfy') {
            unset($codes[$tag]);
        }
    }
    $codes[] = array(
        'tag' => 'smurfy',
        'type' => 'unparsed_content',
        'content' => '$1',
        'validate' => create_function('&$tag, &$data, $disabled', '
            $result = preg_match(\'/i=(\d+)&l=(\w+)/\', un_htmlspecialchars($data), $matches);
            if($result === 1) {
                $data = \'<iframe src="http://mwo.smurfy-net.de/tools/mechtooltip?i=\' . $matches[1] . \'&l=\' . $matches[2] . \'" width="100%" height="300"></iframe>\';
            }
        '),
    );
}

function smurfyMechlab_buttons(&$buttons)
{
    $buttons[count($buttons) - 1][] = array(
        'image' => 'smurfy',
        'code' => 'smurfy',
        'before' => '[smurfy]',
        'after' => '[/smurfy]',
        'description' => 'Add smurfy mechlab link',
    );
}

function smurfyMechlab_menu_buttons()
{
    global $context;

    if ($context['current_action'] == 'credits')
        $context['copyrights']['mods'][] = '&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a target="_blank" href="http://mwo.smurfy-net.de/"><b>MWO-Mechlab</b></a> &copy; 2013, smurfy';
}
?>