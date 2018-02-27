<?php
/**
 * @file modules\migrate_plus\tests\src\Unit\data_parser\XmlTest.php
 */
namespace Drupal\Tests\migrate_plus\Unit\data_parser;

use Drupal\Tests\migrate\Unit\process\MigrateProcessTestCase;
use Drupal\migrate\MigrateException;

/**
 * Dummy tests - PHPUnit XML assertions
 */

/**
 * https://phpunit.readthedocs.io/en/latest/assertions.html#assertequalxmlstructure
 */
class EqualXMLStructureTest extends MigrateProcessTestCase {

  public function testFailureWithDifferentNodeNames() {
    $expected = new \DOMElement('foo');
    $actual = new \DOMElement('bar');

    $this->assertEqualXMLStructure($expected, $actual);
  }

  public function testFailureWithDifferentNodeAttributes() {
    $expected = new \DOMDocument;
    $expected->loadXML('<foo bar="true" />');

    $actual = new \DOMDocument;
    $actual->loadXML('<foo/>');

    $this->assertEqualXMLStructure(
            $expected->firstChild, $actual->firstChild, true
    );
  }

  public function testFailureWithDifferentChildrenCount() {
    $expected = new \DOMDocument;
    $expected->loadXML('<foo><bar/><bar/><bar/></foo>');

    $actual = new \DOMDocument;
    $actual->loadXML('<foo><bar/></foo>');

    $this->assertEqualXMLStructure(
            $expected->firstChild, $actual->firstChild
    );
  }

  public function testFailureWithDifferentChildren() {
    $expected = new \DOMDocument;
    $expected->loadXML('<foo><bar/><bar/><bar/></foo>');

    $actual = new \DOMDocument;
    $actual->loadXML('<foo><baz/><baz/><baz/></foo>');

    $this->assertEqualXMLStructure(
            $expected->firstChild, $actual->firstChild
    );
  }

  /**
   * https://phpunit.readthedocs.io/en/latest/assertions.html#assertxmlstringequalsxmlstring
   */
  public function testXmlStringEqualsXmlString() {
    $this->assertXmlStringEqualsXmlString(
            '<foo><bar/></foo>', '<foo><baz/></foo>');
  }

}
