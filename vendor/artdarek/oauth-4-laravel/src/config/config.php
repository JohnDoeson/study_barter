<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),	
        'Vkontakte' => array(
            'client_id'     => '5073634',
            'client_secret' => 'i1w6pcGL6UrV7IGlV0iH',
            'scope'         => array('photos'),
        ),	

	)

);