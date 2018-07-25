const { createClient } = require('../plugins/contentful')

const client = createClient()

console.log('process.env', process.env)

module.exports = async function () {
  try {
    const response = await client.getEntries()

    const entites = response.items.map(item => {
      if (item.fields.locale === undefined || item.fields.locale === 'en') {
        return {
          type: item.sys.contentType.sys.id,
          locale: 'en',
          ...item.fields
        }
      }

      if (item.fields.locale === 'ru') {
        return {
          type: item.sys.contentType.sys.id,
          locale: item.fields.locale,
          ...item.fields
        }
      }
    })

    const routes = []

    const news = entites.filter(item => item.type === 'calendar').map((item, index) => {
      routes.push({route: `/news/${index}`})
    })

    const store = entites.filter(item => item.type === 'store').map((item, index) => {
      routes.push({route: `/store/${index}`})
    })
    const videos = entites.filter(item => item.type === 'video').map((item, index) => {
      routes.push({route: `/video/${index}`})
    })

    return routes

  }
  catch (e) {
    console.log('routes generation error', e)
  }
}