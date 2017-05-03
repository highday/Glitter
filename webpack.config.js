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
          test: /\.(ttf|eot|svg)(\?[\s\S]+)?$/,
          use: 'file-loader?name=[name].[ext]&outputPath=fonts/'
        },
        {
          test: /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
          use: 'file-loader?name=[name].[ext]&outputPath=fonts/'
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
