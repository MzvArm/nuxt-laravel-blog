// https://nuxt.com/docs/api/configuration/nuxt-config
// export default defineNuxtConfig({
//   compatibilityDate: '2025-07-15',

//   devtools: { enabled: true },

//   modules: ['@nuxt/ui'],

//   runtimeConfig: {
//     public: {
//       apiBase: 'http://localhost:8000/api'
//     }
//   },

//   css: ['~/assets/css/main.css']
// })

// export default defineNuxtConfig({
//   modules: ['@nuxt/ui'],

//   // runtimeConfig — удобно менять API без правки кода
//   runtimeConfig: {
//     public: {
//       apiBase: 'http://localhost:8000/api'
//     }
//   },

//   // Подключаем глобальные стили
//   css: ['~/assets/css/main.css']
// })

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',

  devtools: { enabled: true },

  modules: ['@nuxt/ui'],

  runtimeConfig: {
    public: {
      apiBase: 'http://localhost:8000/api'
    }
  },

  css: ['@/assets/css/main.css']
})