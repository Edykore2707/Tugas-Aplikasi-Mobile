<?php

namespace App\Services;

use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\PrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrinterConnectionResolver
{
    public function resolvePrinterName(): string
    {
        foreach (['THERMAL_PRINTER_NAME', 'PRINTER_NAME', 'PRINTING_PRINTER_NAME'] as $key) {
            $printerName = $this->normalizePrinterName(env($key));

            if ($printerName !== '') {
                return $printerName;
            }
        }

        $detected = $this->detectDefaultWindowsPrinterName();

        if ($detected !== '') {
            return $detected;
        }

        return 'POS-58';
    }

    public function resolveConnector(): PrintConnector
    {
        $host = trim((string) env('THERMAL_PRINTER_HOST'));

        if ($host !== '') {
            $port = (int) env('THERMAL_PRINTER_PORT', 9100);

            return new NetworkPrintConnector($host, $port);
        }

        return new WindowsPrintConnector($this->resolvePrinterName());
    }

    protected function normalizePrinterName(?string $printerName): string
    {
        if ($printerName === null) {
            return '';
        }

        $printerName = trim((string) $printerName);

        return $printerName === '' ? '' : $printerName;
    }

    protected function detectDefaultWindowsPrinterName(): string
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            return '';
        }

        $commands = [
            'wmic printer where "Default=True" get Name 2>NUL',
            'powershell -NoProfile -Command "(Get-WmiObject Win32_Printer | Where-Object { $_.Default -eq $true } | Select-Object -ExpandProperty Name) 2>$null"',
            'powershell -NoProfile -Command "(Get-CimInstance Win32_Printer | Where-Object { $_.Default -eq $true } | Select-Object -ExpandProperty Name) 2>$null"',
        ];

        foreach ($commands as $command) {
            $output = @shell_exec($command);

            if (!is_string($output)) {
                continue;
            }

            $name = trim((string) preg_replace('/\s+/', ' ', $output));
            $lines = preg_split('/\r\n|\r|\n/', $name);

            foreach ($lines as $line) {
                $candidate = trim((string) $line);

                if ($candidate !== '' && !preg_match('/^(Name|Default|---)/i', $candidate)) {
                    return $candidate;
                }
            }
        }

        return '';
    }
}
