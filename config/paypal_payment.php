<?php

return [
    # Define your application mode here
    //'mode' => 'sandbox',
    'mode' => 'live',
    
    # Account credentials from developer portal
    'account' => [
        //'client_id' => env('PAYPAL_CLIENT_ID', 'ARgUF_VFX-MN73rmbAcFXZTFqSNPRnILjYh6ppmujyiH7vQDIX8HlAzPJ0ujsL7Kc2MhPyWo5jhl5aXe'),
        //'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EBDEX0KrWva_eD-kuYPdk5PKRXYNq-mEB_g0i7yaLR9x1hnqBWUO_l127cEXPwleFbViXdgdkovYAh6x'),

        //gogo sandbox
        //'client_id' => env('PAYPAL_CLIENT_ID', 'AUc1mET6ZCTUcf2nbz2K6Q4s4IAowoG4aafzzsMWpggUnO296idZHgNAAzWcgA36cE_zQgzeWaQBNPXK'),
        //'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EA6GKeVXt9lbpxuRu0HF660_6-CrYYboatyjJtSBjJYX7Z9f4fVZaMaW6qTAmTpSuO7Gc0_MfcEuT-kR'),
        //gogo live
        'client_id' => env('PAYPAL_CLIENT_ID', 'AUc1mET6ZCTUcf2nbz2K6Q4s4IAowoG4aafzzsMWpggUnO296idZHgNAAzWcgA36cE_zQgzeWaQBNPXK'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 'ENbdWQypfEpCSgfaqxLHhzu95sOlZPaEFcd_U7D5QaZf8PlSIkf0kyQHYPUtYEI9SLThgECxwn64GxXq'),

        //bob sandbox 
        //'client_id' => env('PAYPAL_CLIENT_ID', 'AXTsRTwTTSGfK9LCtuIAokR6jYp9nIQ54nicacfZVqL33iF8ZEKudgoIsTjI-2XXCEF5TAZ4qqKPrA-I'),
        //'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EPDIQJ5Yc3AuCnzPpPyKF4BHoebpypMuCjq8N_DaVCTtbr483FqbFOJ6ZUvI4GnmWH0rFdspdHzyP614'),
        
        //bob live
        //'client_id' => env('PAYPAL_CLIENT_ID', 'AcXmtdAk6-OGnxiMQWQ3Vrwr2g3GcwbPqDwGB1VVFEBDUscj-64noRx77yPr63dLJCHwK-NnWE1oRAOd'),
        //'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EL4Ll3_I-XSUR_6QxZdV5Fg5wYmyoIB_kCdhLAM9ZYFbT9t9BISNCnl3H6cnXf3WmU4AueIv8C15hahB'),
    ],

    # Connection Information
    'http' => [
        'connection_time_out' => 30,
        'retry' => 1,
    ],

    # Logging Information
    'log' => [
        'log_enabled' => true,

        # When using a relative path, the log file is created
        # relative to the .php file that is the entry point
        # for this request. You can also provide an absolute
        # path here
        'file_name' => '../PayPal.log',

        # Logging level can be one of FINE, INFO, WARN or ERROR
        # Logging is most verbose in the 'FINE' level and
        # decreases as you proceed towards ERROR
        'log_level' => 'FINE',
    ],
];
