<?php
function aa_wp_get_blog_link(){
    $blog_post = get_option("page_for_posts");
    if($blog_post){
        $permalink = get_permalink($blog_post);
    } else{
        $permalink = site_url();
    }
    return $permalink;
}
