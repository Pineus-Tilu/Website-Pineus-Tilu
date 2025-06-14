import.meta.glob([

'../fonts/**',

]);

import './bootstrap';
import './ui-helper';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
