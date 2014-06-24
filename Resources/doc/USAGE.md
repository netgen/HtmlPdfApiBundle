Netgen HtmlPdfApi Bundle Usage Instructions
===========================================

After proper configuration you can use HtmlPdfApi Bundle the following way.

Get Service
-----------

First, get the service from service container:

```php
$htmlPdfApi = $this->container->get('netgen_html_pdf_api');
```
HtmlPdfApi exposes [HTML PDF API](https://htmlpdfapi.com) functionalities: you can generate PDF from URL, generate PDF from HTML, manipulate assets on the server or find out how many credits you have left on your account.

Generating PDF
--------------

To generate PDF, you have to define parameters for the request. You can find the list of available options, as well as their description, in HTML PDF API [documentation](https://htmlpdfapi.com/documentation).

###Generating from URL

If you want to generate PDF file directly from url, you must at least provide the 'url' parameter (in that case, 'html' parameter must not be set).
Example:
```php
$params = array ('url' => "http://www.netgenlabs.com/")
$pdfFile = $htmlPdfApi->generateFromURL($params);
```

###Generating from HTML

If you want to generate PDF from HTML string, you must at least provide the 'html' parameter (in that case, 'url' parameter must not be set).
Example:
```php
$params = array('html' => "<h1>HTML PDF API is cool!</h1>")
$pdfFile = $htmlPdfApi->generateFromHTML($params);
```

Both functions return code 200 on success, and a pdf file.

###Note

Generating from file is currently not supported through Netgen HtmlPdfApi Bundle.

Assets
------

Assets allow you to upload a file and use it as a local file on the server in your templates.
There are several operations you can preform on assets: upload, download, delete, get asset id by name and get list of uploaded assets.

###Create asset
To upload an asset, you have to provide full path to the asset:
```php
$response = $htmlPdfApi->uploadAsset("/path/to/asset");
```

On success returns code 201, and json object with asset information (id, name, mime, size).


###Download asset
To download asset, you can get asset by ID:
```php
$asset = $htmlPdfApi->getAsset($id);
```

On success returns code 200, and the asset (file).

###Delete asset
You can delete asset by its ID:
```php
$response = $htmlPdfApi->deleteAsset($id);
```

On success returns code 204.

###Get asset ID
To find out which ID your asset has:
```php
$asset_id = $htmlPdfApi->getAssetID($assetName);
```

On success returns asset ID as string.

###Get list of uploaded assets
You can also get the list of uploaded assets:
```php
$assets = $htmlPdfApi->getAssetList();
```

On success returns code 200, and list of json objects (each containing id, name, mime and size).

Credits
-------
To find out how many credits you have left on your account:
```php
$credits = $htmlPdfApi->getCredits();
```

On success returns code 200, and the number of available credits.