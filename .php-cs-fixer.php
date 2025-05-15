<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

$fileHeaderComment = <<<EOF
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

https://www.d3data.de

@copyright (C) D3 Data Development (Inh. Thomas Dartsch)
@author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
@link      https://www.oxidmodule.com
EOF;

$config = new PhpCsFixer\Config();
return $config->setRules([
        'header_comment'    => [
            'header' => $fileHeaderComment,
            'comment_type' => 'PHPDoc',
            'location' => 'after_open'
        ],
        '@PHP80Migration' => true,
        '@PSR12' => true
    ])
    ->setFinder($finder)
;