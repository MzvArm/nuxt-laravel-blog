<template>
  <NuxtPage />
</template>

<style global>
:root {
  color-scheme: light;
  --bg: #f4f1ec;
  --surface: #ffffff;
  --text: #1f2937;
  --muted: #575757;
  --accent: #d97706;
  --accent-soft: rgba(217, 119, 6, 0.12);
  --border: rgba(113, 113, 122, 0.14);
  font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

html {
  min-height: 100%;
  background: var(--bg);
}

body {
  margin: 0;
  min-height: 100vh;
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-family, Inter, system-ui, sans-serif);
  line-height: 1.6;
}

* {
  box-sizing: border-box;
}

button,
input,
textarea,
a {
  font: inherit;
}

a {
  color: inherit;
  text-decoration: none;
}

img {
  max-width: 100%;
  display: block;
}
</style>
