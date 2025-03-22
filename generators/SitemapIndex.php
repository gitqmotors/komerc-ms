<?php

class SitemapIndex
{
    /**
     * @var XMLWriter
     */
    private $xml;

    public function __construct(string $filename)
    {
        $this->xml = new XMLWriter();
        $this->xml->openUri('file://' . $filename);
        $this->xml->setIndent(true); // если нужен форматированный (с отступами) вывод
        $this->xml->startDocument('1.0', 'UTF-8');
        $this->xml->startElement('sitemapindex');
        $this->xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    public function url(string $loc, DateTimeInterface $lastmod)
    {
        $this->xml->startElement('sitemap');
        $this->xml->writeElement('loc', $loc);
        $this->xml->writeElement('lastmod', $lastmod->format('Y-m-d'));
        $this->xml->endElement();
    }

    public function close()
    {
        $this->xml->endElement(); // Закрывает <sitemapindex>
        $this->xml->endDocument();
    }
}
