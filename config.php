<?php

require('stripe-php-master/init.php');

$publishable_key="pk_test_51O52KpSCQnrG2GyfIkYFyeRBpv6ceVuDRuuraUHLEcVmfYueqmLOxpIBFIGG2Cbi6VA3LsaB7P33LfIIAg7vbBy9001SaFvRb9";

$secret_key="sk_test_51O52KpSCQnrG2GyfMO8KNaBohtCIzauXKLwofSf8cY4x1BdiO8WwUCNWj9COsVb7Uod4L6TtkV0lJRESJXTg9Era00Z3v6W3hI";

$stripe= new \Stripe\StripeClient($secret_key);


?>