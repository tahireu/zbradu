<?php
/*
* Custom Post Type - Slides
* */
function slides_custom_post_type() {

    $labels = array(
        'name' => __( 'Slides' ),
        'singular_name' => __( 'Slide', 'zbradu_text_domain' ),
        'add_new' => __( 'Add Slide', 'zbradu_text_domain' ),
        'all_items' => __( 'All Slides', 'zbradu_text_domain' ),
        'add_new_item' => __( 'Add New Slide', 'zbradu_text_domain' ),
        'edit_item' => __( 'Edit Slide', 'zbradu_text_domain' ),
        'new_item' => __( 'New Slide', 'zbradu_text_domain' ),
        'view_item' => __( 'View Slide', 'zbradu_text_domain' ),
        'search_item_label' => __( 'Search Slides', 'zbradu_text_domain' ),
        'not_found' => __( 'No slides found', 'zbradu_text_domain' ),
        'not_found_in_trash' => __( 'Not slides found in trash', 'zbradu_text_domain' ),
        'parent_item_colon' => __( 'Parent Slide', 'zbradu_text_domain' ),
        'post published' => __( 'Slide published', 'zbradu_text_domain' ),
        'view post' => __( 'View slide', 'zbradu_text_domain' )

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
        'menu_icon' => 'dashicons-slides'

    );

    register_post_type('slides', $args);
}
add_action('init', 'slides_custom_post_type');




/*
* Custom Post Type - Slides - Update messages part 1 (single actions)
* */
function slides_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['slides'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => __( 'Slide updated.', 'zbradu_text_domain'),
        2  => __( 'Custom field updated.', 'zbradu_text_domain' ),
        3  => __( 'Custom field deleted.', 'zbradu_text_domain' ),
        4  => __( 'Slide updated.', 'zbradu_text_domain'),
        /* translators: %s: date and time of the revision */
        5  => isset( $_GET['revision'] ) ? sprintf( __( 'Slide restored to revision from %s', 'zbradu_text_domain' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => __( 'Slide published.', 'zbradu_text_domain'),
        7  => __( 'Slide saved.', 'zbradu_text_domain'),
        8  => __( 'Slide submitted.', 'zbradu_text_domain'),
        9  => sprintf(
            __( 'Slide scheduled for: <strong>%1$s</strong>.', 'zbradu_text_domain'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
        ),
        10 => __( 'Slide draft updated.', 'zbradu_text_domain')
    );

    if ( $post_type_object->publicly_queryable && 'slides' === $post_type ) {
        $permalink = get_permalink( $post->ID );

        $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View slide', 'zbradu_text_domain' ) );
        $messages[ $post_type ][1] .= $view_link;
        $messages[ $post_type ][6] .= $view_link;
        $messages[ $post_type ][9] .= $view_link;

        $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
        $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview slide', 'zbradu_text_domain' ) );
        $messages[ $post_type ][8]  .= $preview_link;
        $messages[ $post_type ][10] .= $preview_link;
    }

    return $messages;
}
add_filter( 'post_updated_messages', 'slides_updated_messages' );




/*
* Custom Post Type - Slides - Update messages part 2 (bulk actions)
* */
function slides_bulk_post_updated_messages_filter( $bulk_messages, $bulk_counts ) {

    $bulk_messages['slides'] = array(
        'updated'   => _n( '%s slide updated.', '%s slides updated.', $bulk_counts['updated'], 'zbradu_text_domain' ),
        'locked'    => _n( '%s slide not updated, somebody is editing it.', '%s slides not updated, somebody is editing them.', $bulk_counts['locked'], 'zbradu_text_domain' ),
        'deleted'   => _n( '%s slide permanently deleted.', '%s slides permanently deleted.', $bulk_counts['deleted'], 'zbradu_text_domain' ),
        'trashed'   => _n( '%s slide moved to the Trash.', '%s slides moved to the Trash.', $bulk_counts['trashed'], 'zbradu_text_domain' ),
        'untrashed' => _n( '%s slide restored from the Trash.', '%s slides restored from the Trash.', $bulk_counts['untrashed'], 'zbradu_text_domain' ),
    );

    return $bulk_messages;

}
add_filter( 'bulk_post_updated_messages', 'slides_bulk_post_updated_messages_filter', 10, 2 );


