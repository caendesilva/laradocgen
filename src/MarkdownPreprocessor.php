<?php

namespace DeSilva\Laradocgen;

/**
 * Markdown preprocessor.
 *
 * Runs in the MarkdownConverter::class before generating the markdown.
 *
 * @see MarkdownConverter
 *
 * @example usage $processedMarkdown = (new MarkdownPreprocessor($markdown))->get()
 */
class MarkdownPreprocessor
{
    /**
     * The Markdown to preprocess.
     *
     * @var string $markdown
     */
    protected string $markdown;

    /**
     * Construct the class and run the compiler when the class is created.
     *
     * @param string $markdown to preprocess
     */
    public function __construct(string $markdown)
    {
        $this->markdown = $markdown;

        $this->__invoke();
    }

    /**
     * Run the processors.
     */
    public function __invoke()
    {
        $this->expandFilepathShortcode();
    }

    /**
     * Get the processed Markdown.
     *
     * @return string
     */
    public function get(): string
    {
        return $this->markdown;
    }


    /**
     * Expand the custom shortcode for file-paths in code blocks
     *
     * @example usage in a Markdown file
     * ```markdown
     * <empty line> # Huge thanks to https://stackoverflow.com/a/57310297/5700388
     * ‎[!!filepath]::config/laradocgen.php
     *
     * # Will be converted to `<small class="filepath">config/laradocgen.php</small>`
     * ```
     *
     * @todo Could be simplified to see if the first line of the a
     *       code snippet contains // 'path/to/file.php' and intercept that instead.
     *       That way it is more readable in plain markdown files.
     *
     * @return void
     */
    protected function expandFilepathShortcode(): void
    {
        /**
         * I was concerned about the performance as iterating through
         * each line is probably quite inefficient.
         *
         * So I ran a benchmark.
         * The benchmark ran the function  with a sample file containing
         * the entire ALICE'S ADVENTURES IN WONDERLAND by Lewis Carroll,
         * mixed with 100 unique shortcodes randomly shuffled into the text.
         * The entire sample file is 3700 lines long and is over 150kb in size.
         *
         * I ran the function 100 times.
         * In total 370 000 lines were scanned and 10 000 shortcodes were expanded
         *
         * Total execution time for 100 iterations was 4.6932930946 seconds
         * (46.9329309464 MS Avg to scan the entire book).
         * As the execution time is 0.0001ms per line I am pretty happy with the speed.
         */


        $prefix = '[!!filepath]::';

        $base = '<small class="filepath">%string%</small>';

        $lines = explode(PHP_EOL, $this->markdown);

        foreach ($lines as $key => $line) {
            if (substr($line, 0, 14) !== $prefix) {
                continue;
            }

            $path = str_replace($prefix, '', $line);

            $newline = str_replace('%string%', $path, $base);
            $lines[$key] = $newline;
        }

        $this->markdown = implode(PHP_EOL, $lines);
    }
}
