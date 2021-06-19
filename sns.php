<?php
$url_encode=urlencode(get_permalink());
$title_encode=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<div class="share">
    <ul>

        <!-- tweet -->
        <li class="tweet">
            <a href="http://twitter.com/share?text=<?php echo urlencode(the_title_attribute('echo=0')); ?>&url=<?php the_permalink(); ?>&via=【ツイート内に含めるユーザー名】&hashtags=【ハッシュタグ】&related=【ツイート後に表示されるユーザー】"
                rel="nofollow" data-show-count="false"
                onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i
                    class="fab fa-twitter-square"></i></a>
        </li>

        <!-- facebook -->
        <li class="facebook">
            <a href="//www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>"
                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>

        <!-- LINE -->
        <li class="line">
            <a
                href="http://line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>"><i
                    class="fab fa-line"></i></a>
        </li>

        <!-- hatena -->
        <li class="hatena">
            <a href="//b.hatena.ne.jp/entry/<?php echo $url_encode ?>"
                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=800');return false;"><i
                    class="fa fa-hatena"></i>
            </a>
        </li>

    </ul>
</div>