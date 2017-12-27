import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  test: []
}
const mutations = {}
const getters = {}
const actions = {}
const modules = {}

const store = new Vuex.Store({
  state,
  mutations,
  getters,
  actions,
  modules
})

export default store
