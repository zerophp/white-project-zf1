<?php

/****************************************************************************
	The following Decorator generate the Exit.
	
	Decorator:
					->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div','class'=>'row')),  // Encapsulate Input
				    array(array('td' => 'HtmlTag'), array('tag' => 'tdss')),				    
				    array('Label', array('tag' => 'scs')),
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_first field_vertical')),
				));	
	
	Exit:				
					<div class="field_first field_vertical">
						<scs id="nombre-label">
							<label for="userssset-nombre" class="required">
								Nombre
							</label>
						</scs>
						<tdss>
							<div class="row">
								<input type="text" name="userssset[nombre]" id="userssset-nombre" value="" size="30" maxlength="255" />
							</div>
						</tdss>
					</div>
				
****************************************************************************/

class White-Project_Form_HotelRegimensDemo extends Zend_Form
{
	protected $_cook;
	protected $_current_hotel;
	
	public function __construct($cook)
	{
		parent::__construct();
		$this->_current_hotel=$cook;
		$this->init();
	}
    public function init()
    {           
		$this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        //$this->setAction($front->getBaseUrl().'/White-Project/frontend/hotelssearchresponse');              
     	$this->addElementPrefixPath('Decorator',
                            APPLICATION_PATH.'/views/scripts/forms/decorators/',
                            'decorator');     	
                            
		$this->_cook = new Zend_Session_Namespace('Cook');
		
       	$regimens = new Zend_Form_Element_Radio('regimen');
		$regimens->setLabel('Selecciona un regimen')				
				->setMultiOptions($this->_radioRegimens())
				->setRequired(true)
                ->addValidator('NotEmpty', true)
                //->clearDecorators()                
                ->setDecorators(array('Regimen'))
                ;
                                      
        $subForm1 = new Zend_Form_SubForm('regimens');
        $subForm1->setMethod('post');
 		$subForm1->setLegend('Regimens')
 				 ->setSubFormDecorators(array('Display'))
// 				 ->setDecorators(array(array('ViewScript', array(
//							    'viewScript' => 'forms/_element_subform.phtml'
//							))))
 				 ;
			        
        $subForm2 = new Zend_Form_SubForm('user');
        $subForm2->setMethod('post');
        $subForm2->setLegend('User');
				      
			        
		$nombre = new Zend_Form_Element_Text('nombre');
		$nombre->setLabel('Nombre')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_first field_vertical')),
				));


				
		$lastname = new Zend_Form_Element_Text('lastname');
		$lastname->setLabel('Apellidos')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_next field_vertical')),
				));
				
				
		$document = new Zend_Form_Element_Text('document');
		$document->setLabel('Documento')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_first field_vertical')),
				));
				
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_next field_vertical')),
				));
				
		$movil = new Zend_Form_Element_Text('movil');
		$movil->setLabel('Movil')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_first field_vertical')),
				));
				
		$phone = new Zend_Form_Element_Text('phone');
		$phone->setLabel('Teléfono')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_next field_vertical')),
				));
													        
        $pais = new Zend_Form_Element_Select('pais');
		$pais->setLabel('Pais:')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
                         ->setValue('ES')
                         ->setmultiOptions($this->_selectOptions())
                     	 ->setAttrib('maxlength', 200)                     	 
                         ->setAttrib('size', 1)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_first field_vertical')),
				));
                         
        $user = new Zend_Form_Element_Text('user');
		$user->setLabel('Nombre usuario')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 255)
				->setDecorators(array(
				    'ViewHelper',
				    'Description',
				    'Errors',			                   
				    'Label',
				    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'field_next field_vertical')),
				));
										
		$offers = new Zend_Form_Element_Checkbox('offers');
		$offers->setDescription('Quiero recibir ofertas de White-Project')
			  ->setDecorators(array(
					    'ViewHelper',
					    array('Description', array('tag' => 'label', 'class'=>'none')),
					    'Errors',			  			                
					    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'checkbox_horiz'))
					));	
						 	 	              
		$regme = new Zend_Form_Element_Checkbox('regme');
		$regme->setDescription('Quiero registrarme en White-Project')
			  ->setDecorators(array(
					    'ViewHelper',
					    array('Description', array('tag' => 'label', 'class'=>'inline')),
					    'Errors',			  			                
					    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class'=>'checkbox_horiz'))
					));
				 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Buscar');
		   
		
		//$subForm1->addElements(array($regimens));						
		$subForm2->addElements(array($nombre,$lastname,$document,
								$email,$movil,$phone,$pais,$user,
								$offers,$regme));
		$this->addElements(array($regimens,$submit));
		$subForm3 = new White-Project_Form_Ordersearchresults();	
		$this->addSubForm($subForm3, 'regimenssetss');					
		$this->addSubForm($subForm2, 'userssset');			
		
		 $this->addDisplayGroupPrefixPath('Decorator',
                            APPLICATION_PATH.'/views/scripts/forms/decorators/',
                            'decorator');
        
        
         $this->setSubFormDecorators(
         			array('FormElements',
         			  	  'Display'));
        		                     
                            
                            
        $this->addDisplayGroup(array('regimen'), 'reg');
        $d1=$this->getDisplayGroup('reg');
        $d1->setLegend('leendrio');
        $this->setDisplayGroupDecorators(array(
		    'FormElements',
		    'Display'
		));
    }	

	protected function _radioRegimens()
    {    	
    	$radio_options=array();    	
        foreach($this->_cook->responseSearchH[0]['Hotel_rooms'] as $room)
    	{
    		$radio_options[]=array($room['Hotel_room_id'],
    								$room['Hotel_room_description'],
    								'entrada gratis al casino de barcelona',
    								$room['Hotel_room_price']);
    	}
        Zend_Debug::dump($radio_options, "radio_options", false);
    	return $radio_options;
    }
    
	protected function _selectOptions()
    {
        $sql="SELECT PK_PAIS, PAIS
    	      FROM ter_paises";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
}