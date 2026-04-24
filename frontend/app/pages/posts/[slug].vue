<script setup lang="ts">
import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'

const route = useRoute()
const { getPost } = usePosts()

const slug = route.params.slug as string

const { data, pending } = await getPost(slug)

const formatDate = (date?: string) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('ru-RU', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  })
}
</script>

<template>
  <div class="page-shell">
    <Header />

    <UCard class="post-detail" radius="xxl" border>
      <div class="post-top">
        <UBadge color="warning" variant="soft" size="sm">Пост</UBadge>
        <span class="post-date">{{ formatDate(data?.created_at) }} · 6 мин чтения</span>
      </div>

      <div v-if="pending" class="post-loading">
        <USkeleton height="40px" />
        <USkeleton height="220px" />
      </div>

      <div v-else>
        <h1>{{ data?.title }}</h1>
        <div class="post-content">{{ data?.content }}</div>
      </div>
    </UCard>

    <Footer />
  </div>
</template>

<style scoped>
.page-shell {
  max-width: 900px;
  margin: 0 auto;
  padding: 2rem 1.25rem 4rem;
}

.post-detail {
  display: grid;
  gap: 2rem;
}

.post-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.post-date {
  color: var(--muted);
}

h1 {
  margin: 0;
  font-size: clamp(2rem, 3vw, 3.4rem);
  line-height: 1.05;
}

.post-content {
  color: var(--text);
  line-height: 1.85;
  white-space: pre-wrap;
}
</style>