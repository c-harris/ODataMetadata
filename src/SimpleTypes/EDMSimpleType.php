<?php
namespace AlgoWeb\ODataMetadata\Abstracts;

use AlgoWeb\xsdTypes\xsString;

abstract class EDMSimpleType extends xsString
{
    public function __construct($value)
    {
        parent::__construct($value);
        $this->setEnumeration(['Binary','Boolean','Byte','DateTime','DateTimeOffset','Time','Decimal','Double',
            'Single','Guid','Int16','Int32','Int64','String','SByte']);
    }
}
