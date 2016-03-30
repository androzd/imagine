<?php

return array(

    /*
     |--------------------------------------------------------------------------
     | Directory to store images
     |--------------------------------------------------------------------------
     |
     | Images will be stored at public/{directory} name. By default is cache
     |
     */

    'directory' => 'cache',

    /*
     |--------------------------------------------------------------------------
     | Rules to process image
     |--------------------------------------------------------------------------
     | 
     |
     */
    'rules' => [
        'profile_image' => [
            'type' => 'resize',
            'params' => [
                'width' => 128,
                'height' => 128,
            ],
        ],
        'product' => [
            'type' => 'chain',
            'params' => [
                [
                    'type' => 'resize',
                    'params' => [
                        'width' => 128,
                        'height' => 128,
                    ],
                ],
                [
                    'type' => 'widen',
                    'params' => [
                        'width' => 128,
                    ],
                ],
            ],
        ],
    ]

);
