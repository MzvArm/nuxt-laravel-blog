<template>
  <UCard class="post-card" radius="3xl" border>
    <NuxtLink :to="`/posts/${post.slug}`" class="card-link">
      <img v-if="post.image_path" :src="post.image_path" :alt="post.title" class="post-image" />
      
      <div class="card-head">
        <!-- <UBadge color="warning" variant="soft" size="sm">Блог</UBadge> -->
        <span class="post-meta">{{ formatDate(post.created_at) }} · 4 мин чтения</span>
      </div>

      <h2>{{ post.title }}</h2>
      <p class="excerpt">{{ excerpt }}</p>

      <div class="card-footer">
        <UButton variant="ghost" size="sm" color="warning" class="u-button">Читать</UButton>
      </div>
    </NuxtLink>
  </UCard>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type Post = {
  title: string
  slug: string
  content: string
  image_path?: string | null
  created_at: string
}

const { post } = defineProps<{
  post: Post
}>()

const formatDate = (date: string): string => {
  return new Date(date).toLocaleDateString('ru-RU', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  })
}

const excerpt = computed(() => {
  return post.content
    ? post.content.slice(0, 150).trim() + (post.content.length > 150 ? '…' : '')
    : ''
})
</script>

<style scoped>
.post-card {
  overflow: hidden;
  border-radius: 32px;
  padding: 1.5rem;
  border: 1px solid #f97316; /* Оранжевый бордер */
}

.card-link {
  display: grid;
  gap: 1.25rem;
  color: inherit;
  text-decoration: none;
}

.post-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 12px;
  /* margin: -1.5rem -1.5rem 0 -1.5rem; */
}

.card-head {
  display: flex;
  justify-content: space-between;
  gap: 1rem;
  align-items: center;
  flex-wrap: wrap;
}

.post-meta {
  color: var(--muted);
  font-size: 0.95rem;
}

h2 {
  margin: 0;
  font-size: 1.8rem;
  line-height: 1.2;
  color: var(--text);
}

.excerpt {
  margin: 0;
  color: var(--muted);
  line-height: 1.85;
}

.card-footer {
  display: flex;
  justify-content: flex-start;
}

.read-button {
  padding-left: 0;
  padding-right: 0;
}
</style>
