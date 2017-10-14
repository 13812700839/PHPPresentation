<?php

namespace PhpPresentation\Tests\Writer\PowerPoint2007;

use PhpOffice\PhpPresentation\DocumentProperties;
use PhpOffice\PhpPresentation\Tests\PhpPresentationTestCase;

class DocPropsCustomTest extends PhpPresentationTestCase
{
    protected $writerName = 'PowerPoint2007';

    public function testRender()
    {
        $this->assertZipFileExists('docProps/custom.xml');
        $this->assertZipXmlElementNotExists('docProps/custom.xml', '/Properties/property[@name="_MarkAsFinal"]');
    }

    public function testMarkAsFinalTrue()
    {
        $this->oPresentation->getPresentationProperties()->markAsFinal(true);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="_MarkAsFinal"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="_MarkAsFinal"]/vt:bool');
    }

    public function testMarkAsFinalFalse()
    {
        $this->oPresentation->getPresentationProperties()->markAsFinal(false);

        $this->assertZipXmlElementNotExists('docProps/custom.xml', '/Properties/property[@name="_MarkAsFinal"]');
    }

    public function testCustomPropertiesBoolean()
    {
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', false, null);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:bool');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:bool', 'false');
    }

    public function testCustomPropertiesDate()
    {
        $value = time();
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', $value, DocumentProperties::PROPERTY_TYPE_DATE);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:filetime');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:filetime', date(DATE_W3C, $value));
    }

    public function testCustomPropertiesFloat()
    {
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', 2.1, null);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:r8');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:r8', 2.1);
    }

    public function testCustomPropertiesInteger()
    {
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', 2, null);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:i4');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:i4', 2);
    }

    public function testCustomPropertiesNull()
    {
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', null, null);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr', '');
    }

    public function testCustomPropertiesString()
    {
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', 'pValue', null);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr', 'pValue');
    }

    public function testCustomPropertiesUnknown()
    {
        $value = time();
        $this->oPresentation->getDocumentProperties()->setCustomProperty('pName', (string)$value, DocumentProperties::PROPERTY_TYPE_UNKNOWN);

        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]');
        $this->assertZipXmlElementExists('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr');
        $this->assertZipXmlElementEquals('docProps/custom.xml', '/Properties/property[@pid="2"][@fmtid="{D5CDD505-2E9C-101B-9397-08002B2CF9AE}"][@name="pName"]/vt:lpwstr', $value);
    }
}
