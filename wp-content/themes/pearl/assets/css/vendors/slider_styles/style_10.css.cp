.stm_slider_style_10.stm_slider .stm_slide__title {
    padding-left: 44px;
    margin-bottom: 42px;
}

.stm_slider_style_10.stm_slider .stm_slide__title span {
    display: block;
    max-width: 600px;
    position: relative;
    text-transform: uppercase;
    letter-spacing: -2.5px;
    line-height: 50px;
    font-weight: 600;
    font-size: 50px;
}

.stm_slider_style_10.stm_slider .stm_slide__title span:after {
    content: '';
    display: inline-block;
    width: 4px;
    min-height: 48px;
    padding: 0;
    position: absolute;
    left: -44px;
    top: 3px;
    background-color: #ffffff;
}

.stm_slider_style_10.stm_slider .stm_slide__title span:after {
    opacity: 1;
    background-color: #fff;
    transform: scale3d(1, 0, 1);
    animation: v-line 3s cubic-bezier(0.4, 0, 0.2, 1) infinite both;
}

@keyframes v-line {
    10% {
        transform: scale3d(1, 0, 1);
        transform-origin: center top;
    }

    50% {
        transform-origin: center top;
        transform: scale3d(1, 1, 1);
    }

    51% {
        transform-origin: center bottom;
    }

    100% {
        transform-origin: center bottom;
        transform: scale3d(1, 0, 1);
    }
}

.stm_slider_style_10.stm_slider .stm_slide__content {
    padding-left: 44px;
}

.stm_slider_style_10.stm_slider .stm_slide__content span {
    display: block;
    max-width: 500px;
    font-weight: 300;
    line-height: 28px;
    font-size: 20px;
}

.stm_slider_style_10.stm_slider .stm_slide__button {
    margin-left: 44px;
}

.stm_slider_style_10.stm_slider .stm_slide__button .btn {
    background-color: transparent !important;
    padding: 24px 31px !important;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb {
    border-color: #e6e6e6 !important;
    background-color: #f2f3f5 !important;
    -ms-flex-align: center !important;
    align-items: center !important;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb .stm_slide_thumb_icon {
    font-size: 50px !important;
    line-height: 50px !important;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb .stm_slide_thumb_body .stm_slide_thumb_heading {
    display: block;
    letter-spacing: 1px;
    margin-bottom: 18px;
    line-height: 18px;
    font-weight: 600;
    font-size: 11px;
    color: #aaaaaa;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb .stm_slide_thumb_content {
    line-height: 22px;
    font-size: 18px;
    font-weight: 300;
    color: #444444;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb:hover:not(.active) {
    background-color: #f6f6f6 !important;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb.active .stm_slide_thumb_body .stm_slide_thumb_heading {
    color: #fff !important;
}

.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb.active .stm_slide_thumb_content {
    color: #fff !important;
}
