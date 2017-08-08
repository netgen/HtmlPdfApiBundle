<?php

namespace Netgen\HtmlPdfApiBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Netgen\HtmlPdfApiBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration()
    {
        return new Configuration();
    }

    public function testConfigurationValuesAreOkAndValid()
    {
        $this->assertConfigurationIsValid(
            array(
                'netgen_html_pdf_api' => array(
                    'host' => 'host',
                    'token' => 'token',
                ),
            )
        );
    }

    public function testConfigurationValuesAreInvalid()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_html_pdf_api' => array(
                    'host' => '',
                    'token' => 'token',
                ),
            )
        );

        $this->assertConfigurationIsInvalid(
            array(
                'netgen_html_pdf_api' => array(
                    'host' => 'host',
                    'token' => '',
                ),
            )
        );

        $this->assertConfigurationIsInvalid(
            array(
                'netgen_html_pdf_api' => array(
                    'host' => '',
                    'token' => '',
                ),
            )
        );
    }

    public function testConfigurationValuesAreValidWhenNotSet()
    {
        $this->assertConfigurationIsValid(
            array(
                'netgen_html_pdf_api' => array(
                ),
            )
        );

        $this->assertConfigurationIsValid(
            array(
                'netgen_html_pdf_api' => array(
                    'host' => 'host',
                ),
            )
        );

        $this->assertConfigurationIsValid(
            array(
                'netgen_html_pdf_api' => array(
                    'token' => 'token',
                ),
            )
        );
    }
}
