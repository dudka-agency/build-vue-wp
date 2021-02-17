<?php

add_action('wp_ajax_test_api', 'test_api');
add_action('wp_ajax_nopriv_test_api', 'test_api');

function test_api() {

    echo json_encode('success!');

    wp_die();
}
