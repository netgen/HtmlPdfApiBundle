<?php

namespace Netgen\HtmlPdfApiBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Netgen\HtmlPdfApiBundle\DependencyInjection\NetgenHtmlPdfApiExtension;

class NetgenHtmlPdfApiExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(
            new NetgenHtmlPdfApiExtension(),
        );
    }

    protected function getMinimalConfiguration()
    {
        return array();
    }

    public function testItSetsValidContainerParametersByDefault()
    {
        $this->load();

        $this->assertEquals(
            "htmlpdfapi.com/api/v1/",
            $this->container->getParameter("netgen_html_pdf_api.host")
        );

        $this->assertNull(
            $this->container->getParameter("netgen_html_pdf_api.token")
        );
    }

    public function testItSetsValidContainerParameters()
    {
        $this->load(
            array(
                'token' => 'token',
                'host' => 'host'
            )
        );

        $this->assertEquals(
            "host",
            $this->container->getParameter("netgen_html_pdf_api.host")
        );

        $this->assertEquals(
            "token",
            $this->container->getParameter("netgen_html_pdf_api.token")
        );

        $this->load(
            array(
                'token' => 'token',
            )
        );

        $this->assertEquals(
            "htmlpdfapi.com/api/v1/",
            $this->container->getParameter("netgen_html_pdf_api.host")
        );

        $this->assertEquals(
            "token",
            $this->container->getParameter("netgen_html_pdf_api.token")
        );

        $this->load(
            array(
                'host' => 'host',
            )
        );

        $this->assertEquals(
            "host",
            $this->container->getParameter("netgen_html_pdf_api.host")
        );

        $this->assertNull(
            $this->container->getParameter("netgen_html_pdf_api.token")
        );
    }
}
