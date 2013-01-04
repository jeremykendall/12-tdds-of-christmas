<?php

namespace Tdd;

class TemplateEngineTest extends \PHPUnit_Framework_TestCase
{
    private $templateEngine;

    protected function setUp()
    {
        $this->templateEngine = new TemplateEngine();
    }

    protected function tearDown()
    {
        $this->templateEngine = null;
    }

    /**
     * @dataProvider regexDataProvider
     */
    public function testRegexForFindingVariables($subject, $expected)
    {
        $pattern = sprintf($this->templateEngine->getRegexFormat(), '\w*');
        preg_match_all($pattern, $subject, $matches);
        $this->assertEquals($expected[0], $matches[0]);
    }

    /**
     * @dataProvider renderDataProvider
     */
    public function testRender($template, $expected, $map)
    {
        $this->assertEquals(
            $expected, 
            $this->templateEngine->render($template, $map)
        );
    }

    public function testMarkerMapMismatchThrowsException()
    {
        $this->setExpectedException('\Exception', 'The number of unique template tokens does not match the number of replacement variables.');
        $template = 'Hello {$mis} {$matched}';
        $map = array('mis' => 'Arthur');
        $this->templateEngine->render($template, $map);
    } 

    public function regexDataProvider()
    {
        return array(
            array('Hello {$name}', array(array('{$name}'))),
            array(
                'Hello {$firstName} ${lastName}', 
                array(array('{$firstName}', '${lastName}'))
            ),
            array(
                'Hello ${{$firstName}}', 
                array(array('{$firstName}'))
            )
        );
    }

    public function renderDataProvider()
    {
        return array(
            array('Hello {$name}', 'Hello Ford', array('name' => 'Ford')),
            array(
                'Hello {$firstName} ${lastName}', 
                'Hello Zaphod Beeblebrox', 
                array('firstName' => 'Zaphod', 'lastName' => 'Beeblebrox')
            ),
            array(
                'Hello {$firstName} {$lastName}. May I call you ${firstName}?', 
                'Hello Arthur Dent. May I call you Arthur?', 
                array('firstName' => 'Arthur', 'lastName' => 'Dent')
            ),
            array(
                'This seems ${{$adjective}}.',
                'This seems ${silly}.',
                array('adjective' => 'silly')
            ),
            array(
                'Side item: {$side}.',
                'Side item: &quot;Mac &amp; Cheese&quot;.',
                array('side' => '"Mac & Cheese"')
            )
        );
    }
}

