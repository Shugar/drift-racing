import Vuex from 'vuex'

const createStore = () => {
  return new Vuex.Store({
    state: {
      lightbox: null,
      entities: null,
      meta: null,
      isCheckoutOpen: false,
      checkoutList: [],
      isHeaderAnimated: false,
      locale: 'en'
    },

    mutations: {
      setLocale (state, payload) {
        state.locale = payload
      },

      animateHeader (state, payload) {
        state.isHeaderAnimated = payload
      },

      fetchData (state, payload) {
        state.entities = payload
      },

      fetchMeta (state, payload) {
        state.meta = payload
      },

      openLightbox (state, payload) {
        state.lightbox = {
          path: payload.path,
          index: payload.index,
          photos: payload.photos
        }
      },

      closeLightbox (state) {
        state.lightbox = null
      },

      toggleCheckout (state) {
        state.isCheckoutOpen = !state.isCheckoutOpen
      },
      addProductToCart (state, payload) {
        state.checkoutList = [...state.checkoutList, payload ]
      }
    }
  })
}

export default createStore