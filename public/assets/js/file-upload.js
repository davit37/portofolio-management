(function($) {
  'use strict';
  $(function() {
    $('.file-upload-browse').on('click', function() {

      
      var file = $(this).parents('.images-list').find('.file-upload-default');
      file.trigger('click');
      // console.log(file)
    });
    $('.file-upload-default').on('change', function() {
      // $(this).parent().find('.images-list').val($(this).val().replace(/C:\\fakepath\\/i, ''));

      var img = $(this).parents('.images-list').find('.file-upload-browse')

      if (this.files && this.files[0]) {
				var reader1 = new FileReader();
				reader1.onload = function(e) {
          img.attr('src', e.target.result);
          
				} 
				reader1.readAsDataURL(this.files[0]); // convert to base64 string
			} 
    });
  });
})(jQuery);