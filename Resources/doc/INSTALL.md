Netgen HtmlPdfApi Bundle Installation instructions
==================================================

Instalation steps
-----------------

### Use Composer

Add the following to your composer.json and run `php composer.phar update` to refresh dependencies:

```json
"require": {
    "netgen/htmlpdfapibundle": "~1.0"
}
```

### Activate the bundle

Activate the bundle in your `AppKernel.php` file:

```php

public function registerBundles()
{
   $bundles = array(
       new FrameworkBundle(),
       ...
       new Netgen\HtmlPdfApiBundle\NetgenHtmlPdfApiBundle(),
   );

   ...
}
```

### Edit configuration
Put the basic API configuration in your `app/config/config.yml`:

```yml
# HtmlPdfApi Configuration
netgen_html_pdf_api:
    host:  'https://htmlpdfapi.com/api/v1'
    token: <your token>
```

In `Netgen/HtmlPdfApiBundle/Resources/config/services.yml` file configure which Http Client and which Validator to use:

```yml
services:
    netgen_html_pdf_api.http_client:
            alias: <http client> (default: netgen_html_pdf_api.http_client.guzzle)

    netgen_html_pdf_api.validator:
            alias: <validator> (default: netgen_html_pdf_api.validator.htmlpdfapivalidator)
```

### Use the bundle
