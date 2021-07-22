<?php get_header(); ?>
<div class="contact">
  <main class="contact-wrapper">
    <div class="contact-wrapper-head">
      <div class="contactInfo col-6">
        <h1 class="contactInfo-head">
          お問い合わせ
        </h1>
        <h2 class="contactInfo-body">
          ・メールでのお問い合わせ
        </h2>
        <p class="contactInfo-foot">
          下記のフォームに要件とお名前、メールアドレスをこ記入ください。送信完了後受領完了の自動送信メールをお送りしております。その後担当者より2〜3営業日以内にメールでご連絡させていただきます。
        </p>
      </div>
      <div class="contactCalender col-6">
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <?php the_widget('bizcalendarwidget'); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>

    <div class="contact-form">
      <?php if (have_posts()): while (have_posts()):the_post(); ?>
      <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </main>


</div>

<?php get_footer();
