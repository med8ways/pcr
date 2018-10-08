/**
 * custom webpack command line flags supported (apart default flags, see https://webpack.js.org/api/cli/):
 *
 * - webpack --env.analyze
 *   adds webpack bundle analyzer plugin
 *
 * - webpack --env.template=[all|pageName|none]
 *   choose specific pug templates to build to increase performance
 */

import fs from 'fs';
import path from 'path';
import ExtractTextPlugin from 'extract-text-webpack-plugin';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import FaviconsWebpackPlugin from 'favicons-webpack-plugin';
import { BundleAnalyzerPlugin } from 'webpack-bundle-analyzer';
import {resolve} from './webpack.aliases';
import webpack from 'webpack';

export default function (env = {}, argv) {
  const { analyze = false, template = 'all' } = env;
  const context = path.resolve(__dirname, 'src');
  const templateEntriesDir = path.resolve(context, 'templates/pages');
  const pugFiles = fs.readdirSync(templateEntriesDir).map(file => file.split('.pug')[0]);
  let templates = [];
  if (template === 'all') {
    templates = pugFiles;
  } else {
    templates = pugFiles.filter(file => file === template);
  }
  return {
    context: context,
    devServer: {
      contentBase: path.resolve(__dirname, 'assets')
    },
    devtool: 'source-map', //'cheap-module-eval-source-map', - for faster builds
    entry: {
      'js/main': './scripts/main.js'
    },
    externals: {
      jquery: "jQuery"
    },
    module: {
      rules: [
        {
          test: require.resolve('snapsvg/dist/snap.svg.js'),
          use: 'imports-loader?this=>window,fix=>module.exports=0',
        },
        {
          test: /\.js$/,
          loader: 'babel-loader',
          options: {
            presets: ['env'],
            plugins: [
              'transform-object-rest-spread',
              'transform-es2015-spread'
            ]
          }
        },
        {
          test: /\.s?css$/,
          exclude: /(node_modules)/,
          include: path.resolve(context, 'styles'),
          use: ExtractTextPlugin.extract({
            fallback: 'style-loader',
            use: [
              {
                loader: 'css-loader',
                options: {
                  // https://github.com/webpack-contrib/css-loader/issues/228#issuecomment-204607491
                  importLoaders: 3,
                  sourceMap: true
                }
              },
              {
                loader: 'postcss-loader',
                options: {
                  plugins: [
                    require('autoprefixer'),
                    require('postcss-sorting'),
                    require('css-mqpacker')
                  ],
                  sourceMap: true
                }
              },
              'resolve-url-loader',
              {
                loader: 'sass-loader',
                options: {
                  outputStyle: 'compact',
                  sourceMap: true,
                  sourceComments: true
                }
              }
            ]
          })
        },
        {
          test: /\.(ttf|woff|eot|svg)$/,
          include: path.resolve(context, 'icomoon'),
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: './',
            publicPath: '../icomoon/fonts',
            useRelativePath: true
          }
        },
        ...template !== 'none' && [
          {
            test: /\.pug$/,
            loader: 'pug-loader',
            options: {
              pretty: true
            }
          },
          {
            test: /.*\.(gif|png|jpe?g)$/i,
            include: [
              path.resolve(context, 'images'),
              path.resolve(context, 'styles'),
            ],
            use: [
              {
                loader: 'file-loader',
                options: {
                  name: '[path][name]__[sha512:hash:base64:5].[ext]'
                }
              },
              {
                loader: 'image-webpack-loader',
                options: {
                  mozjpeg: {
                    quality: 85
                  }
                }
              }
            ]
          },
          {
            test: /\.svg$/,
            exclude: [path.resolve(context, 'images/inline'), path.resolve(context, 'icomoon')],
            loader: 'file-loader',
            options: {
              name: '[path][name].[ext]'
            }
          },
          {
            test: /\.svg$/,
            include: path.resolve(context, 'images/inline'),
            loader: 'svg-inline-loader',
            options: {
              removeTags: true,
              removingTags: ['title', 'desc', 'style']
            }
          },
          {
            test: /\.mp4$/,
            loader: 'file-loader',
            include: path.resolve(context, 'video'),
            options: {
              name: '[path][name].[ext]'
            }
          }
        ]
      ]
    },
    output: {
      filename: '[name].js',
      path: path.resolve(__dirname, 'assets')
    },
    plugins: [
      new ExtractTextPlugin('css/main.css'),
      new webpack.optimize.CommonsChunkPlugin({
        async: true,
        minChunks: Infinity,
        name: "manifest"
      }),
      ...analyze && [new BundleAnalyzerPlugin],
      ...template !== 'none' && [
        new FaviconsWebpackPlugin({
          logo: './images/favicon.png',
          prefix: 'favicon/',
          persistentCache: true,
          inject: true,
          background: '#fff',
          icons: {
            android: true,
            appleIcon: true,
            appleStartup: true,
            coast: false,
            favicons: true,
            firefox: true,
            opengraph: false,
            twitter: false,
            yandex: false,
            windows: true
          }
        }),
        ...templates.map(file =>
          new HtmlWebpackPlugin({
            filename: `${file}.html`,
            template: `${templateEntriesDir}/${file}.pug`,
            minify: false
          })
        )
      ]
    ],
    resolve
  }
}