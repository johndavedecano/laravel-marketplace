// Used for passing in buildable environment variables
// Webpack will find and replace object keys with there respective values
var env = {
  // ENVIRONMENT: process.env.ENVIRONMENT
}

if (process.env.ENVIRONMENT === 'testing') {
  env.TEST_API = `http://localhost:${process.env.PORT}`
}

module.exports = env
