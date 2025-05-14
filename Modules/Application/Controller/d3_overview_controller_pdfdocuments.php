<?php

/**
 * See LICENSE file for license details.
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Max Buhe <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\PdfDocuments\Modules\Application\Controller;

use D3\PdfDocuments\Application\Controller\orderOverviewPdfGenerator;
use D3\PdfDocuments\Application\Model\Exceptions\noPdfHandlerFoundException;
use D3\PdfDocuments\Application\Model\Exceptions\pdfGeneratorExceptionAbstract;
use D3\PdfDocuments\Application\Model\Registries\registryOrderoverview;
use Exception;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

class d3_overview_controller_pdfdocuments extends d3_overview_controller_pdfdocuments_parent
{
    private ?string $generatorError = null;

    public function render()
    {
        if ($this->generatorError) {
            echo <<<HTML
<html lang="de">
<body>
<script>
let form = top.basefrm.edit.document.getElementById("transfer");
let input = document.createElement("input");
input.setAttribute("type", "hidden");
input.setAttribute("name", "generatorError");
input.setAttribute("value", encodeURIComponent('{$this->generatorError}'));
form.appendChild(input);
form.submit();
</script>
</body>
</html>
HTML;
            Registry::getUtils()->showMessageAndExit('');
        } elseif ($generatorError = Registry::getRequest()->getRequestParameter('generatorError')) {
            Registry::getUtilsView()->addErrorToDisplay(urldecode($generatorError));
        }

        return parent::render();
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function d3CanExport()
    {
        // We force reading from master to prevent issues with slow replications or open transactions (see ESDEV-3804).
        $masterDb = DatabaseProvider::getMaster();
        $sOrderId = $this->getEditObjectId();

        $viewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $sTable = $viewNameGenerator->getViewName("oxorderarticles");

        $sQ = "select count(oxid) from $sTable where oxorderid = " . $masterDb->quote($sOrderId) . " and oxstorno = 0";
        return (bool) $masterDb->getOne($sQ);
    }

    /**
     * @throws noPdfHandlerFoundException
     * @throws pdfGeneratorExceptionAbstract
     */
    public function d3CreatePDF()
    {
        try {
            $soxId = $this->getEditObjectId();
            if ($soxId != "-1" && isset($soxId)) {
                /** @var Order $oOrder */
                $oOrder = oxNew(Order::class);
                if ($oOrder->load($soxId)) {
                    $generator = oxNew( orderOverviewPdfGenerator::class );
                    $generator->generatePdf($oOrder, Registry::getRequest()->getRequestEscapedParameter("pdflanguage"));
                }
            }
        } catch ( Exception $exception) {
            Registry::getLogger()->error($exception->getMessage(), [ 'exception' => $exception ] );
            $this->generatorError = 'PDF documents: ' . $exception->getMessage();
        }
    }

    /**
    * @return registryOrderoverview
    */
    public function d3getGeneratorList()
    {
        return oxNew(registryOrderoverview::class);
    }
}