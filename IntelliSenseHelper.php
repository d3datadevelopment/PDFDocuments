<?php

/**
 * See LICENSE file for license details.
 * 
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Controller {

    use OxidEsales\Eshop\Application\Controller\Admin\OrderOverview;

    class d3_overview_controller_pdfdocuments_parent extends OrderOverview {}
}

namespace D3\PdfDocuments\Modules\Application\Model
{
    use OxidEsales\Eshop\Application\Model\Order;

    class d3_Order_PdfDocuments_parent extends Order {}
}