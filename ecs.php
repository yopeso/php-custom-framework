<?php

//https://tomasvotruba.com/blog/2018/06/04/how-to-migrate-from-php-code-sniffer-to-easy-coding-standard/

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\InterfaceNameSuffixSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\VersionControl\GitMergeConflictSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SuperfluousWhitespaceSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::CLEAN_CODE);

    $parameters = $containerConfigurator->parameters();
    $services = $containerConfigurator->services();

    $services->set(GitMergeConflictSniff::class);
    $services->set(NoUselessElseFixer::class);
    $services->set(DisallowLongArraySyntaxSniff::class);
    $services->set(SuperfluousWhitespaceSniff::class);
    $services->set(InterfaceNameSuffixSniff::class);
    $services->set(ReturnAssignmentFixer::class);
    $services->set(NoUselessReturnFixer::class);
    $services->set(SingleQuoteFixer::class);
    $services->set(AssignmentInConditionSniff::class);

    $services->set(PhpdocTypesFixer::class);
    $services->set(PhpdocReturnSelfReferenceFixer::class);
    $services->set(PhpdocIndentFixer::class);
    $services->set(PhpdocNoEmptyReturnFixer::class);
    $services->set(BlankLineBeforeStatementFixer::class);

    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/config',
    ]);
};
