import Vue from 'vue';
import * as jQuery from 'jquery';
import initVueInstances from './Vue/index'

window.$ = window.jQuery = jQuery.default;

((html) => {
    html.className = html.className.replace(/\bno-js\b/, 'js');
})(document.documentElement);

((w, d, $) => {

    'use strict';

    $(() => {
        initVueInstances()
    });

})(window, document, window.jQuery);
