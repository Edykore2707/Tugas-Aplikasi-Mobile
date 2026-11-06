<?php

use App\Services\PrinterConnectionResolver;

it('prefers configured printer name when available', function () {
    putenv('THERMAL_PRINTER_NAME=Printer Aktif');
    putenv('PRINTER_NAME=');

    expect((new PrinterConnectionResolver())->resolvePrinterName())->toBe('Printer Aktif');
});

it('uses the active default printer or falls back safely when none is available', function () {
    putenv('THERMAL_PRINTER_NAME');
    putenv('PRINTER_NAME');

    $resolver = new PrinterConnectionResolver();
    $method = new ReflectionMethod(PrinterConnectionResolver::class, 'detectDefaultWindowsPrinterName');
    $method->setAccessible(true);

    $expected = $method->invoke($resolver);
    $expected = $expected !== '' ? $expected : 'POS-58';

    expect($resolver->resolvePrinterName())->toBe($expected);
});
