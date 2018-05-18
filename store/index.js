import Vuex from 'vuex'

const createStore = () => {
  return new Vuex.Store({
    state: {
      lightboxPhotoPath: '',
      lightboxLength: null,
      lightboxIndex: null,
      entities: {}
    },

    mutations: {
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
      }
    }
  })
}

export default createStore