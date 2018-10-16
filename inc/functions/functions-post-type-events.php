<?php
/*
* Custom Post Type - Events
* */
function events_custom_post_type() {

    $labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'add_new' => 'Add Event',
        'all_items' => 'All Events',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'view_item' => 'View Event',
        'search_item_label' => 'Search Events',
        'not_found' => 'No events found',
        'not_found_in_trash' => 'Not events found in trash',
        'parent_item_colon' => 'Parent Event',
        'post published' => 'Event published',
        'view post' => 'View event'

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
        1  => __( 'Event updated.'),
        2  => __( 'Custom field updated.' ),
        3  => __( 'Custom field deleted.' ),
        4  => __( 'Event updated.'),
        /* translators: %s: date and time of the revision */
        5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => __( 'Event published.'),
        7  => __( 'Event saved.'),
        8  => __( 'Event submitted.'),
        9  => sprintf(
            __( 'Event scheduled for: <strong>%1$s</strong>.'),
// translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
        ),
        10 => __( 'Event draft updated.')
    );

    if ( $post_type_object->publicly_queryable && 'events' === $post_type ) {
        $permalink = get_permalink( $post->ID );

        $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View event', '' ) );
        $messages[ $post_type ][1] .= $view_link;
        $messages[ $post_type ][6] .= $view_link;
        $messages[ $post_type ][9] .= $view_link;

        $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
        $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview event' ) );
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
        'updated'   => _n( '%s event updated.', '%s events updated.', $bulk_counts['updated'] ),
        'locked'    => _n( '%s event not updated, somebody is editing it.', '%s events not updated, somebody is editing them.', $bulk_counts['locked'] ),
        'deleted'   => _n( '%s event permanently deleted.', '%s events permanently deleted.', $bulk_counts['deleted'] ),
        'trashed'   => _n( '%s event moved to the Trash.', '%s events moved to the Trash.', $bulk_counts['trashed'] ),
        'untrashed' => _n( '%s event restored from the Trash.', '%s events restored from the Trash.', $bulk_counts['untrashed'] ),
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
        'name' => 'Event Categories',
        'singular_name' => 'Event Category',
        'search_items' => 'Search Event Categories',
        'all_items'  => 'All Event Categories',
        'parent_item' => 'Parent Event Category',
        'parent_item_colon' => 'Parent Event Category:',
        'edit_type' => 'Edit Event Category',
        'update_item' => 'Update Event Category',
        'add_new_item' => 'Add New Event Category',
        'new_ite_name' => 'New Event Category Name',
        'menu_name' => 'Event Categories'
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
        'label' => 'Event Tags',
        'rewrite' => array( 'slug' => 'event-tag'),
        'hierarchical' => false
    ));

}
add_action( 'init' , 'events_custom_taxonomies');