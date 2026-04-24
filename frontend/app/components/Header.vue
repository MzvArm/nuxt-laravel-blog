<template>
  <div class="header">
    <div><b>bash.today clone</b></div>

    <UButton @click="toggleTheme">
      Toggle theme
    </UButton>
  </div>
</template>

<script setup lang="ts">
// управление темой Nuxt UI
const colorMode = useColorMode()

const toggleTheme = (): void => {
  colorMode.preference =
    colorMode.preference === 'dark' ? 'light' : 'dark'
}
</script>