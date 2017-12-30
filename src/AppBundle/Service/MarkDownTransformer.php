<?php
/**
 * Created by PhpStorm.
 * User: Boutc
 * Date: 23/12/2017
 * Time: 16:36
 */

namespace AppBundle\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkDownTransformer
{
    private $markdownParser;

    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
        return  $this->markdownParser->transformMarkdown($str);
    }
}