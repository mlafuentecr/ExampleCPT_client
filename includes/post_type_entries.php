<?php

// Register the custom post type
function custom_post_type_example_cpt() {
    $labels = array(
        'name'                  => 'Example CPT',
        'singular_name'         => 'Example CPT',
        'menu_name'             => 'Example CPT',
        'name_admin_bar'        => 'Example CPT',
        'archives'              => 'Example CPT Archives',
        'attributes'            => 'Example CPT Attributes',
        'parent_item_colon'     => 'Parent Example CPT:',
        'all_items'             => 'All Example CPT',
        'add_new_item'          => 'Add New Example CPT',
        'add_new'               => 'Add New',
        'new_item'              => 'New Example CPT',
        'edit_item'             => 'Edit Example CPT',
        'update_item'           => 'Update Example CPT',
        'view_item'             => 'View Example CPT',
        'view_items'            => 'View Example CPT',
        'search_items'          => 'Search Example CPT',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into Example CPT',
        'uploaded_to_this_item' => 'Uploaded to this Example CPT',
        'items_list'            => 'Example CPT list',
        'items_list_navigation' => 'Example CPT list navigation',
        'filter_items_list'     => 'Filter Example CPT list',
    );
  
    $args = array(
        'label'                 => 'Example CPT',
        'description'           => 'Custom Post Type for Example CPT',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-post',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'hierarchical'          => false,
        'exclude_from_search'   => false,
        'show_in_rest'          => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post', // Set capability type to 'post'
        'map_meta_cap'          => true,  // Optionally set to true to map meta capabilities
        'menu_icon'           => 'dashicons-awards', // You can choose an icon from the Dashicons library
    );

  
    register_post_type( 'example_cpt', $args );
  }
  add_action('init', 'custom_post_type_example_cpt');
  


// Add custom meta box for "Example CPT"
function add_example_meta_box() {
    add_meta_box(
        'example_meta_box',       // Unique ID
        'Example Meta',           // Box title
        'get_custom_meta',   // Callback function to display the meta box content
        'example_cpt',           
        'normal',                 
        'default'                 
    );
}
add_action('add_meta_boxes', 'add_example_meta_box');


// Callback to retrieve the custom meta field value
function get_custom_meta($post) {
    $example_meta_value = get_post_meta($post->ID, 'example_meta', true);
    ?>

    <!-- <input type="text" id="example_meta" name="example_meta" value="<?php //echo esc_attr($example_meta_value); ?>" /> -->
    <textarea class="example_meta" name="example_meta" rows="5" cols="40"><?php echo esc_textarea($example_meta_value); ?></textarea>
    <?php
}


// Save the custom meta 
function save_example_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['example_meta'])) {
        $new_meta_value = sanitize_text_field($_POST['example_meta']);
        update_post_meta($post_id, 'example_meta', $new_meta_value);
    }
}
add_action('save_post', 'save_example_meta');



// EXPOSE CPT TO API
function add_custom_meta_to_api() {
    register_rest_field(
        'example_cpt',           // Replace 'example_cpt' with your custom post type slug
        'example_meta',          // The name of the custom REST field
        array(
            'get_callback' => 'get_example_meta',
            'update_callback' => 'update_example_meta',
            'schema' => null,
        )
    );
}
add_action('rest_api_init', 'add_custom_meta_to_api');

// Callback to retrieve the custom meta field value
function get_example_meta($object, $field_name, $request) {
    return get_post_meta($object['id'], $field_name, true);
}
