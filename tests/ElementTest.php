<?php
/**
 * Project: form
 * User: palicao
 * Date: 05/04/15
 * Time: 12:42
 */

use AdamWathan\Form\Elements\Element;

class ElementTest extends PHPUnit_Framework_TestCase
{

    /** @var Element */
    protected $element;

    public function setUp()
    {
        $this->element = $this->getMockForAbstractClass('\AdamWathan\Form\Elements\Element');
    }

    public function testGetAndSetAttribute()
    {
        $this->element->attribute('foo', 'bar');
        $expected = 'bar';
        $this->assertSame($expected, $this->element->getAttribute('foo'));
    }

    public function testAddClass()
    {
        $this->element->addClass('class1');
        $expected = 'class1';
        $this->assertSame($expected, $this->element->getAttribute('class'));
    }

    public function testRemoveClass()
    {
        $this->element->addClass('class1');
        $this->element->addClass('class2');
        $this->element->removeClass('class1');
        $expected = 'class2';
        $this->assertSame($expected, $this->element->getAttribute('class'));
    }

    public function testAddRemoveMultipleClasses()
    {
        $this->element->addClass('class1');
        $this->element->addClass('class2');
        $this->element->addClass('class3');
        $this->element->addClass('class4');
        $this->element->removeClass('class2');
        $this->element->removeClass('class3');
        $expected = 'class1 class4';
        $this->assertSame($expected, $this->element->getAttribute('class'));
    }

    public function testAddSameClassMoreThanOnce()
    {
        $this->element->addClass('class1');
        $this->element->addClass('class1');
        $expected = 'class1';
        $this->assertSame($expected, $this->element->getAttribute('class'));
    }

}
