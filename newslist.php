<div class="news-list">
<h4>お知らせ</h4>
  <ul>
  <?php if(have_posts()): while(have_posts()):the_post(); ?>
    <li>
      <a href="<?php the_permalink(); ?>">
        <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
        <?php the_title(); ?>
      </a>
    </li>
  <?php endwhile; endif; ?>
  </ul>
</div>