<?php

declare(strict_types=1);

namespace Coduo\PHPMatcher\Matcher\Pattern\Expander;

use Coduo\PHPMatcher\Matcher\Pattern\PatternExpander;
use Coduo\ToString\StringConverter;

final class Count implements PatternExpander
{
    const NAME = 'count';

    /**
     * @var null|string
     */
    private $error;

    /**
     * @var
     */
    private $value;

    /**
     * {@inheritdoc}
     */
    public static function is(string $name)
    {
        return self::NAME === $name;
    }

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function match($value)
    {
        if (!is_array($value)) {
            $this->error = sprintf("Count expander require \"array\", got \"%s\".", new StringConverter($value));
            return false;
        }

        if (count($value) !== $this->value) {
            $this->error = sprintf("Expected count of %s is %s.", new StringConverter($value), new StringConverter($this->value));
            return false;
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
    }
}
