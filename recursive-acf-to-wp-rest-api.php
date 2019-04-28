<?php
/**
 * Plugin Name: RECURSIVE ACF to WP REST API
 * Description: Appends Advanced Custom Fields Data to the WP REST API v2
 * Author: Paule Lepage
 * Author URI: http://github.com/nyanofthemoon
 * Version: 1.0.0
 * Plugin URI: http://github.com/nyanofthemoon/recursive-acf-to-wp-rest-api
 */

function recursive_acf_to_wp_rest_api_init() {
    add_action('rest_api_init', 'recursive_acf_register_acf');
}

function recursive_acf_register_acf() {
    $types = get_post_types();
    foreach ($types as $type) {
        register_rest_field(
            $type,
            'acf',
            array(
                'get_callback'    => 'recursive_acf_get_acf',
                'update_callback' => 'recursive_acf_update_acf',
                'schema'          => null
            )
        );
    }
}

function recursive_acf_get_acf($object, $field_name, $request) {
    return recursive_acf_get_fields($object['id']);
}

function recursive_acf_update_acf($values, $object, $field_name) {
    foreach($values as $field => $value) {
        update_post_meta($object->ID, $field, $value);
    }

    return get_field($field_name, $object->ID);
}

function recursive_acf_get_fields($id) {
    $data = get_fields($id);
    foreach ($data as $name => $values) {
        if (is_array($values) && count($values) > 0 && $values[0]->ID) {
            foreach ($values as $itemkey => $item) {
                $data[$name][$itemkey]->acf = recursive_acf_get_fields($item->ID);
            }
        }
    }

    return $data;
}

add_action('plugins_loaded', 'recursive_acf_to_wp_rest_api_init');
