import.meta.glob([

'../fonts/**',

]);

import './bootstrap';
import './reservasi';
import './uihelper';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
