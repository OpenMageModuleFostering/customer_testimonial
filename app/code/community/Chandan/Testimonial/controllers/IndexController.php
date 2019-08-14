<?php
class Chandan_Testimonial_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/testimonial?id=15 
    	 *  or
    	 * http://site.com/testimonial/id/15 	
    	 */
    	/* 
		$testimonial_id = $this->getRequest()->getParam('id');

  		if($testimonial_id != null && $testimonial_id != '')	{
			$testimonial = Mage::getModel('testimonial/testimonial')->load($testimonial_id)->getData();
		} else {
			$testimonial = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($testimonial == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$testimonialTable = $resource->getTableName('testimonial');
			
			$select = $read->select()
			   ->from($testimonialTable,array('testimonial_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$testimonial = $read->fetchRow($select);
		}
		Mage::register('testimonial', $testimonial);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function createpostAction(){	
		$configValue = Mage::getStoreConfig('chandantestimonial/testimonial_group/testimonial_frontend');
		if($configValue == 1){		
			$data = $this->getRequest()->getPost();	
			if(empty($data)) {
				$this->loadLayout();     
				$this->renderLayout();	
			} else{			
				if(isset($_FILES['profileimage']['name']) && $_FILES['profileimage']['name'] != '') {
					try {						
						$uploader = new Varien_File_Uploader('profileimage');										
						$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
						$uploader->setAllowRenameFiles(false);										
						$uploader->setFilesDispersion(false);					
						$path = Mage::getBaseDir('media') . DS ;
						$uploader->save($path, $_FILES['profileimage']['name'] );					
					} catch (Exception $e) {
				  
					}		    
					$data['profileimage'] = $_FILES['profileimage']['name'];
				}
				
				if(is_array($data['profileimage'])){											
					$data['profileimage'] = $data['profileimage']['value'];						
				}
					
				$data['status'] = 2;
				
				$model = Mage::getModel('testimonial/testimonial');		
				$model->setData($data)
					->setId($this->getRequest()->getParam('id'));
				
				try {
					if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
						$model->setCreatedTime(now())
							->setUpdateTime(now());
					} else {
						$model->setUpdateTime(now());
					}	
					
					$model->save();
					Mage::getSingleton('core/session')->addSuccess(Mage::helper('testimonial')->__('Testimonial was successfully saved'));
					Mage::getSingleton('core/session')->setFormData(false);

					if ($this->getRequest()->getParam('back')) {
						$this->_redirect('*/*/edit', array('id' => $model->getId()));
						return;
					}
					$this->_redirect('testimonial/index');
					return;
				} catch (Exception $e) {
					Mage::getSingleton('core/session')->addError($e->getMessage());
					Mage::getSingleton('core/session')->setFormData($data);
					$this->_redirect('testimonial/index/createpost');
					return;
				}			
			}
		} else {
			$this->_redirect('testimonial/index');
		}
	}
}