import miniToastr from 'mini-toastr'
import * as types from './types'

const toastTypes = {
  success: 'success',
  error: 'error',
  info: 'info',
  warn: 'warn'
}

miniToastr.init({ types: toastTypes }) // config can be passed here miniToastr.init(config)

// Here we are seting up messages output to `mini-toastr`
// This mean that in case of 'success' message we will call miniToastr.success(message, title, timeout, cb)
// In case of 'error' we will call miniToastr.error(message, title, timeout, cb)
// and etc.
function toast ({ title, message, type, timeout, cb }) {
  return miniToastr[type](message, title, timeout, cb)
}

const state = {
  notifications: [],
  lastNotificationAt: null
}

const actions = {
  showNotification: ({ commit }, meta) => {
    commit(types.APP_NOTIF_SHOW, meta)
  }
}

const mutations = {
  [types.APP_NOTIF_SHOW]: (state, meta) => {
    state.lastNotificationAt = new Date().getTime()
    state.notifications.push(meta)
    toast(meta)
  }
}

export default {
  state,
  actions,
  mutations,
  getters: {}
}
