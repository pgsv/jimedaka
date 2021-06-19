<?php
$page = get_post(get_the_ID());
get_template_part('pages/page', $page->post_name);
