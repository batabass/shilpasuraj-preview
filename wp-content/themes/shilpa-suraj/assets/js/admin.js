jQuery(function ($) {
  $(document).on('click', '.ss-upload', function (e) {
    e.preventDefault();
    var $wrap = $(this).closest('.ss-image-field');
    var frame = wp.media({
      title: 'Select image',
      button: { text: 'Use this image' },
      multiple: false
    });
    frame.on('select', function () {
      var url = frame.state().get('selection').first().toJSON().url;
      $wrap.find('.ss-image-url').val(url);
      var $img = $wrap.find('img');
      if ($img.length) {
        $img.attr('src', url);
      } else {
        $wrap.prepend('<p><img src="' + url + '" alt="" style="max-width:180px;height:auto;display:block;margin-bottom:8px;"></p>');
      }
    });
    frame.open();
  });
});
