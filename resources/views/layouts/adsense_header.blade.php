@isset($asin_item)
    @unless(data_get($asin_item->item_attribute->attributes,'IsAdultProduct'))
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: 'ca-pub-5342783238467976',
            enable_page_level_ads: true,
          })
        </script>
    @endunless
@endisset
