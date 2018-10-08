# HEVENS webpack boilerplate

This is standard webpack configuration for frontend development that we use.

If `yarn` confuses you, use `npm` instead of it, but one day the developer community will move to yarn because it is
faster and safer that much NPM can never be by its design. The packages base remain the same. Refer to [yarn website](https://yarnpkg.com/).

## Features

- pug.js for templating
- SCSS for styling
- ES2015 for scripting
- cache busting with main.css?hash or hash in font, video and image names
- source maps
- auto images generation with configurable quality
- auto srcset generation for given image

## Usage

### I'm a frontend developer

1. `yarn run start`
2. Navigate your browser to `localhost:8080` or other port if few webpack-dev-servers are running
3. Make changes
4. `yarn run build`
5. Perform VCS commit

### I'm a backend developer

1. Make changes
2. `yarn run build`
3. In your php templates, replace names of assets with updated ones that contain new hash indicating build date, e.g. `build/assets/main-1500369947463.min.css`. This is done for reliable cache busting.
4. Perform VCS commit

### If you use your brain

Open `package.json` and see what commands are `scripts` field. You may use same commands or even cooler. Visit [webpack docs](https://webpack.js.org/concepts/) or [russian video course on Webpack](https://www.youtube.com/watch?v=X6qde-zvw00)
