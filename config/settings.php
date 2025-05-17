<?php
return [
    'Settings' => [
        'Tcpdf' => [
            'groups' => [
                'Pdf.Default' => [
                    'label' => __d('tcpdf', 'Default Pdf settings'),
                ],
            ],

            'schema' => [
                'Tcpdf.creator' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                    'default' => 'CakeTcpdf',
                ],
                'Tcpdf.author' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                    'default' => 'CakeTcpdf',
                ],
                'Tcpdf.headerTitle' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                    'default' => '',
                ],
                'Tcpdf.headerString' => [
                    'group' => 'Pdf.Default',
                    'type' => 'string',
                    'default' => '',
                ],
            ],
        ],
    ],
];
