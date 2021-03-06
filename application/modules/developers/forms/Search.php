<?php
class Developers_Form_Search extends Zend_Form
{
	
    public function init()
    {    
//    	Zend_Dojo::enableForm($this);        
        $this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        $this->setAction($front->getBaseUrl().'/White-Project/frontend/hotelssearchresponse');       
        		
		$pais = new Zend_Form_Element_Select('pais');
		$pais->setLabel('Pais:')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
                         ->setValue('ES')
                         ->setmultiOptions($this->_selectOptions())
                     	 ->setAttrib('maxlength', 200)
                     	 ->setOptions(array('onChange'=>'javascript:                     	 								
                     	 								dijit.byId("pobId").store = close();
                     	 								var sStore = new dojo.data.ItemFileReadStore({url: "/White-Project/frontend/poblationlist/id/" + this.value });
                     	 								dijit.byId("pobId").store = sStore;
                     	 								getAjaxResponse("/White-Project/frontend/setcountry/id/"+dojo.byId("pais").value,"containerID");
                     	 								'))
                         ->setAttrib('size', 1);
                         
		$pobId = new Zend_Dojo_Form_Element_FilteringSelect('pobId');
		$pobId->setLabel('Destino:')
		            ->setAutoComplete(true)		            
		            ->setStoreType('dojo.data.ItemFileReadStore')
		            ->setStoreId('pob')
		            ->setStoreParams(array('url'=>'/White-Project/frontend/poblationlist/','clearOnClose'=>'true'))		            
		            ->setAttrib("searchAttr", "POBLACION")		            	            		            
		            ->setAttrib("hasDownArrow", "true")
		            ->setRequired(true)
		            ;
		            		                       
		$entrada = new Zend_Dojo_Form_Element_DateTextBox('entrada');
		$entrada->setLabel('Entrada:')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array('formatLength'   => 'long',
                                   "style"=> "width:200px; height:1.6em",
                                ));		
             
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Buscar');
		
		$this->addElements(array($pais,$pobId,$entrada,
								 $submit));

	
    }	
    
	protected function _selectOptions()
    {
        $sql="SELECT PK_PAIS, PAIS
    	      FROM TER_PAISES";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
    
	public function addChildAges($childs, $room)
    {				
 		$datrooms = new Zend_Form_SubForm();
 		$datrooms->setDecorators(array(
						    'FormElements',
						    array('HtmlTag', array('tag' => 'div'))
						    
						));
		$datrooms->setIsArray(true);
		
    	for ($a=1; $a<=$childs; $a++)
		{			
			$adults = new Zend_Form_Element_Select('childages'.(string)$a);
			$adults->setLabel('Edad niño '.(string)$a,':')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6',
                						'7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12',
                						'13'=>'13', '14'=>'14', '15'=>'15', '16'=>'16'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)				
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));

            $datrooms->addElements(array($adults));   
        
		}
		$this->addSubForm($datrooms, 'datroom'.(string)$room);		
		echo $datrooms->__toString();
    }
    
	public function addRooms($rooms)
    {						
    	for ($a=1; $a<=$rooms; $a++)
		{				
 			$datrooms = new Zend_Form_SubForm();
			$datrooms->setIsArray(true);
			
			$adults = new Zend_Form_Element_Select('adults');
			$adults->setLabel('Adultos:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)				
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));
			
            $childs = new Zend_Form_Element_Select('childs');
			$childs->setLabel('Niños:')
                ->setmultiOptions(array('0'=>'0', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'))
				->setAttrib('maxlength', 200)
				->setOptions(array('onChange'=>'javascript:getAjaxResponse("/White-Project/frontend/index/room/'.$a.'/ages/"+this.value,"agesy'.(string)$a.'");'))
				->setAttrib('size', 1)
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));
			
            $agesy=new Default_Model_Xhtmls('agesy');
			$agesy->setContent("<div id='agesy".(string)$a."'></div>");
            $datrooms->addElements(array($adults,$childs,$agesy));
            $this->addSubForm($datrooms, 'datroom'.(string)$a);
                     
			echo $datrooms->__toString();				 
		}
    }
}