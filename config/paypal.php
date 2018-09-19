<?php
return [ 
   // set your paypal credential 
    'client_id' => env('PAYPAL_CLIENT_ID','AUc1mET6ZCTUcf2nbz2K6Q4s4IAowoG4aafzzsMWpggUnO296idZHgNAAzWcgA36cE_zQgzeWaQBNPXK'),
    'secret' => env('PAYPAL_SECRET','EA6GKeVXt9lbpxuRu0HF660_6-CrYYboatyjJtSBjJYX7Z9f4fVZaMaW6qTAmTpSuO7Gc0_MfcEuT-kR'),
    
    /**
    * SDK configuration
    */
    'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    'mode' => env('PAYPAL_MODE','live'),
    
    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 30,
    
    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,
    
    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',
    
    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'ERROR'
    ),
];