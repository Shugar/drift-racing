import Vuex from 'vuex'

const createStore = () => {
  return new Vuex.Store({
    state: {
      lightboxPhotoPath: '',
      lightboxLength: null,
      lightboxIndex: null,
      entities: null,
      isCheckoutOpen: false,
      checkoutList: [],
      isHeaderAnimated: false
    },

    mutations: {
      animateHeader (state) {
        state.isHeaderAnimated = false
        state.isHeaderAnimated = true
      },

      fetchData (state, payload) {
        state.entities = payload
      },

      openLightbox (state, payload) {
        state.lightboxPhotoPath = payload.path
        state.lightboxLength = payload.length
        state.lightboxIndex = payload.index
      },

      closeLightbox (state) {
        state.lightboxPhotoPath = ''
        state.lightboxLength = null
        state.lightboxIndex = null
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