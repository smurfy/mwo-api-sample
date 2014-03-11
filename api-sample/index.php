<?php
/**
 * mwo.smurfy-net.de API Sample
 *
 * This sample uses curl to do the oauth and rest requests.
 * I really urge you to use something better. there are great libraries out there.
 */

$options = array(
    'host' => 'https://mwo.smurfy-net.de/api/', //Only user related stuff needs https but its easier to use it everywhere
    'users-api-key' => 'put your api key here!',
);

$s = isset($_GET['s']) ? $_GET['s'] : '';

switch ($s) {
    case 'loadout':
        $data = curlhelper($options['host'] . 'data/mechs/17/loadouts/stock.json');
	    print '<pre>';
            var_dump(json_decode($data));
        print '</pre>';
        break;
    case 'postloadout':
        $data = curlhelper($options['host'] . 'data/mechs/17/loadouts/stock.json');
        $ret = curlhelper($options['host'] . 'data/mechs/17/loadouts.json', $data);
        var_dump($ret);
        break;
    case 'mechbay':
        $data = curlhelper($options['host'] . 'data/user/mechbay.json', null, $options['users-api-key']);
        print '<pre>';
        var_dump(json_decode($data));
        print '</pre>';
        break;
    default:
        echo <<< EOF
        Hello to the very simple api sample<br/>
        <p>
        I will show you here two of the possible access methods.
        If you only want to load loadouts of mechs and don't need access to a users mechbay option one is it for you.
        If you also need access to a users mechbay and the username try the second option.
        </p>

        <ul>
            <li><a href="?s=loadout">Access a loadout from the server</a></li>
            <li><a href="?s=postloadout">Send a new loadout to the server</a></li>
            <li><a href="?s=mechbay">Access a users mechbay (you need to set the api-key)</a></li>
        </ul>
EOF;
        break;
}

function curlhelper($url, $post = null, $apiKey = null)
{
    $curl = curl_init();
    if (!empty($apiKey)) {
        curl_setopt($curl,CURLOPT_HTTPHEADER, array('Authorization: APIKEY ' . $apiKey));
    }
    if (!empty($post)) {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);
    $response = curl_exec($curl);
    return $response;
}
