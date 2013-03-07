<?php
/**
 * mwo.smurfy-net.de API Sample
 *
 * This sample uses curl to do the oauth and rest requests.
 * I really urge you to use something better. there are great libraries out there.
 */

$options = array(
    'host' => 'http://mwo.smurfy-net.de/api/',
    'format' => 'json', //or xml
    //You will receive client_id and client_secret by sending a pm in the mwomercs.com forums (smurfynet)
    'client_id' => '',
    'client_secret' => '',
);

switch ($_GET['s']) {
    case 'srvonly':
        //First we need to get an access_token for oauth2 based on our credentials alone
        $req = array(
            'grant_type' => 'client_credentials',
            'client_id' => $options['client_id'],
            'client_secret' => $options['client_secret'],
        );
        $tokenJson = curlhelper($options['host'] . 'oauth2/token?' . http_build_query($req));
        $token = json_decode($tokenJson);
        if (property_exists($token, 'error')) {
            die('An error occured:' . htmlentities($token->error_description));
        }
        //Now we got a access_token we send a request to the server to get the stock loadout of the atlas d-dc
        $data = curlhelper($options['host'] . 'data/mechs/17/loadouts/stock.' . $options['format'] . '?access_token=' . $token->access_token);
        print '<pre>';
        var_dump(json_decode($data));
        print '</pre>';
        break;
    case 'users':
        //Setp on ask user for permission
        $req = array(
            'response_type' => 'code',
            'redirect_uri' => $_SERVER['SCRIPT_URI'] . '?s=users2',
            'client_id' => $options['client_id'],
        );
        $url = $options['host'] . 'oauth2/auth?' . http_build_query($req);
        echo <<< EOF
        We need the users permission to get the mechbay so we ask oauth2 to ask for it.

        <a href="$url">Click here to authorise!</a>
EOF;
        break;
    case 'users2':
        if (isset($_GET['error'])) {
            die('An error occured:' . htmlentities($_GET['error_description']));
        }
        //Step two we need to get an access_token for oauth2 based on the code we got
        $req = array(
            'grant_type' => 'authorization_code',
            'client_id' => $options['client_id'],
            'client_secret' => $options['client_secret'],
            'code' => $_GET['code'],
            'redirect_uri' => $_SERVER['SCRIPT_URI'] . '?s=users2',
        );
        $tokenJson = curlhelper($options['host'] . 'oauth2/token?' . http_build_query($req));
        $token = json_decode($tokenJson);
        if (property_exists($token, 'error')) {
            die('An error occured:' . $token->error_description);
        }
        //Now we got a access_token we send a request to the server to get the users mechbay
        $data = curlhelper($options['host'] . 'data/user/mechbay.' . $options['format'] . '?access_token=' . $token->access_token);
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
            <li><a href="?s=srvonly">Access to mechlab but not to user</a></li>
            <li><a href="?s=users">Access to mechlab with access to users mechbay</a></li>
        </ul>
EOF;
        break;
}

function curlhelper($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);
    $response = curl_exec($curl);
    return $response;
}