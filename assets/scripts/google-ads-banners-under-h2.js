window.addEventListener('load', e => {

    const article = document.getElementById('article');

    if (article) {
        const allH2Tags = article.querySelectorAll('h2');
        const googleBannerViaggIn = `<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9306947071363993"
                crossorigin="anonymous"></script>
        <!-- ViaggIn Article Ads -->
        <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-9306947071363993"
                data-ad-slot="9939493911"
                data-ad-format="auto"></ins>
        <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
        </script>`;
    
    
        for (const h2Tag of allH2Tags) {
            const adGoogleBannerViaggin = document.createElement('div');
            adGoogleBannerViaggin.setAttribute('class', 'article__google-ads');
            adGoogleBannerViaggin.innerHTML = googleBannerViaggIn;
            h2Tag.after(adGoogleBannerViaggin);
        }
    }

})