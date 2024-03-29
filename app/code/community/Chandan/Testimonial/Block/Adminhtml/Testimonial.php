<?php
class Chandan_Testimonial_Block_Adminhtml_Testimonial extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_testimonial';
    $this->_blockGroup = 'testimonial';
    $this->_headerText = Mage::helper('testimonial')->__('Testimonial Manager');
    $this->_addButtonLabel = Mage::helper('testimonial')->__('Add Testimonial');
    parent::__construct();
  }
}