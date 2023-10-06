<?php

$finder = PhpCsFixer\Finder::create()
  ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    "@PSR12" => true,
    "align_multiline_comment" => ["comment_type" => "phpdocs_only"],
    "array_syntax" => ["syntax" => "short"],
    "backtick_to_shell_exec" => true,
    "blank_line_after_opening_tag" => true,
    "blank_line_before_statement" => false,
    "cast_spaces" => ["space" => "single"],
    "heredoc_indentation" => true,
    "heredoc_to_nowdoc" => true,
  ])
  ->setFinder($finder);