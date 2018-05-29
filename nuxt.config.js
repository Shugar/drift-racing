const config = require('./.contentful.json')

module.exports = {
  /*
  ** Headers of the page
  */

  css: [
    'assets/main.css'
  ],

  head: {
    title: 'Drift',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' }
    ],
    link: [
      { rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicon@16.png', },
      { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon@32.png', },
    ]
  },

  transition: 'go',
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */

  plugins: [
    {
      src: '~/plugins/vueMasonry',
      // ssr: false,
    },
    {
      src: '~/plugins/contentful',
      // ssr: false,
    },
    {
      src: '~/plugins/googleMap'
    },
    {
      src: '~/plugins/vueTouch',
      ssr: false
    },
    {
      src: '~/plugins/vueWow',
      ssr: false
    },
    {
      src: '~/plugins/vueSocialSharing',
      ssr: false
    },
  ],

  env: {
    CTF_SPACE_ID: config.CTF_SPACE_ID,
    CTF_CDA_ACCESS_TOKEN: config.CTF_CDA_ACCESS_TOKEN,
    CTF_PERSON_ID: config.CTF_PERSON_ID,
    CTF_BLOG_POST_TYPE_ID: config.CTF_BLOG_POST_TYPE_ID
  },

  build: {
    /*
    ** Run ESLint on save
    */
    vendors: ['babel-polyfill'],
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }

      if (!isClient) {
        // This instructs Webpack to include `vue2-google-maps`'s Vue files
        // for server-side rendering
        config.externals.splice(0, 0, function (context, request, callback) {
          if (/^vue2-google-maps($|\/)/.test(request)) {
            callback(null, false)
          } else {
            callback()
          }
        })
      }
    }
  }
}
