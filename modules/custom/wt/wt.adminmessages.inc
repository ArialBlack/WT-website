<?php

function wt_admin_labels_form($form, &$form_state){
    $form['tel_title'] = array(
        '#type' => 'textfield',
        '#title' => t('Tel'),
        '#required' => TRUE,
        '#default_value' => variable_get('tel_title', '+38 044 586 98 42'),
    );

    $form['email_title'] = array(
        '#type' => 'textfield',
        '#title' => t('Email'),
        '#required' => TRUE,
        '#default_value' => variable_get('email_title', 'wt@gmail.com'),
    );
    
    return system_settings_form($form);
}
