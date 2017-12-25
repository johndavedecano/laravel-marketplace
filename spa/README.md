# Laravel Marketplace SPA

A fully featured buy and sell project that uses Vuex, vue-router, vue-i18n, Server Side Rendering and much, much more.

This is intended as a starting point for medium/big sized projects but also as a quick reference on how to do common things in the Vue ecosystem.

## Features

* Server Side Rendering
  _ Async data fetching before rendering
  _ Client hydration \* Return the HTTP code you want
* Routing with vue-router
* State management with vuex
* Internazionalization with vue-i18n
  _ Static/Compile-time i18n
  _ Dynamic/Runtime i18n
* Head management \* Title and meta tags support
* 404 Page \* Returns 404 HTTP code
* Progressive Web App (WIP) \* Install to home screen
* Offline support (WIP)
* Graceful error handling \* Catch errors and handle them with ease
* Build process managed by Webpack
  _ Vue Single File Components
  _ Write Javascript in ES6, Babel will transpile
  _ Write style in Sass, just because plain CSS is boring
  _ Write templates in pug, just because plain HTML is verbose
  _ Code splitting and dynamic loading
  _ Separate the requirements from your code
  _ Automatic generation of Service Worker
  _ Uglify and minify your JS
  _ Only 56kB for loading all the home page.
  _ Much more
* Tests
  _ Unit tests
  _ Test components with avoriaz
  _ Test Vuex actions and mutations
  _ E2E tests \* Test UI interaction with Nightwatch
* Fully customizable
* In-depth documentation

## Todo

* Find a better, shorter name for the project
* Vuex/Store
  _ [Modularize the store](https://vuex.vuejs.org/en/modules.html)
  _ Do we need this?
* Transform into a `vue-cli` template \* Is it worth?

## Docs

Quickstart:

```
git clone https://github.com/crisbal/vue-webpack-ssr-fully-featured
cd vue-webpack-ssr-fully-featured
npm install
npm run dev
```

Check out the [official documentation](docs/Index.md) for info on how to get started and to get an idea on how everything works.

## Lighthouse Score

![Lighthouse score](docs/images/lighthouse-score.png)

## Contributing

Feel free to submit issues and pull requests, I will try to answer as soon as possible.

## Thanks

For mostly the build scripts and SSR we are using code from a few different repos:

* [vuejs/vue-hackernews-2.0](https://github.com/vuejs/vue-hackernews-2.0)
* [vuejs/pwa](https://github.com/vuejs/pwa/)
* [Narkoleptika/webpack-everything](https://github.com/Narkoleptika/webpack-everything)

The code for the build scripts and SSR was taken and changed for our needs.
