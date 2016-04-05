<?php

$config = array(
    'inquiry' => array(
	array(

		'field' => 'name',
		'label' => 'Name',
		'rules' => 'required|text_all|trim|htmlspecialchars|strip_tags'
	),
	array(

		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'required|text_all|trim|htmlspecialchars|strip_tags|valid_email'
		),
	array(

		'field' => 'contact_number',
		'label' => 'Contact Number',
		'rules' => 'trim|xss_clean|required|callback__check_phone|strip_tags'
		),
	array(

		'field' => 'subject',
		'label' => 'Subject',
		'rules' => 'text_all|trim|htmlspecialchars|strip_tags'
		),
	array(

		'field' => 'message',
		'label' => 'Message',
		'rules' => 'required|text_all|trim|htmlspecialchars|strip_tags'
		),
    array(

		'field' => 'fit',
		'label' => '',
		'rules' => 'required|trim|htmlspecialchars|strip_tags'
		
		)/*,
	array(

		'field' => 'captcha_text',
		'label' => 'Captcha',
		'rules' => 'required|trim|htmlspecialchars|strip_tags'
		
		)*/
	)
);


?>