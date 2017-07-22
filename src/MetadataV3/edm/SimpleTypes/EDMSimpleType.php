<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\SimpleTypes;

use AlgoWeb\ODataMetadata\Abstracts\EDMSimpleTypeBase;

class EDMSimpleType extends EDMSimpleTypeBase
{
    public function __construct($value)
    {
        parent::__construct($value);
        $this->addEnumeration('Geography');
        $this->addEnumeration('Point');
        $this->addEnumeration('LineString');
        $this->addEnumeration('Polygon');
        $this->addEnumeration('MultiPoint');
        $this->addEnumeration('MultiLineString');
        $this->addEnumeration('MultiPolygon');
        $this->addEnumeration('GeographyCollection');
        $this->addEnumeration('GeometricPoint');
        $this->addEnumeration('GeometricLineString');
        $this->addEnumeration('GeometricPolygon');
        $this->addEnumeration('GeometricMultiPoint');
        $this->addEnumeration('GeometricMultiLineString');
        $this->addEnumeration('GeometricMultiPolygon');
        $this->addEnumeration('GeometryCollection');

    }
}