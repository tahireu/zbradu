<?php
/*
* Custom Post Type - Events
* */
function events_custom_post_type() {

    $labels = array(
        'name' => __( 'Events', 'zbradu_text_domain' ),
        'singular_name' => __( 'Event', 'zbradu_text_domain' ),
        'add_new' => __( 'Add Event' , 'zbradu_text_domain' ),
        'all_items' => __( 'All Events', 'zbradu_text_domain' ),
        'add_new_item' => __( 'Add New Event', 'zbradu_text_domain' ),
        'edit_item' => __( 'Edit Event', 'zbradu_text_domain' ),
        'new_item' => __( 'New Event', 'zbradu_text_domain' ),
        'view_item' => __( 'View Event', 'zbradu_text_domain' ),
        'search_item_label' => __( 'Search Events', 'zbradu_text_domain' ),
        'not_found' => __( 'No events found', 'zbradu_text_domain' ),
        'not_found_in_trash' => __( 'Not events found in trash', 'zbradu_text_domain' ),
        'parent_item_colon' => __( 'Parent Event', 'zbradu_text_domain' ),
        'post published' => __( 'Event published', 'zbradu_text_domain' ),
        'view post' => __( 'View event', 'zbradu_text_domain' )

    );
    $args = array (
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array (
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revision',
        ),
        /*'taxonomies' => array('category', 'post_tag'),*/
        'menu_position' => 5,
        'exclude_from_search' => false,
        'menu_icon' => 'dashicons-calendar'

    );

    register_post_type('events', $args);
}
add_action('init', 'events_custom_post_type');




/*
* Custom Post Type - Events - Update messages part 1 (single actions)
* */
function events_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['events'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => __( 'Event updated.', 'zbradu_text_domain'),
        2  => __( 'Custom field updated.', 'zbradu_text_domain' ),
        3  => __( 'Custom field deleted.', 'zbradu_text_domain' ),
        4  => __( 'Event updated.', 'zbradu_text_domain'),
        /* translators: %s: date and time of the revision */
        5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'zbradu_text_domain' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => __( 'Event published.', 'zbradu_text_domain'),
        7  => __( 'Event saved.', 'zbradu_text_domain'),
        8  => __( 'Event submitted.', 'zbradu_text_domain'),
        9  => sprintf(
            __( 'Event scheduled for: <strong>%1$s</strong>.', 'zbradu_text_domain'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
        ),
        10 => __( 'Event draft updated.', 'zbradu_text_domain')
    );

    if ( $post_type_object->publicly_queryable && 'events' === $post_type ) {
        $permalink = get_permalink( $post->ID );

        $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View event', 'zbradu_text_domain' ) );
        $messages[ $post_type ][1] .= $view_link;
        $messages[ $post_type ][6] .= $view_link;
        $messages[ $post_type ][9] .= $view_link;

        $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
        $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview event', 'zbradu_text_domain' ) );
        $messages[ $post_type ][8]  .= $preview_link;
        $messages[ $post_type ][10] .= $preview_link;
    }

    return $messages;
}
add_filter( 'post_updated_messages', 'events_updated_messages' );




/*
* Custom Post Type - Events - Update messages part 2 (bulk actions)
* */
function events_bulk_post_updated_messages_filter( $bulk_messages, $bulk_counts ) {

    $bulk_messages['events'] = array(
        'updated'   => _n( '%s event updated.', '%s events updated.', $bulk_counts['updated'], 'zbradu_text_domain' ),
        'locked'    => _n( '%s event not updated, somebody is editing it.', '%s events not updated, somebody is editing them.', $bulk_counts['locked'], 'zbradu_text_domain' ),
        'deleted'   => _n( '%s event permanently deleted.', '%s events permanently deleted.', $bulk_counts['deleted'], 'zbradu_text_domain' ),
        'trashed'   => _n( '%s event moved to the Trash.', '%s events moved to the Trash.', $bulk_counts['trashed'], 'zbradu_text_domain' ),
        'untrashed' => _n( '%s event restored from the Trash.', '%s events restored from the Trash.', $bulk_counts['untrashed'], 'zbradu_text_domain' ),
    );

    return $bulk_messages;

}
add_filter( 'bulk_post_updated_messages', 'events_bulk_post_updated_messages_filter', 10, 2 );




/*
* Custom Post Type - Events - Custom taxonomies
* */
function events_custom_taxonomies() {
// add new taxonomy hierarchical
    $labels = array(
        'name' => __( 'Event Categories', 'zbradu_text_domain' ),
        'singular_name' => __( 'Event Category', 'zbradu_text_domain' ),
        'search_items' => __( 'Search Event Categories', 'zbradu_text_domain' ),
        'all_items'  => __( 'All Event Categories', 'zbradu_text_domain' ),
        'parent_item' => __( 'Parent Event Category', 'zbradu_text_domain' ),
        'parent_item_colon' => __( 'Parent Event Category:', 'zbradu_text_domain' ),
        'edit_type' => __( 'Edit Event Category', 'zbradu_text_domain' ),
        'update_item' => __( 'Update Event Category', 'zbradu_text_domain' ),
        'add_new_item' => __( 'Add New Event Category', 'zbradu_text_domain' ),
        'new_ite_name' => __( 'New Event Category Name', 'zbradu_text_domain' ),
        'menu_name' => __( 'Event Categories', 'zbradu_text_domain' )
    );


    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'event-category')
    );

    register_taxonomy('event-category', array('events'), $args);


// add new taxonomy NOT hierarchical
    register_taxonomy('event-tag', 'events', array(
        'label' => __( 'Event Tags', 'zbradu_text_domain' ),
        'rewrite' => array( 'slug' => 'event-tag'),
        'hierarchical' => false
    ));

}
add_action( 'init' , 'events_custom_taxonomies');