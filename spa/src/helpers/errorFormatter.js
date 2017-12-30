import get from 'lodash/get'
import forOwn from 'lodash/forOwn'
import map from 'lodash/map'

/**
 * Get error message
 *
 * @param {Number} status
 * @param {String} message
 */
function getErrorMessage (status, message) {
  return status === 422 ? 'Validation error!' : message
}

/**
 * Formats error message to return first value of the array.
 *
 * @param {Object} errors
 *
 * @return {Object}
 */
function getErrors (errors) {
  return forOwn(errors, (value, key) => {
    const error = get(value, '0')
    errors[key] = error || 'Invalid input value'
  })
}

/**
 * Format error response message
 *
 * @param {Error} error
 *
 * @return {Object}
 */
export default function (error) {
  const status = get(error, 'response.status')
  const errors = getErrors(get(error, 'response.data.error.errors', {}))
  const message = getErrorMessage(
    status,
    get(error, 'response.data.error.message')
  )
  return {
    status,
    message,
    errors,
    errorsArray: map(errors, error => error)
  }
}
