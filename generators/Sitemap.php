<?php

class Sitemap
{
    /**
     * @var XMLWriter
     */
    private $xml;

    public function __construct(string $filename)
    {
        $this->xml = new XMLWriter();
        $this->xml->openUri('file://' . $filename);
        $this->xml->startDocument('1.0', 'UTF-8');
        $this->xml->startElement('urlset');
        $this->xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    public function __destruct()
    {
        //        if (is_object($this->xml)) {
        $this->close();
        //        }
    }

    public function url(
        string $loc,
        DateTimeInterface $lastmod,
        string $priority = '0.8',
        string $changefreq = 'monthly'
    ) {
        $this->xml->startElement('url');
        $this->xml->writeElement('loc', $this->escapedEntity($loc));
        $this->xml->writeElement('lastmod', $lastmod->format('Y-m-d'));
        $this->xml->writeElement('changefreq', $changefreq);
        $this->xml->writeElement('priority', $priority);
        $this->xml->endElement();
    }

    public function close()
    {
        $this->xml->endElement(); // </urlset>
        $this->xml->endDocument();
    }

    /**
     * @param string $url
     * @return string
     */
    private function escapedEntity(string $url)
    {
        return strtr(
            $url,
            [
                '"' => '&quot;',
                '&' => '&amp;',
                '\'' => '&apos;',
                '<' => '&lt;',
                '>' => '&gt;',
            ]
        );
    }
}
