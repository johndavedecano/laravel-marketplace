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
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
  },
  [types.AUTH_LOGOUT]: state => {
    state.isLoggedIn = false
    localStorage.removeItem('token')
  },
  [types.AUTH_REGISTER]: state => {
    state.isLoading = true
  },
  [types.AUTH_REGISTER_FAILED]: state => {
    state.isLoading = false
  },
  [types.AUTH_REGISTER_SUCCESS]: (state, { user, token }) => {
    state.isLoading = false
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
      const { response } = error
      commit(types.AUTH_LOGIN_FAILED)
      dispatch('showNotification', {
        type: 'error',
        message: response.data.error.message
      })
      return Promise.reject(error)
    }
  },
  logout: ({ state, commit, dispatch }) => {
    return new Promise(resolve => {
      dispatch('showNotification', {
        type: 'success',
        message: 'Successfully logged out'
      })
      commit(types.AUTH_LOGOUT)
      resolve()
    })
  },
  register: async ({ state, commit, dispatch }, params) => {
    commit(types.AUTH_REGISTER)
    try {
      const { data } = await axios.post('/api/auth/signup', params)
      commit(types.AUTH_REGISTER_SUCCESS, data)
      dispatch('showNotification', {
        type: 'success',
        message: 'Success, please check your email address!'
      })
      return Promise.resolve()
    } catch (error) {
      commit(types.AUTH_REGISTER_FAILED)
      console.log(error)
      dispatch('showNotification', {
        type: 'error',
        message: 'Registration failed'
      })
      return Promise.reject(error)
    }
  }
}

const getters = {
  isLoading: state => state.isLoading,
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
