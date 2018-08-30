<?php

namespace Yu0819ki\Lib\PhpCodeSniffer;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Reports\Csv as CsvReporter;

/**
 * Class TsvReporter
 * @package Yu0819ki\Lib
 * @see \PHP_CodeSniffer\Reports\Csv
 */
class TsvReporter extends CsvReporter
{
    /**
     * Generate a partial report for a single processed file.
     *
     * Function should return TRUE if it printed or stored data about the file
     * and FALSE if it ignored the file. Returning TRUE indicates that the file and
     * its data should be counted in the grand totals.
     *
     * @param array                       $report      Prepared report data.
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The file being reported on.
     * @param bool                        $showSources Show sources?
     * @param int                         $width       Maximum allowed line width.
     *
     * @return bool
     */
    public function generateFileReport($report, File $phpcsFile, $showSources = false, $width = 80)
    {
        if ($report['errors'] === 0 && $report['warnings'] === 0) {
            // Nothing to print.
            return false;
        }

        foreach ($report['messages'] as $line => $lineErrors) {
            foreach ($lineErrors as $column => $colErrors) {
                foreach ($colErrors as $error) {
                    $filename = $report['filename'];
                    $message  = str_replace("\t", '  ', $error['message']);
                    $type     = strtolower($error['type']);
                    $source   = $error['source'];
                    $severity = $error['severity'];
                    $fixable  = (int) $error['fixable'];
                    echo "$filename\t$line\t$column\t$type\t$message\t$source\t$severity\t$fixable" . PHP_EOL;
                }
            }
        }

        return true;
    }

    /**
     * Generates a tsv report.
     *
     * @param string $cachedData    Any partial report data that was returned from
     *                              generateFileReport during the run.
     * @param int    $totalFiles    Total number of files processed during the run.
     * @param int    $totalErrors   Total number of errors found during the run.
     * @param int    $totalWarnings Total number of warnings found during the run.
     * @param int    $totalFixable  Total number of problems that can be fixed.
     * @param bool   $showSources   Show sources?
     * @param int    $width         Maximum allowed line width.
     * @param bool   $interactive   Are we running in interactive mode?
     * @param bool   $toScreen      Is the report being printed to screen?
     *
     * @return void
     */
    public function generate(
        $cachedData,
        $totalFiles,
        $totalErrors,
        $totalWarnings,
        $totalFixable,
        $showSources = false,
        $width = 80,
        $interactive = false,
        $toScreen = true
    ) {
        echo "File\tLine\tColumn\tType\tMessage\tSource\tSeverity\tFixable" . PHP_EOL;
        echo $cachedData;
    }
}
