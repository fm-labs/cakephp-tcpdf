<?php
return [
    'Settings' => [
        'Tcpdf' => [
            'groups' => [
                'Pdf.Default' => [
                    'label' => __('Default Pdf settings'),
                ],
            ],

            'schema' => [
                'Pdf.creator' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                ],
                'Pdf.author' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                ],
                'Pdf.headerTitle' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                ],
                'Pdf.headerString' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                ],
            ],
        ],
    ],
];
