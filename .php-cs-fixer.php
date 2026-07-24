<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/database');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,

        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'use',
                'curly_brace_block',
                'parenthesis_brace_block',
                'square_brace_block',
            ],
        ],

        'no_trailing_whitespace' => true,

        'single_blank_line_at_eof' => true,
    ])
    ->setFinder($finder);