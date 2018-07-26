const contentful = require('contentful')

// use default environment config for convenience
// these will be set via `env` property in nuxt.config.js

const config = {
  space: "u70qj7y74l9n",
  accessToken: "c7e12517bd4ee9cdedb83b5c5131fb8c4321ac1c10ebca2c46bcd4bebe1785c6"
}

// export `createClient` to use it in page components
module.exports = {
  createClient () {
    return contentful.createClient(config)
  }
}