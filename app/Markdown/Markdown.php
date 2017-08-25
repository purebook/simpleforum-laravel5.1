<?php
/**
 * Created by PhpStorm.
 * User: yusheng
 * Date: 17-8-23
 * Time: 下午7:34
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text)
    {
        $html = $this->parser->makeHtml($text);
        return $html;

    }


}