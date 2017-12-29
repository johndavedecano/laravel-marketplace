import axios from 'axios'
import * as types from './types'

const state = {
  isLoggedIn: false,
  isLoading: false,
  user: null
}

const mutations = {
  [types.AUTH_LOGIN]: state => {
    state.isLoading = true
  },
  [types.AUTH_LOGIN_FAILED]: state => {
    state.isLoading = false
    state.isLoggedIn = false
  },
  [types.AUTH_LOGIN_SUCCESS]: (state, { user, token }) => {
    state.isLoggedIn = true
    state.isLoading = false
    state.user = user
    localStorage.setItem('token', token)
  },
  [types.AUTH_LOGOUT]: state => {
    state.isLoggedIn = false
    localStorage.removeItem('token')
  }
}

const actions = {
  login: async ({ state, commit, dispatch }, params) => {
    commit(types.AUTH_LOGIN)
    try {
      const { data } = await axios.post('/api/auth/login', params)
      commit(types.AUTH_LOGIN_SUCCESS, data)
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
