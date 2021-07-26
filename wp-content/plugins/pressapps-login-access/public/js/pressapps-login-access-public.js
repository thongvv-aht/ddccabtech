(function($) {
    "use strict";
    var palo_public = {
        init: function() {
            this.publicRecaptcha();
            this.ajaxModalForm();
            this.modalFormLink();
            $(".palo-register-form-link").click(function() {
                $("#login_error").remove();
                $("div[class*=palo-modal-form]").hide();
                $("div#palo-register").show();
                return false;
            });
            $(".palo-forgot-form-link").click(function() {
                $("#login_error").remove();
                $("div[class*=palo-modal-form]").hide();
                $("div#palo-resetpass").show();
                return false;
            });
            $(".palo-login-form-link").click(function() {
                $("#login_error").remove();
                $("div[class*=palo-modal-form]").hide();
                $("div#palo-login").show();
                return false;
            });
        },
        publicRecaptcha: function() {
            if (PALO_Public.recaptcha !== "" && PALO_Public.sitekey !== "") {
                var inner = "";
                var arr = PALO_Public.recaptcha.length;
                var recaptcha = '<script type="text/javascript">';
                for (var i = 0; i < arr; i++) {
                    if ($("#" + PALO_Public.recaptcha[i]).length >= 1) {
                        recaptcha += "var palo_" + PALO_Public.recaptcha[i] + ";";
                        inner += "palo_" + PALO_Public.recaptcha[i] + " = grecaptcha.render('" + PALO_Public.recaptcha[i] + "', {'sitekey' : '" + PALO_Public.sitekey + "'});";
                    }
                    if ($("#modal-" + PALO_Public.recaptcha[i]).length >= 1) {
                        recaptcha += "var palo_modal_" + PALO_Public.recaptcha[i] + ";";
                        inner += "palo_modal_" + PALO_Public.recaptcha[i] + " = grecaptcha.render('modal-" + PALO_Public.recaptcha[i] + "', {'sitekey' : '" + PALO_Public.sitekey + "'});";
                    }
                }
                recaptcha += "var CaptchaCallback = function(){";
                recaptcha += inner;
                recaptcha += "};";
                recaptcha += "<\/script>";
                $(recaptcha).appendTo("head");
                $('<script src="//www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer><\/script>').appendTo("head");
            }
        },
        ajaxModalForm: function() {
            var main = this;
            var html = $("html");
            html.on("submit", "form.palo-main-method-form", function(e) {
                e.preventDefault();
                var elm = $(this);
                var method = elm.attr("method");
                var action = elm.attr("action");
                var submit_text = elm.find("#wp-submit").val();
                var data;
                var recaptcha_form;
                if (html.find("#login_error").length >= 1) {
                    html.find("#login_error").remove();
                }
                switch (action) {
                  case "palo_login":
                    var rememberme = elm.find("#rememberme").prop("checked");
                    data = elm.serialize() + "&rememberme=" + rememberme + "&action=" + action;
                    break;

                  case "palo_register":
                    var termscondition = elm.find("#termscondition").prop("checked");
                    data = elm.serialize() + "&action=" + action + "&termscondition=" + termscondition;
                    break;

                  case "palo_resetpass":
                    data = elm.serialize() + "&action=" + action;
                    break;
                }
                $.ajax({
                    url: PALO_Public.ajaxurl,
                    type: method,
                    dataType: "json",
                    data: data,
                    beforeSend: function() {
                        elm.find("#wp-submit").val(PALO_Public.load_text).attr("disabled", "disabled").css("opacity", ".5");
                    },
                    success: function(respond) {
                        main.grecaptchaReset(elm, action);
                        if (respond.status) {
                            if (typeof respond.message !== "undefined") {
                                $("#login_error").hide();
                                $('<p class="message">' + respond.message + "</p>").insertBefore(elm);
                                if (elm.closest("#palo-modal-wrapper").length >= 1) {
                                    recaptcha_form = action.replace(/palo_/gi, "modal_");
                                    main.scrollTopMessage("palo-slideInUp", elm);
                                } else {
                                    recaptcha_form = action.replace(/palo_/gi, "");
                                }
                            }
                            if (respond.redirect) {
                                window.location.assign(respond.redirect);
                            } else {
                                elm.find("input.input").val("").end().find("input.checkbox").prop("checked", false).end().find("textarea.palo_textarea").val("").end().find("select.palo_select").val("");
                            }
                        } else {
                            if ($("#login_error").length < 1) {
                                $('<div id="login_error">' + respond.message + "</div>").prependTo(elm);
                            } else {
                                $("html,body").find("#login_error").remove();
                                $('<div id="login_error">' + respond.message + "</div>").prependTo(elm);
                            }
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    },
                    complete: function() {
                        elm.find("#wp-submit").val(submit_text).removeAttr("disabled").removeAttr("style");
                    }
                });
            });
        },
        grecaptchaReset: function(elm, action) {
            var recaptcha_form;
            if (elm.closest("#palo-modal-wrapper").length >= 1) {
                recaptcha_form = action.replace(/palo_/gi, "modal_");
            } else {
                recaptcha_form = action.replace(/palo_/gi, "");
            }
            if (typeof grecaptcha !== "undefined" && typeof palo_modal_login !== "undefined" && typeof palo_modal_register !== "undefined" && typeof palo_modal_resetpass !== "undefined") {
                switch (recaptcha_form) {
                  case "login":
                    grecaptcha.reset(palo_login);
                    break;

                  case "modal_login":
                    grecaptcha.reset(palo_modal_login);
                    break;

                  case "register":
                    grecaptcha.reset(palo_register);
                    break;

                  case "modal_register":
                    grecaptcha.reset(palo_modal_register);
                    break;

                  case "resetpass":
                    grecaptcha.reset(palo_resetpass);
                    break;

                  case "modal_resetpass":
                    grecaptcha.reset(palo_modal_resetpass);
                    break;
                }
            }
        },
        modalFormLink: function() {
            var html = $("html");
            html.on("click", "a.palo-modal-link", function(e) {
                e.preventDefault();
                var el = $(this);
                var form = el.attr("data-form");
                if (PALO_Public.effect === "contentscale" || PALO_Public.effect === "contentpush") {
                    $("body").removeClass("palo-close-modal").addClass("palo-container-" + PALO_Public.effect + " palo-open-modal");
                }
                if (PALO_Public.modal === "modal") {
                    html.find("#palo-modal-wrapper").find("#palo-modal-inner #palo-" + form).show().end().delay(300).removeClass("palo-close").addClass("palo-open");
                } else if (PALO_Public.modal === "fullscreen") {
                    html.find("#palo-modal-wrapper").children(".palo-modal-close").attr("data-form", form).end().find("#palo-modal-inner #palo-" + form).show().end().delay(300).removeClass("palo-close").addClass("palo-open");
                }
            });
            html.on("click", ".palo-modal-close", function(e) {
                e.preventDefault();
                var el = $(this);
                var html = $("html");
                if (PALO_Public.modal === "modal") {
                    html.find("#palo-modal-wrapper").removeClass("palo-open").addClass("palo-close").delay(500).queue(function(next) {
                        el.closest(".palo-modal-form").hide().find("#login_error").remove();
                        next();
                    });
                } else if (PALO_Public.modal === "fullscreen") {
                    var form = el.attr("data-form");
                    html.find("#palo-modal-wrapper").removeClass("palo-open").addClass("palo-close").delay(500).queue(function(next) {
                        html.find("#palo-modal-wrapper").find("#palo-modal-inner #palo-" + form).hide().find("#login_error").remove();
                        next();
                    });
                }
                if (PALO_Public.effect === "contentscale" || PALO_Public.effect === "contentpush") {
                    $("body").removeClass("palo-open-modal");
                    setTimeout(function() {
                        $("body").removeClass("palo-container-" + PALO_Public.effect);
                    }, 500);
                }
            });
        },
        scrollTopMessage: function(effect, elm) {
            $("html,body").delay(1e3).animate({
                scrollTop: 0
            }).find("#palo-modal-wrapper").delay(1e3).animate({
                scrollTop: 0
            }).find(elm).addClass(effect).delay(1e3).queue(function(next) {
                $(this).removeClass(effect);
                next();
            });
        }
    };
    palo_public.init();
})(jQuery, window);