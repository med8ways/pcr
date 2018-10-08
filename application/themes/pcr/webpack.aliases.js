// Use this file for configuring IDE module resolve

const path = require('path');

module.exports = {
  resolve: {
    extensions: ['.js', '.pug', '.vue', '.scss', '.css'],
    alias: {
      masonry: 'masonry-layout',
      isotope: 'isotope-layout',
      TweenLite: path.resolve('node_modules', 'gsap/src/uncompressed/TweenLite.js'),
      TweenMax: path.resolve('node_modules', 'gsap/src/uncompressed/TweenMax.js'),
      TimelineLite: path.resolve('node_modules', 'gsap/src/uncompressed/TimelineLite.js'),
      TimelineMax: path.resolve('node_modules', 'gsap/src/uncompressed/TimelineMax.js'),
      EasePack: path.resolve('node_modules', 'gsap/src/uncompressed/easing/EasePack.js'),
      ScrollToPlugin: path.resolve('node_modules', 'gsap/src/uncompressed/plugins/ScrollToPlugin.js'),
      BezierPlugin: path.resolve('node_modules', 'gsap/src/uncompressed/plugins/BezierPlugin.js'),
      ScrollMagic: path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js'),
      'animation.gsap': path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js'),
      'debug.addIndicators': path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js'),
      snapsvg: 'snapsvg/dist/snap.svg.js',
      '@': path.join(__dirname, 'src'),
      vue$: 'vue/dist/vue.esm.js',
    },
  },
};
