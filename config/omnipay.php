<?php
return [

	'gateways' => [
    	'paypal' => [
	        'driver'  => 'PayPal_Express',
    	    'options' => [
        	    'username'  => env( 'OMNIPAY_PAYPAL_EXPRESS_USERNAME', 'filonuse_api1.gmail.com' ),
            	'password'  => env( 'OMNIPAY_PAYPAL_EXPRESS_PASSWORD', '1369045494' ),
	            'signature' => env( 'OMNIPAY_PAYPAL_EXPRESS_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A6MKtA10tc-9OK8-JQ5vm7fy0vRe' ),
    	        'solutionType' => env( 'OMNIPAY_PAYPAL_EXPRESS_SOLUTION_TYPE', 'Sale' ),
        	    'landingPage'    => env( 'OMNIPAY_PAYPAL_EXPRESS_LANDING_PAGE', 'http://gogo.softaddicts.com/' ),
            	'headerImageUrl' => env( 'OMNIPAY_PAYPAL_EXPRESS_HEADER_IMAGE_URL', 'http://gogo.softaddicts.com/img/logo.png' ),
	            'brandName' =>  'GoGoFlorida',
    	        'testMode' => env( 'OMNIPAY_PAYPAL_TEST_MODE', true )
        	]
	    ],
	    'stripe' => [
    	    'driver'  => 'Stripe',
        	'options' => [
	            'apiKey'  => env( 'OMNIPAY_PAYPAL_EXPRESS_USERNAME', 'filonuse_api1.gmail.com' ),
    	    ]
		],

	    'braintree' => [
    	    'driver'  => 'Braintree',
        	'options' => [
				'merchantId' => 'ty76rv9k3cmpts4w',
				'publicKey' => 'vzrz6y7w45vyhqqk',
				'privateKey' => 'c65251333dde2c6b5fd135ac43a99ced',
				'testMode' => true,
			]
		],
	
    ],
]

?>