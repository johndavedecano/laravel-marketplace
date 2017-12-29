import axios from 'axios'
import * as types from './types'

const state = {
  isLoggedIn: false,
  isLoading: false,
  user: null,
  token: null
}

const mutations = {
  [types.AUTH_LOGIN]: state => {
    state.isLoading = true
  },
  [types.AUTH_LOGIN_FAILED]: state => {
    state.isLoading = false
    state.isLoggedIn = false
  },
  [types.AUTH_LOGIN_SUCCESS]: state => {
    state.isLoggedIn = true
    state.isLoading = false
  },
  [types.AUTH_LOGOUT]: state => {
    state.isLoggedIn = false
  }
}

const actions = {
  login: async ({ state, commit, dispatch }, data) => {
    commit(types.AUTH_LOGIN)
    try {
      await axios.post('/api/auth/login', data)
      commit(types.AUTH_LOGIN_SUCCESS)
      dispatch('showNotification', {
        type: 'success',
        message: 'Successfully logged in'
      })
      return Promise.resolve()
    } catch (error) {
      commit(types.AUTH_LOGIN_FAILED)
      dispatch('showNotification', {
        type: 'error',
        message: 'Invalid username or password'
      })
      return Promise.reject(error.message)
    }
  }
}

const getters = {
  isLoggingIn: state => state.isLoading,
  isLoggedIn: state => state.isLoggedIn,
  currentUser: state => state.user,
  token: state => state.token
}

export default {
  state,
  actions,
  mutations,
  getters
}
