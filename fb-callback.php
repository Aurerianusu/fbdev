<?php
    /**
     * Created by PhpStorm.
     * User: Guigui
     * Date: 21/01/2017
     * Time: 21:30
     */
    session_start();
    require_once __DIR__.'/vendor/autoload.php';
    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
        'status' => true
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // There was an error communicating with Graph
        echo $e->getMessage();
        exit;
    }

    if (isset($accessToken)) {
        // User authenticated your app!
        // Save the access token to a session and redirect
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // Log them into your web framework here . . .
        // Redirect here . . .
        header('Location: participation.php');
        exit;
    } elseif ($helper->getError()) {
        // The user denied the request
        // You could log this data . . .
        var_dump($helper->getError());
        var_dump($helper->getErrorCode());
        var_dump($helper->getErrorReason());
        var_dump($helper->getErrorDescription());
        // You could display a message to the user
        // being all like, "What? You don't like me?"
        exit;
    }

    // If they've gotten this far, they shouldn't be here
    http_response_code(400);
    exit;
?>

