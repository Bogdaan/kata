<?php
declare(strict_types=1);

namespace Kata\XmlExtractor;

use Kata\XmlExtractor\internal\FormatterInterface;
use Kata\XmlExtractor\internal\GroupExtractorInterface;

class XmlExtractor
{
    /**
     * @var GroupExtractorInterface
     */
    private $extractor;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    public function __construct(GroupExtractorInterface $extractor, FormatterInterface $formatter)
    {
        $this->extractor = $extractor;
        $this->formatter = $formatter;
    }

    public function extract(string $className): string
    {
        return $this->formatter->format(
            $this->extractor->extract($className)
        );
    }
}
