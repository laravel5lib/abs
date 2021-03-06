@php
  $image_sets = data_get($item, 'ImageSets.ImageSet');
  if(is_null($image_sets)){
    $image_sets = $asin_item->image_sets->image_sets;
  }

  if(array_has($image_sets, '@attributes')){
    $image_sets =[$image_sets];
  }

  if(array_has($image_sets, '0.HiResImage.URL')){
    $image_size = 'HiResImage';
  } else {
    $image_size = 'LargeImage';
  }

  if(!empty($image_sets)){
    $image_urls = array_pluck($image_sets, $image_size . '.URL');
  }
@endphp

@unless(empty($image_urls))
  <div class="uk-card-body">

    <h4 class="uk-heading-line"><span>画像</span></h4>

    <div uk-lightbox>

      @foreach($image_urls as $image_url)
        @unless(empty($image_url))
          <a href="{{ $image_url }}">
            <div class="uk-cover-container uk-height-medium">
              <img src="{{ $image_url }}"
                   alt=""
                   itemprop="image"
                   uk-cover>
            </div>
          </a>
        @endunless
      @endforeach

    </div>

  </div>
@endunless
