Netgen HtmlPdfApi Bundle Installation instructions
==================================================

Instalation steps
-----------------

### Use Composer

Add the following to your composer.json and run `php composer.phar update netgen/htmlpdfapi-bundle` to refresh dependencies:

```json
"require": {
    "netgen/htmlpdfapi-bundle": "~0.2"
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

If you use Guzzle Http Client and want to edit the location of service description file (service.json), add it to ```parameters.yml```:
Example:
```yml
parameters:
    netgen_html_pdf_api.http_client.guzzle.service_json_location: '/path/to/service.json'
```

Bundle uses Guzzle as a http client by default, as well as a default validator.
If you want, you can configure which http client and validator to use in your `services.yml` file:

```yml
services:
    netgen_html_pdf_api.http_client:
            alias: <http client> (default: netgen_html_pdf_api.http_client.guzzle)

    netgen_html_pdf_api.validator:
            alias: <validator> (default: netgen_html_pdf_api.validator.htmlpdfapivalidator)
```

### Use the bundle
