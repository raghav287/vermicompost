<?php
/**
 * PayU Configuration File
 * 
 * Replace the credentials with your actual PayU Merchant Key and Salt.
 * For testing, use the Sandbox credentials provided by PayU.
 */

// Set to 'test' for Sandbox mode, 'live' for Production mode
define('PAYU_MODE', 'test'); 

// PayU Merchant Credentials (Use environment variables for security)
define('PAYU_MERCHANT_KEY', getenv('PAYU_MERCHANT_KEY') ?: 'YOUR_MERCHANT_KEY');
define('PAYU_MERCHANT_SALT', getenv('PAYU_MERCHANT_SALT') ?: 'YOUR_MERCHANT_SALT');

// PayU Base URLs
define('PAYU_TEST_URL', 'https://test.payu.in/_payment');
define('PAYU_LIVE_URL', 'https://secure.payu.in/_payment');

// Success and Failure URLs
// Replace 'http://localhost/Vermicompost/' with your actual site URL
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/Vermicompost/";
define('PAYU_SUCCESS_URL', $base_url . 'success.php');
define('PAYU_FAILURE_URL', $base_url . 'failure.php');

/**
 * Function to generate PayU Hash
 * Format: sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT)
 */
function generatePayUHash($params, $salt) {
    $hash_string = $params['key'] . '|' . $params['txnid'] . '|' . $params['amount'] . '|' . $params['productinfo'] . '|' . $params['firstname'] . '|' . $params['email'] . '|||||||||||' . $salt;
    return strtolower(hash('sha512', $hash_string));
}

/**
 * Function to verify PayU Response Hash
 * Format: sha512(SALT|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key)
 */
function verifyPayUHash($params, $salt) {
    $status = $params['status'];
    $firstname = $params['firstname'];
    $amount = $params['amount'];
    $txnid = $params['txnid'];
    $productinfo = $params['productinfo'];
    $email = $params['email'];
    $key = $params['key'];
    
    // Additional UDFs if used (currently empty in our implementation)
    $udf1 = $params['udf1'] ?? '';
    $udf2 = $params['udf2'] ?? '';
    $udf3 = $params['udf3'] ?? '';
    $udf4 = $params['udf4'] ?? '';
    $udf5 = $params['udf5'] ?? '';

    $hash_string = $salt . '|' . $status . '||||||' . $udf5 . '|' . $udf4 . '|' . $udf3 . '|' . $udf2 . '|' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
    
    $sent_hash = $params['hash'];
    $calculated_hash = strtolower(hash('sha512', $hash_string));
    
    return ($sent_hash === $calculated_hash);
}
?>
