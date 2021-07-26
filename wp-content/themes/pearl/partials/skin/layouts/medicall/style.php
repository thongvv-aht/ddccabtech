body.home #wrapper{
padding-bottom: 0;
}

@media (max-width: 1023px) {
    .stm-navigation.stm-navigation__default ul li.menu-item-has-children.active > a:after {
        transform: rotate(180deg) !important;
    }
    
    .stm-navigation .stm_megamenu > ul > li.menu-item-has-children > a > .stm_mobile__dropdown:after {
        content: '';
        display: block !important;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -2px 0 0 -2px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 5px 3.5px 0;
        border-color: #000 transparent transparent;
    }
}