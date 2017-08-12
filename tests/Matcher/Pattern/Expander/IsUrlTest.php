<?php

declare(strict_types=1);

namespace Coduo\PHPMatcher\Tests\Matcher\Pattern\Expander;

use Coduo\PHPMatcher\Matcher\Pattern\Expander\IsUrl;
use PHPUnit\Framework\TestCase;

class IsUrlTest extends TestCase
{
    /**
     * @dataProvider examplesUrlsProvider
     */
    public function test_urls($url, $expectedResult)
    {
        $expander = new IsUrl();
        $this->assertEquals($expectedResult, $expander->match($url));
    }

    public static function examplesUrlsProvider()
    {
        return array(
            array("http://example.com/test.html", true),
            array("https://example.com/test.html", true),
            array("https://example.com/user/{id}/", true),
            array("mailto:email@example.com", true),
            array("//example.com/test/", false),
            array("example", false),
            array("", false)
        );
    }
}
