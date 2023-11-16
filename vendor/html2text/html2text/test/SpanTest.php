<?php

namespace Html2Text;

class SpanTest extends \PHPUnit_Framework_TestCase
{

    public function testIgnoreSpans()
    {
    	$html =<<< EOT
Outside<span class="_html2text_ignore">Inside</span>
EOT;
        $expected =<<<EOT
Outside
EOT;

        $html2text = new Html2Text($html);
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }
}
Hello, &quot;<strong>world</strong>&quot;!',
                'expected'  => 'Hello, "WORLD"!',
            ),
            'Italic' => array(
                'html'      => 'Hello, &quot;<i>world</i>&quot;!',
                'expected'  => 'Hello, "_world_"!',
            ),
            'Header' => array(
                'html'      => '<h1>Hello, world!</h1>',
                'expected'  => "HELLO, WORLD!\n\n",
            ),
            'Table Header' => array(
                'html'      => '<th>Hello, World!</th>',
                'expected'  => "\t\tHELLO, WORLD!\n",
            ),
            'Apostrophe' => array(
                'html'      => 'L&#39;incubateur',
                'expected'  => 'L\'incubateur'
            ),
        );
    }

    /**
     * @dataProvider searchReplaceDataProvider
     */
    public function testSearchReplace($html, $expected)
    {
        $html = new Html2Text($html);
        $this->assertEquals($expected, $html->getText());
    }
}
