<?php

require '../vendor/autoload.php';

function fizzBuzz($a, $b) {
    $result = array();
    if( $a >= $b ) {
        return $result;
    }
    for( $i = $a; $i <= $b; $i++ ) {
        if( $i % 3 == 0 && $i % 5 == 0 ) {
            $result[$i] = 'FizzBuzz';
        }
        else if( $i % 3 == 0 ) {
            $result[$i] = 'Fizz';
        }
        else if( $i % 5 == 0 ) {
            $result[$i] = 'Buzz';
        }
        else
        {
            $result[$i] = $i;
        }
    }
    return $result;
}

$app = new \Slim\Slim();

$app->get('/fizzbuzz/:input+', function($input) use ($app) {
    // extract start and stop numbers from $input
    $range = explode(',', $input[0]);
    $result = fizzbuzz($range[0], $range[1]);

    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response['X-Powered-By'] = 'PHP 5, Slim Framework, OpenShift';

    echo json_encode( implode("\n", $result));
});

$app->get('/', function() {
    ?>
    <!html><head><meta charset="utf-8"><title>FBaaS</title><body>
    <h1>FBaaS</h1>
    <p>Please review the specification for 
        <a href="https://github.com/tomjakubowski/fbaas">FizzBuzz as
        a service</a>.
    </p></body></html>
    <?
});

$app->run();