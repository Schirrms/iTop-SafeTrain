<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'schirrms-safetrain/0.4.1',
	array(
		// Identification
		//
		'label' => 'Add a SAFe Train field to Functional CIs',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-config-mgmt/2.7.0',
			'itop-virtualization-mgmt/2.7.0',
			'itop-storage-mgmt/2.7.0',
			'schirrms-generic-connection/0.8.0',
			'schirrms-middleware-web-extensions/0.2.0',
			'schirrms-loadbalancer/0.0.1',
			'schirrms-project-class/0.2.1'
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'model.schirrms-safetrain.php', // Contains the PHP code generated by the "compilation" of datamodel.schirrms-safetrain.xml
			'main.schirrms-safetrain.class.inc.php', // some personal additions
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
		),
	)
);


?>
