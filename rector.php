<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\String_\SymplifyQuoteEscapeRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelSetList;

return static function (RectorConfig $rectorConfig): void {
    // set the PHP version
    $rectorConfig->phpVersion(PhpVersion::PHP_83);

    // set paths to use
    $paths = [
        __DIR__.'/app',
    ];

    // set paths to refactor
    $rectorConfig->paths($paths);

    // skip some paths
    $rectorConfig->skip([
        // CodeQuality
        FlipTypeControlToUseExclusiveTypeRector::class => $paths,
        // CodingStyle
        CatchExceptionNameMatchingTypeRector::class => $paths,
        EncapsedStringsToSprintfRector::class => $paths,
        NewlineBeforeNewAssignSetRector::class => $paths,
        SymplifyQuoteEscapeRector::class => $paths,
        // DeadCode
        RemoveEmptyClassMethodRector::class => $paths,
    ]);

    // register a single rule
    $rectorConfig->rule(PrivatizeFinalClassPropertyRector::class);
    $rectorConfig->rule(Rector\Visibility\Rector\ClassConst\ChangeConstantVisibilityRector::class);
    $rectorConfig->rule(Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector::class);
    $rectorConfig->rule(Rector\Visibility\Rector\ClassMethod\ExplicitPublicClassMethodRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_83,
        LaravelSetList::LARAVEL_100,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
    ]);
};
