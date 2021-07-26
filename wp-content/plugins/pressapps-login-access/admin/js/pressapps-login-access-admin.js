(function($) {
    "use strict";
    var palo_admin = {
        init: function() {
            this.videoLogin();
            this.ajaxUserApproval();
        },
        videoLogin: function() {
            if (typeof PALO === "undefined") {
                return;
            }
            var bg_video = PALO.background_video;
            var video_obj = {};
            var options = {};
            options.posterType = "none";
            if (PALO.background_image !== "") {
                $("html").attr("style", "background-image:url('" + PALO.background_image + "');");
            }
            if (bg_video) {
                video_obj = this.getVideoType(bg_video);
                $("body").vide(video_obj, options);
            } else {
                $("#login").before('<div id="palo-login-background"></div>');
            }
        },
        getVideoType: function(video) {
            var object = {};
            switch (true) {
              case video.search(/.mp4/g) != -1:
                object.mp4 = video;
                break;

              case video.search(/.webm/g) != -1:
                object.webm = video;
                break;

              case video.search(/.ogv/g) != -1:
                object.ogv = video;
                break;
            }
            return object;
        },
        ajaxUserApproval: function() {
            $("a.button-user-status").on("click", function(e) {
                e.preventDefault();
                var elm = $(this);
                var callback = elm.attr("data-callback");
                var nonce = elm.attr("data-nonce");
                var user_id = elm.attr("data-id");
                var text = elm.text();
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    dataType: "json",
                    data: {
                        action: "user_approval_ajax",
                        callback: callback,
                        nonce: nonce,
                        user_id: user_id
                    },
                    beforeSend: function() {
                        elm.text(PALO_Admin.preload);
                    },
                    success: function(respond) {
                        if (respond.status) {
                            if (callback === "approve_user") {
                                elm.attr("data-callback", "disable_user").attr("data-nonce", respond.nonce).removeClass("button-primary").text(PALO_Admin.disable);
                            } else {
                                elm.attr("data-callback", "approve_user").attr("data-nonce", respond.nonce).addClass("button-primary").text(PALO_Admin.approve);
                            }
                        } else {
                            elm.text(text);
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });
        }
    };
    palo_admin.init();
})(jQuery);