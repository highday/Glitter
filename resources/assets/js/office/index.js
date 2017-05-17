// Glitter Office

window.Glitter = {
  vm: require('./root'),
}

window.moment = require('moment')
window.moment.locale('ja')

window._ = require('lodash');

window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');
require('bootstrap');

require('font-awesome-sass-loader');

window.Chart = require('chart.js');

import '../../sass/office/glitter-office.scss'
