<?php

/**
 * 12 TDDs of Christmas
 *
 * @link      http://github.com/jeremykendall/12-tdds-of-christmas for the canonical source repository
 * @copyright Copyright (c) 2012 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/12-tdds-of-christmas/blob/master/LICENSE MIT License
 * @see       http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 */

namespace Tdd\TemplateEngine;

/**
 * Template
 *
 * @package TwelveTddsOfChristmas\Day7
 */
class Template
{
    /**
     * @var string regex format
     */
    protected $regexFormat = '/(\{\$|\$\{)(%s)\}/';

    /**
     * Render template
     *
     * @param  string $template Template
     * @param  array  $map      Map of key value pairs matching tokens in template
     * @return string Template with tokens replaced by map values
     */
    public function render($template, array $map)
    {
        $this->ensureTokensMatchMap($template, $map);

        $patterns = array();

        foreach ($map as $token => $replacement) {
            $patterns[] = sprintf($this->regexFormat, $token);
        }

        return preg_replace($patterns, $map, $template);
    }

    /**
     * Checks number of unique template tokens against replacements in map
     *
     * @param  string     $template Template
     * @param  array      $map      Map of key value pairs matching tokens in template
     * @throws \Exception If unique tokens don't match number of replacements
     */
    protected function ensureTokensMatchMap($template, array $map)
    {
        preg_match_all(sprintf($this->regexFormat, '\w*'), $template, $matches);

        if (array_unique($matches[2]) != array_keys($map)) {
            throw new \Exception('The number of unique template tokens does not match the number of replacement variables.');
        }
    }

    /**
     * Escapes string for output
     *
     * @param  string $string Unescaped string
     * @return string Escaped string
     */
    public function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Gets the regex format used to find tokens within templates
     *
     * @return string Regex format used to find tokens within templates
     */
    public function getRegexFormat()
    {
        return $this->regexFormat;
    }
}
