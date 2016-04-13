<?php
return [
    'documents_folder' => DIRECTORY_SEPARATOR.'documents',
    'client_invoice_template' => '{docType}_{orderID}_{depoName}_date_{currentDate}.pdf',
    'client_service_document_template' => '{docType}_{orderID}_date_{currentDate}',
    'client_document_template' => '{docType}_{orderID}_{depoName}_date_{currentDate}',
    'client_service_agreement_template' => '{docType}_contragent_{clientId}_date_{currentDate}.pdf',
];