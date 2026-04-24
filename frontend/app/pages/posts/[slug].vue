<script setup lang="ts">
const route = useRoute()
const { getPost } = usePosts()

const slug = route.params.slug as string

const { data, pending } = await getPost(slug)
</script>

<template>
  <div class="container">
    <Header />

    <div v-if="pending">
      <USkeleton height="40px" />
      <USkeleton height="200px" />
    </div>

    <div v-else>
      <h1>{{ data?.title }}</h1>

      <div class="post-content">
        {{ data?.content }}
      </div>
    </div>
    </div>
  </template>