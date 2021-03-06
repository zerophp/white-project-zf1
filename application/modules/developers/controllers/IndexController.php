<?php

/**
 * IndexController.php is the default controller for developers module
 *
 * This module is required. Is the admin default module of
 * backend. Is used for very simple administration tasks.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Developers
 * @subpackage file
 * @version    SVN $Id: IndexController.php 741 2009-12-15 22:04:24Z agustincl $
 *
 */

/**
 * Developers_IndexController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Developers
 * @subpackage Controller
 * 
 */
class Developers_IndexController extends Zend_Controller_Action 
{
	private $_acl = array();
	protected $_form;
	protected $_redirector = null;
    
	public function init()
    {
		// Layout by Wlabel or inject one
    	$this->_helper->layout->setLayout('layout_backend');			// Change layout
		$uri = $this->_request->getPathInfo();
		$activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
				
		$this->_redirector = $this->_helper->getHelper('Redirector');
		$this->view->text = "
        	<h3>A <span class=\"alt\">Basic</span> Backend</h3>

			<p>Este módulo muestra la forma de trabajar con Usuarios.</p>
			<p class=\"quiet\">Contiene un formulario de autenticación, y una lista de privilegios según el usuario.</p>

			<h5>Validación de Usuarios</h5>
			<p class=\"incr\">Se autentica el usuario contra la base de datos.</p>
			<p class=\"incr\">Al registrarse un usuario, se confirma su email.</p>
		"; 
    }     
	
    public function indexAction() 
    {    
    	$this->view->title = "Index"; 
						
    }  

	public function useajaxAction() 
    {  
    	$this->view->title = "Ajax"; 
		$this->view->dojo()->enable(); 
    	require_once (APPLICATION_PATH.'/modules/developers/models/Tester.php');
	    $model = new Tester_Model_Tester();
	    // example text data loads on start-up
	    $model->fetchResponse('/scripts/data/text/text.txt','containerID');
    }
    
	public function usedojojsAction() 
    {  
    	$this->view->title = "Dojo Javascript"; 
		$this->view->dojo()->enable();
        $this->view->dojo()
        				   ->requireModule('dijit.layout.TabContainer')
        				   ->requireModule('dijit.layout.ContentPane')
        				   ->requireModule('dijit.layout.BorderContainer')
        				   ->requireModule('dijit.layout.LinkPane')
        				   ->requireModule('dojox.data.QueryReadStore')
        				   ->requireModule('dijit.form.DateTextBox')
                           ->requireModule('dijit.form.FilteringSelect')
                           ->requireModule('dojo.data.ItemFileReadStore')                          
                           ->requireModule('dojox.data.JsonRestStore')
                           ->requireModule('dijit.form.Button')
                           ->requireModule('dijit.form.ComboBox')
                          ;	
        
                          
        // TODO Remove test
		$this->view->headScript()->appendFile($this->view->baseUrl('/scripts/js/Ajax.js'));
//		$form_hotels = new Developers_Form_Search();
//		$this->view->form = $form_hotels;
		// END test
    }
        
}