// Glitter Office

window._ = require('lodash');

window.moment = require('moment')
window.moment.locale('ja')

window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');
require('bootstrap');

window.Chart = require('chart.js');

window.Glitter = {
  vm: require('./root'),
}

import 'font-awesome-sass-loader'

import '../../sass/office/glitter-office.scss'

