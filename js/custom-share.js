// JavaScript Document
jQuery(document).ready(function(){
    console.log('ready');
  jQuery(".btn-share-page").click(function(){
      console.log('click');
   jQuery('.popupshare').trigger('click');
  });

   var $temp = jQuery("<input>");
     var $url = jQuery("#copy_link").val();
    jQuery('.clipboard').on('click', function() {
    jQuery("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
	jQuery("<span class='js_msg'>Favourite link copied to clipboard</span>")
    .appendTo(jQuery('#wcssc-button-container_custom').children("span.js_msg").remove().end())
    .each(function(){
        var self = jQuery(this);
        setTimeout(function () {
            self.fadeOut(500,function(){
                self.remove();
            });
        }, 4500);
   }
);
	});
});
function facebook_share() {
  window.open("https://www.facebook.com/sharer/sharer.php?u=https://simplenursing.com/free-trial", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,");
}
function linkden_share() {
  window.open("https://www.linkedin.com/sharing/share-offsite/?url=https://simplenursing.com/free-trial", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,");
}
function twitter_share() {
  window.open("https://twitter.com/intent/tweet?url=https://simplenursing.com/free-trial", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,");
}

function messanger_share() {
  window.open("https://www.facebook.com/dialog/share?app_id=145634995501895&display=popup&href=https://simplenursing.com/free-trial&redirect_uri=https://simplenursing.com/free-trial", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,");
}
function copyfunction() {
  // Get the text field
  var copyText = document.getElementById("copy_link");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text

}
