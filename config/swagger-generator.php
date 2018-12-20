<?php

return [
    /*
    |---------------------------------------------------------
    | Routes filters
    |---------------------------------------------------------
    */
    'routes' => [
        'only' => [],
        'not' => [],
        'matches' => [],
        'notMatches' => [],
        'methods' => ['GET', 'POST', 'PUT', 'DELETE'],
    ],
    /*
    |---------------------------------------------------------
    | Settings for output files
    |---------------------------------------------------------
    | For absolute URL start it with slash "/", otherwise relative to app base path
    */
    'output' => [
        'path' => 'public/swagger',
        'file_name' => 'main.yml',
    ],
    /*
    |---------------------------------------------------------
    | Content array to merge with
    |---------------------------------------------------------
    */
    'content' => [
        'openapi' => '3.0.0',
        'info' => [
            'description' => 'Service documentation',
            'version' => '1.0.0',
            'title' => 'Laravel API',
        ],
        'servers' => [
            [
                'url' => 'https://localhost',
                'description' => 'Local server',
            ],
        ],
        'components' => [
            'securitySchemes' => [
                'bearerAuth' => [
                    'type' => 'http',
                    'scheme' => 'bearer',
                    'bearerFormat' => 'JWT',
                ],
            ],
        ],
    ],
    /*
    |---------------------------------------------------------
    | YML file paths to merge with (before parsing)
    |---------------------------------------------------------
    */
    'contentFilesBefore' => [],
    /*
    |---------------------------------------------------------
    | YML file paths to merge with (after parsing)
    |---------------------------------------------------------
    */
    'contentFilesAfter' => [],
    /*
    |---------------------------------------------------------
    | Strip base url prefix for output, NULL to disable
    |---------------------------------------------------------
    */
    'stripBaseUrl' => null,
    /*
    |---------------------------------------------------------
    | List of ignored annotation names
    |---------------------------------------------------------
    */
    'ignoredAnnotationNames' => ['mixin'],
];
