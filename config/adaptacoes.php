<?php

return [
    'tipos' => [
        'audio descricao' => [
            'classes' => ['adaptacao-audio-descricao', 'adaptacao-text-to-speech']
        ],
        'alto_contraste' => [
            'classes' => ['adaptacao-alto-contraste']
        ],
        'ampliacao de texto' => [
            'classes' => ['adaptacao-ampliacao-texto']
        ],
        'text-to-speech' => [
            'classes' => ['adaptacao-text-to-speech']
        ],
        'leitor de tela' => [
            'classes' => ['adaptacao-leitor-de-tela']
        ]
    ],

    'necessidades' => [
        'cegueira' => [
            'classes' => ['adaptacao-leitor-de-tela', 'adaptacao-text-to-speech']
        ],
        'cega' => [
            'classes' => ['adaptacao-leitor-de-tela', 'adaptacao-text-to-speech']
        ],
        'cego' => [
            'classes' => ['adaptacao-leitor-de-tela', 'adaptacao-text-to-speech']
        ],
        'baixa visao' => [
            'classes' => ['adaptacao-ampliacao-texto', 'adaptacao-alto-contraste']
        ],
        'visao subnormal' => [
            'classes' => ['adaptacao-ampliacao-texto', 'adaptacao-alto-contraste']
        ],
        'deficiencia visual' => [
            'classes' => ['adaptacao-ampliacao-texto', 'adaptacao-alto-contraste']
        ],
        'daltonismo' => [
            'classes' => ['adaptacao-indicadores-textuais']
        ],
        'daltonico' => [
            'classes' => ['adaptacao-indicadores-textuais']
        ],
        'daltonica' => [
            'classes' => ['adaptacao-indicadores-textuais']
        ]
    ]
];
