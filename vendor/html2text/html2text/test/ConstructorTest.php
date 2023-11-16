<?php

namespace Html2Text;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $html = 'Foo';
        $options = array('do_links' => 'none');
        $html2text = new Html2Text($html, $options);
        $this->assertEquals($html, $html2text->getText());

        $html2text = new Html2Text($html);
        $this->assertEquals($html, $html2text->getText());
    }

    public function testLegacyConstructor()
    {
        $html = 'Foo';
        $options = array('do_links' => 'none');

        $html2text = new Html2Text($html, false, $options);
        $this->assertEquals($html, $html2text->getText());
    }

    public function testLegacyConstructorThrowsExceptionWhenFromFileIsTrue()
    {
        $html = 'Foo';
        $options = array('do_links' => 'none');

        $this->setExpectedException('InvalidArgumentException');
        $html2text = new Html2Text($html, true, $options);
    }
}
lip;<br/><strong>Devin:</strong> Goldman Sachs?<br/><strong>Sean:</strong> Correct!</p> </blockquote> <blockquote> <p><strong>Sean:</strong> What was the name of the girl Zhu took to prom three months ago?<br/><strong>John:</strong> What?<br/><strong>Derek (from the audience):</strong> Destiny!<br/><strong>Zhu:</strong> Her name is Jolene. She&rsquo;s nice. I like her.</p></blockquote><p>I think the audience is winning.&nbsp; - Derek</p>
EOF
                ,
                'expected' => <<<EOF
Highlights from today’s NEWLYHIRED GAME:

> SEAN: What came first, Blake’s first _Chief Architect position_ or
> Blake’s first _girlfriend_?

> SEAN: Devin, Bryan spent almost five years of his life slaving away
> for this vampire squid wrapped around the face of humanity…
> DEVIN: Goldman Sachs?
> SEAN: Correct!

> SEAN: What was the name of the girl Zhu took to prom three months
> ago?
> JOHN: What?
> DEREK (FROM THE AUDIENCE): Destiny!
> ZHU: Her name is Jolene. She’s nice. I like her.

I think the audience is winning.  - Derek

EOF
            ),
            'Multibyte strings before blockquote' => array(
                'html' => <<<EOF
“Hello”

<blockquote>goodbye</blockquote>

EOF
                ,
                'expected' => <<<EOF
“Hello” 

> goodbye

EOF
            )
        );
    }

    /**
     * @dataProvider blockquoteDataProvider
     */
    public function testBlockquote($html, $expected) {
        $html2text = new Html2Text($html);
        $this->assertEquals($expected, $html2text->getText());
    }
}
