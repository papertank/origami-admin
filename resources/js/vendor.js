try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    require('feather-icons').replace();
    window._ = require('lodash');
    window.axios = require('axios');
} catch (e) { }
