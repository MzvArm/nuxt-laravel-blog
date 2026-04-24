<template>
  <div class="card">
    <NuxtLink :to="`/posts/${post.slug}`">
      <h2>{{ post.title }}</h2>

      <p style="opacity: 0.6;">
        {{ formatDate(post.created_at) }}
      </p>
    </NuxtLink>
  </div>
</template>

<script setup lang="ts">
type Post = {
  title: string
  slug: string
  content: string
  created_at: string
}

defineProps<{
  post: Post
}>()

const formatDate = (date: string): string => {
  return new Date(date).toLocaleDateString()
}
</script>