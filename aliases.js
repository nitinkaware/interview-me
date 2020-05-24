const resolve = require('path').resolve;

module.exports = {
   resolve: {
     alias: {
        '@': resolve(__dirname, '/resources/js'),
        '~': resolve(__dirname, '/resources/sass'),
        '@Components': resolve(__dirname, 'resources/js/Components'),
        '@Pages': resolve(__dirname, 'resources/js/Pages'),
     }
   }
};
