<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 24/06/14
 * Time: 15:45
 */

namespace Netgen\HtmlPdfApiBundle\Exception;

use Exception;

class FileNotFoundException extends  Exception {

    public function __construct ($message)
    {
        parent::__construct($message);
    }

} 