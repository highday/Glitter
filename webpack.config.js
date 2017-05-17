const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = [
  {
    entry: {
      office: "./resources/assets/js/office/index.js",
    },
    output: {
      path: path.resolve(__dirname, "dist"),
      filename: "js/[name].js",
      publicPath: "/glitter-assets/",
    },
    resolve: {
      alias: {
        'vue$': 'vue/dist/vue.esm.js'
      }
    },
    module: {
      rules: [
        {
          test: /\.vue$/,
          loader: 'vue-loader',
          options: {
            postLoaders: {
              html: 'babel-loader'
            },
          }
        },
        {
          test: /\.jsx?$/,
          loader: 'babel-loader',
          exclude: /(node_modules|bower_components)/,
        },
        {
          test: /\.scss$/,
          use: ExtractTextPlugin.extract({
            fallback: 'style-loader',
            use: ['css-loader', 'sass-loader'],
          }),
        },
        {
          test: /\.(mp3|mp4|webm)$/,
          use: 'file-loader?name=[name].[ext]&outputPath=media/',
        },
        {
          test: /\.(jpg|gif|png)$/,
          use: 'file-loader?name=[name].[ext]&outputPath=images/',
        },
        {
          test: /fontawesome-webfont\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
          use: [
            {
              loader: 'url-loader',
              options: {
                limit: 10000,
                mimetype: 'application/font-woff',
                name: 'fonts/[name].[ext]'
              }
            }
          ]
        },
        {
          test: /fontawesome-webfont\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
          use: [
            {
              loader: 'file-loader',
              options: {
                name: 'fonts/[name].[ext]'
              }
            }
          ]
        },
      ]
    },
    plugins: [
      new ExtractTextPlugin({
        filename: 'css/[name].css',
        disable: false,
        allChunks: true
      }),
    ],
  }
]
