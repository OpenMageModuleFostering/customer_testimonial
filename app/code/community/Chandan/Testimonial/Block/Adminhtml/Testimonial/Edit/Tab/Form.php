<?php

class Chandan_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('testimonial_form', array('legend'=>Mage::helper('testimonial')->__('Testimonial information')));
     
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('testimonial')->__('Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));
	  
	  $fieldset->addField('companyname', 'text', array(
          'label'     => Mage::helper('testimonial')->__('Company Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'companyname',
      ));

	  $fieldset->addField('desigination', 'text', array(
          'label'     => Mage::helper('testimonial')->__('Desigination'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'desigination',
      ));	  
  

      $fieldset->addField('profileimage', 'image', array(
          'label'     => Mage::helper('testimonial')->__('Profile Image'),
          'required'  => false,
          'name'      => 'profileimage',
	  ));
	  
	  $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('testimonial')->__('Content'),
          'title'     => Mage::helper('testimonial')->__('Content'),
          'style'     => 'width:300px; height:200px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('testimonial')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('testimonial')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('testimonial')->__('Disabled'),
              ),
          ),
      ));
     
     
      if ( Mage::getSingleton('adminhtml/session')->getTestimonialData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTestimonialData());
          Mage::getSingleton('adminhtml/session')->setTestimonialData(null);
      } elseif ( Mage::registry('testimonial_data') ) {
          $form->setValues(Mage::registry('testimonial_data')->getData());
      }
      return parent::_prepareForm();
  }
}