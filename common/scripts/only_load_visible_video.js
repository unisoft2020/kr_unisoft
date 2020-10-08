;

/*
This script useful if you've different video for mobile & desktop.
It ensures that the browser doesn't unnecessarily download any video that isn't visible to users. 
In other words, if you've applied 'display:none' style to any video, that particular video won't be loaded. 
As a result, users bandwidth will be saved.

This script expects that your video elements have 'data-src' and 'data-poster' attributes (instead of 'src' and 'poster'). 

Example:
<section>
  <video
    class="hidden-on-mobile"
    data-src="<?= word('URL_Desktop_Video') ?>"
    data-poster="<?= path_to_image('desktop-poster.jpg') ?>"
    autoplay playsinline muted loop>
  </video>

  <video
    class="hidden-on-desktop"
    data-src="<?= word('URL_Mobile_Video') ?>"
    data-poster="<?= path_to_image('mobile-poster.jpg') ?>"
    autoplay playsinline muted loop>
  </video>
</section>

Note that hidden-on-mobile/hidden-on-desktop classes aren't mandatory, use whatever style/class you want.
*/

(function(){
  const videos = Array.from(document.querySelectorAll('video[data-src]'));
  let previousWidth;

  function toggleVideoAttributes() {
    const currentWidth = window.innerWidth;

    if (previousWidth == currentWidth) return;

    videos.forEach((video) => {
      // This will be falsy if 'display' of the video is set to 'none'
      const isVideoVisible = video.offsetWidth || video.offsetHeight || video.getClientRects().length;

      if (isVideoVisible) {
        video.setAttribute('src', video.dataset.src);
        video.setAttribute('poster', video.dataset.poster);
        video.play(); // To fix a bug related to resize event in Edge
      } else {
        video.setAttribute('src', '');
      }
    });

    previousWidth = currentWidth;
  }

  toggleVideoAttributes();
  window.addEventListener('resize', toggleVideoAttributes);
})();