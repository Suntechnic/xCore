<?
// вместо хедера
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

//local/modules/x.core/x.test/dev/1.php
$result = X\Wizards\HLBStorages::addStringstorage();

if ($result->isSuccess()) {
    echo 'OK';
} else {
    print_r($result->getErrorMessages());
}
?>

