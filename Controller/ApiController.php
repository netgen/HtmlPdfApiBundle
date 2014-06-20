<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 16/06/14
 * Time: 11:34
 */

namespace Netgen\HtmlPdfApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

class ApiController extends Controller
{
    public function testAction ()
    {

        $htmlPdfApi = $this->container->get('netgen_html_pdf_api');

        try{
            $response = new Response();

            //***** test generate from URL ******
            $finder = new Finder();
            $finder->files()->in(__DIR__.'/../Templates');
            foreach ($finder as $file)
            {
                if ($file->getRelativePathname()=="footer.html")
                {
                    $footerFile = $file->getRealPath();
                }
            }
            $footer = file_get_contents($footerFile);

            $params = array (
                'url' => "http://www.netgenlabs.com/",
                'footer' => $footer,
                'header' =>"<!DOCTYPE html><html><head><title></title></head>
                                <body>{{title}} - <img src=\"{{assets_path}}/netgen_template.png\" /></body></html>",
                'header_spacing' => 2,
                'footer_spacing' => 1,
                'filename' => "bla",
                'lowquality' => 0,
                'page_size' => "A4",
                'dpi' => 80,
                //'image_dpi' => 650,
                'orientation' => "portrait",
                'background' => 0,
                'zoom' => 1.2
                //'outline' => false

            ); //var_dump($params);die();
            $params1 = array(
                'url' => "http://www.netgenlabs.com/"
            );
            try{
                //$pdfFile = $htmlPdfApi->generateFromURL($params);
                $commands = array($params, $params1);
                $htmlPdfApi->batchGenerateFromUrl($commands);

                /*$response = new Response();
                $response->headers->set('Content-Type', 'application/pdf');
                $response->headers->set('Content-Disposition', 'attachment;filename='.$params['filename']);
                $response->setContent($pdfFile);*/
                return $response;
            }catch (\Exception $exception)
            {
                echo $exception->getMessage(); die;
            }

            //****** test generate from HTML *****
            /*$params = array(
                'html' => "<h1>HTML PDF API is cool!</h1>",
                //'footer' => $footer,
                'header' =>"<!DOCTYPE html><html><head><title></title></head>
                                <body>{{title}} - <img src=\"{{assets_path}}/netgen_template.png\" /></body></html>",
                'header_spacing' => 1,
                'footer_spacing' => 1,
                'filename' => "bla",
                //'lowquality' => true,
                'page_size' => "A4",
                'dpi' => 80,
                //'image_dpi' => 650,
                'orientation' => "portrait",
                'background' => "false",
                'zoom' => 1.2
                //'outline' => false
            );
            $pdfFile = $htmlPdfApi->generateFromHTML($params);
            $response->headers->set('Content-Type', 'application/pdf');
            $response->headers->set('Content-Disposition', 'attachment;filename=out.pdf');
            $response->setContent($pdfFile);
            return $response;*/

            //***** test get credits *****
            /*$credits = $htmlPdfApi->getCredits();
            return $response->setContent($credits);*/

            //***** test upload asset ******
            /*$finder = new Finder();
            $finder->files()->in(__DIR__.'/../Resources/public/images');

            foreach ($finder as $file)
            {
                if ($file->getRelativePathname()=="netgen_template.png")
                {
                    $resource = $file->getRealPath();
                }
            }
            $responseString = $htmlPdfApi->uploadAsset($resource);
            return $response->setContent($responseString);*/

            //***** test get asset ******
            /*$id = "53a17a19fd0ee33761cc856f";    //id jedino u dashboardu???
            $asset = $htmlPdfApi->getAsset($id);
            $response->headers->set('Content-Type', 'image/png');
            $response->headers->set('Content-Disposition', 'attachment;filename=out.png');
            $response->setContent($asset);*/

            //***** test delete asset *****
            /*$id = "53a3fd21a60143c564f706a4";
            $returnValue = $htmlPdfApi->deleteAsset($id);
            return $response->setContent($returnValue);*/

            //***** test get list of assets *****
            /*$assets = $htmlPdfApi->getAssetList();
            $response->setContent($assets);*/

            //***** test get asset id by name *****
            /*$asset_id = $htmlPdfApi->getAssetID("netgen_template.png");
            $response->setContent($asset_id);*/

        } catch (\Exception $ex){
            echo "Failed: ". $ex->getMessage();
            die();
        }
    }
} 