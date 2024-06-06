<?php
declare(strict_types=1);

namespace Nerdman\CodeStyle\Config\Base;

use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

abstract class Config extends PhpCsFixerConfig
{
    private const SETS = [
        '@PER-CS',
        '@Symfony',
        '@Symfony:risky',
    ];

    private const RULES = [
        'align_multiline_comment' => ['comment_type' => 'all_multiline'],
        'array_indentation' => true,
        'assign_null_coalescing_to_coalesce_equal' => true,
        'blank_lines_before_namespace' => true,
        'blank_line_after_opening_tag' => false,
        'blank_line_before_statement' => false,
        'cast_spaces' => ['space' => 'none'],
        'class_definition' => ['multi_line_extends_each_single_line' => true, 'single_line' => false],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'comment_to_phpdoc' => [
            'ignored_tags' => [
                'codeCoverageIgnore',
                'codeCoverageIgnoreStart',
                'codeCoverageIgnoreEnd',
                'phpstan-ignore-next-line',
                'todo',
            ],
        ],
        'concat_space' => ['spacing' => 'one'],
        'control_structure_braces' => true,
        'control_structure_continuation_position' => ['position' => 'same_line'],
        'braces_position' => [
            'allow_single_line_anonymous_functions' => true,
            'allow_single_line_empty_anonymous_classes' => true,
            'anonymous_classes_opening_brace' => 'same_line',
            'anonymous_functions_opening_brace' => 'same_line',
            'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
            'control_structures_opening_brace' => 'same_line',
            'functions_opening_brace' => 'next_line_unless_newline_at_signature_end',
        ],
        'date_time_create_from_format_call' => true,
        'date_time_immutable' => true,
        'declare_parentheses' => true,
        'declare_strict_types' => true,
        'get_class_to_class_keyword' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'heredoc_indentation' => ['indentation' => 'same_as_start'],
        'heredoc_to_nowdoc' => true,
        'list_syntax' => ['syntax' => 'short'],
        'method_chaining_indentation' => true,
        'modernize_strpos' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'native_function_invocation' => ['include' => ['@all']],
        'no_multiline_whitespace_around_double_arrow' => false,
        'no_multiple_statements_per_line' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'octal_notation' => true,
        'operator_linebreak' => ['only_booleans' => false, 'position' => 'beginning'],
        'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'alpha'],
        'ordered_interfaces' => true,
        'php_unit_attributes' => true,
        'php_unit_test_annotation' => ['style' => 'prefix'],
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'phpdoc_align' => [
            'align' => 'left',
            'tags' => ['method', 'param', 'property', 'return', 'throws', 'type', 'var'],
        ],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_array_type' => true,
        'phpdoc_list_type' => true,
        'phpdoc_line_span' => [
            'const' => 'single',
            'method' => 'multi',
            'property' => 'single',
        ],
        'phpdoc_no_empty_return' => true,
        'phpdoc_order' => true,
        'phpdoc_order_by_value' => [
            'annotations' => [
                'author',
                'covers',
                'coversNothing',
                'dataProvider',
                'depends',
                'group',
                'internal',
                'method',
                'property',
                'property-read',
                'property-write',
                'requires',
                'throws',
                'uses',
            ],
        ],
        'phpdoc_separation' => false,
        'phpdoc_to_comment' => ['ignored_tags' => ['var']],
        'phpdoc_to_return_type' => ['scalar_types' => true],
        'phpdoc_var_annotation_correct_order' => true,
        'random_api_migration' => true,
        'regular_callable_call' => true,
        'return_assignment' => true,
        'self_static_accessor' => true,
        'single_line_throw' => false,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'statement_indentation' => true,
        'static_lambda' => true,
        'string_implicit_backslashes' => [
            'double_quoted' => 'escape',
            'heredoc' => 'escape',
            'single_quoted' => 'unescape',
        ],
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline' => [
            'after_heredoc' => true,
            'elements' => [
                'arguments',
                'arrays',
                'match',
                'parameters',
            ],
        ],
        'use_arrow_functions' => true,
        'void_return' => true,
        'yoda_style' => false,
    ];

    /**
     * @param iterable<\SplFileInfo> $finder
     */
    public function __construct(iterable $finder, ?string $cacheFile = null)
    {
        if (\PHP_VERSION_ID < $this->getMinimalPhpVersionId()) {
            throw new \LogicException('This PHP CS Fixer rules configuration only supports PHP ' . self::getMinimalPhpVersionString() . ' or higher');
        }

        parent::__construct();

        $this
            ->setParallelConfig(ParallelConfigFactory::detect())
            ->setRiskyAllowed(true)
            ->setRules(
                \array_fill_keys(\array_merge(self::SETS, $this->getAdditionalRules()), true)
                + $this->getAdditionalRules()
                + self::RULES,
            )
            ->setFinder($finder);

        if ($cacheFile !== null) {
            $this->setCacheFile($cacheFile);
        }
    }

    abstract public static function getMinimalPhpVersionId(): int;

    /**
     * @return list<string>
     */
    protected function getAdditionalSets(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getAdditionalRules(): array
    {
        return [];
    }

    private static function getMinimalPhpVersionString(): string
    {
        $majorVersion = \intdiv(static::getMinimalPhpVersionId(), 10000);
        $minorVersion = \intdiv(static::getMinimalPhpVersionId() - ($majorVersion * 10000), 100);

        return $majorVersion . '.' . $minorVersion;
    }
}
