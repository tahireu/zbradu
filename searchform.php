<form role="search" method="get" action="<?php echo home_url( '/'); ?>">
    <input type="search" class="form-control overlay-search-input" placeholder=<?php __('Search', 'zbradu_text_domain') ?> value="<?php echo get_search_query() ?>" name="s" title=<?php __('Search', 'zbradu_text_domain') ?> />
</form>