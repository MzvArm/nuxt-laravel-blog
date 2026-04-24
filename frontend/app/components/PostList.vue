<template>
  <div class="post-list">
    <PostCard
      v-for="post in posts"
      :key="post.slug"
      :post="post"
    />
  </div>
</template>

<script setup lang="ts">
import PostCard from './PostCard.vue'

type Post = {
  title: string
  slug: string
  content: string
  created_at: string
}

defineProps<{
  posts: Array<Post>
}>()
</script>

<style scoped>
.post-list {
  display: grid;
  gap: 1.5rem;
}
</style>
