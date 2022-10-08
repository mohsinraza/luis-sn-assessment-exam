/* jshint esversion: 6 */
const videoDomain = 'd1pumg6d5kr18o.cloudfront.net';

function removeA(arr) {
      var what, a = arguments, L = a.length, ax;
      while (L > 1 && arr.length) {
          what = a[--L];
          while ((ax= arr.indexOf(what)) !== -1) {
              arr.splice(ax, 1);
          }
      }
      return arr;
  }

function scrollTo(id) {
    jQuery([document.documentElement, document.body]).animate({
      scrollTop: (jQuery(id).offset().top)
  }, 500);
}

function showNotificationError(text) {
    toastr.error(text);
}

function showNotificationWarning(text) {
    toastr.warning(text);
}

function showNotificationSuccess(text) {
    toastr.success(text);
}

function getUrlParameter(parameter) {
    var url = new URL(window.location.href);
    return url.searchParams.get(parameter);
}

function differenceSeconds(dateStart, dateEnd) {
    var ms = moment(dateEnd,"DD/MM/YYYY HH:mm:ss").diff(moment(dateStart,"DD/MM/YYYY HH:mm:ss"));
    var d = moment.duration(ms);
    return (d/1000).toFixed(0);
 }

 function formatSecondsToTime(duration) {
     let seconds = duration % 60;
     let minutes = parseInt(duration / 60, 10) % 60;
     let formattedSeconds = ("0" + seconds).slice(-2);

     return minutes + ':' + formattedSeconds;
 }

 function formatSecondsToHHMMSS(duration){
    //  if(duration>3600)
        return new Date(duration * 1000).toISOString().substr(11, 8);
    // else
        // return new Date(duration * 1000).toISOString().substr(14, 5);
 }

 var toHHMMSS = (secs) => {
    var sec_num = parseInt(secs, 10)
    var hours   = Math.floor(sec_num / 3600)
    var minutes = Math.floor(sec_num / 60) % 60
    var seconds = sec_num % 60

    return [hours,minutes,seconds]
        .map(v => v < 10 ? "0" + v : v)
        .filter((v,i) => v !== "00" || i > 0)
        .join(":")
}

function loadVideo(idElement, videoUrl) {
    jQuery(idElement).show();

    jQuery(idElement + " .flowplayer")
      .data('flowplayer')
      .load([{mpegurl: videoUrl}]);

}


function stopVideo(idElement) {
    setTimeout(function(){
        jQuery(idElement).hide();
        jQuery(idElement + " .flowplayer")
          .data('flowplayer')
          .stop();
    }, 1000);

}

/*
 * Remove the video URL from the question, and return object with
 * HTML without video url
 * VIDEO URL
 * return false if no video URL
*/
function removeVideoFromHTML(html) {
    let hasVideo = html.includes(videoDomain);
    if (!hasVideo) return false;

    // get video url
    let videoURL = getVideoUrlFromHTML(html);

    //remove video url from html
    let cleanHTML = html.replace(videoURL, "");

    let data = {
        'clean_html': cleanHTML,
        'video_url': videoURL
    };
    return data;
}

function getVideoUrlFromHTML(html) {
    let videoURL = html.substring(
        html.lastIndexOf("https://" + videoDomain),
        html.lastIndexOf("m3u8") + 4
    );
    return videoURL;
}

/* Free Trial conversion pixel */
function gtag_report_conversion(url) {
    var callback = function () {
      if (typeof(url) != 'undefined') {
        window.location = url;
      }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-840626066/1a1TCJLMwKUBEJLf65AD',
        'event_callback': callback
    });
    return false;
  }


  function setCookie(cname, cvalue, exdays) {
      console.log('setCookie');
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
      let name = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);
      let ca = decodedCookie.split(';');
      for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    // Look in all localStorage for previous exams stored, and if expired, remove
    function removeExpiredExamsFromLocalStorage(examType) {
       for ( var i = 0, len = localStorage.length; i < len; ++i ) {
           let localStorageKey=localStorage.key(i);

           if (localStorageKey!=null && localStorageKey.indexOf(examType)>-1) {
               const today = new Date();

               let localStorageStored = JSON.parse(localStorage.getItem( localStorage.key( i ) ));

               let localExpirationDate = new Date(localStorageStored.expirationDate);
               var storedDateInPast = localExpirationDate.getTime() < today.getTime();

               if (storedDateInPast) {
                   localStorage.removeItem(localStorageKey);
               }

           }

        }
    }
