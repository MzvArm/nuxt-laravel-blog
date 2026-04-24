<template>
  <div class="container" style="display:flex; justify-content:space-between;">
    <b>Blog</b>

    <UButton class="btn-primary" @click="$emit('create')">
      New post
    </UButton>
  </div>
</template>

<script setup lang="ts">
defineEmits(['create'])
</script>