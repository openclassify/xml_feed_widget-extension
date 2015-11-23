<?php

return [
    'url'      => [
        'type'   => 'anomaly.field_type.url',
        'config' => [
            'default_value' => 'http://www.pyrocms.com/posts/rss.xml'
        ]
    ],
    'template' => [
        'type'   => 'anomaly.field_type.editor',
        'config' => [
            'mode'          => 'twig',
            'default_value' => file_get_contents(__DIR__ . '/../stubs/template.stub')
        ]
    ]
];
