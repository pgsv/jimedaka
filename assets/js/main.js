
/**
 * ハッシュ値へスクロール
 */
jQuery(function($) {
    $(document).ready(function(){
        //位置・時間調整
        var adjust = -100;
        var time = 500;
        
        //URLのハッシュ値を取得
        var urlHash = location.hash;
        //ハッシュ値があればページ内スクロール
        if(urlHash) {
        //スクロールを0に戻しておく
        $('body,html').stop().scrollTop(0);
        setTimeout(function () {
            //ロード時の処理を待ち、時間差でスクロール実行
            scrollToAnker(urlHash) ;
        }, 100);
        }
        
        //通常のクリック時
        $('a[href^="#"]').on('click', function(event) {
        event.preventDefault();
        
        // ハッシュ値を取得して URI デコードする
        var decodedHash = decodeURI(this.hash);
        // ハッシュの確認
        // console.log(decodedHash);
        //リンク先が#か空だったらhtmlに
        var hash = decodedHash == "#" || decodedHash == "" ? 'html' : decodedHash;
        //スクロール実行
        scrollToAnker(hash);
        return false;
        });
        
        // 関数：スムーススクロール
        // 指定したアンカー(#ID)へアニメーションでスクロール
        function scrollToAnker(hash) {
        var target = $(hash);
        var position = target.offset().top + adjust;
        $('body,html').stop().animate({scrollTop:position}, time, 'swing');
        }
    })
});