<template>
  <div class="home-page">
    <UContainer>
      <div class="content-wrapper">
        <aside class="sidebar">
          <h3>Категории</h3>
          <ul class="sidebar-list">
            <li :class="{ active: selectedTopic === null }" @click="selectedTopic = null">Все</li>
            <li v-for="topic in topicOptions" :key="topic" :class="{ active: selectedTopic === topic }" @click="selectedTopic = topic">{{ topic }}</li>
          </ul>
        </aside>

        <main class="main-content">
          <div class="header">
            <h1>Блог</h1>
            <NewPostModal @created="refreshPosts" />
          </div>

          <div class="posts-grid" v-if="filteredPosts.length > 0">
            <PostCard v-for="post in filteredPosts" :key="post.slug" :post="post" />
          </div>

          <div v-else class="no-posts">
            <p>Нет постов в выбранной категории. Добавьте первый!</p>
          </div>
        </main>
      </div>
    </UContainer>
  </div>
</template>

<script setup lang="ts">
const { getPosts } = usePosts()
const { data: postsData } = await getPosts()

const posts = computed(() => postsData.value?.data || [])

const topicOptions = [
  'Свадьба',
  'День рождения',
  'Корпоратив',
  'Фотосессия',
  'Ресторан',
  'Выпускной',
  'Вечеринки'
]

const selectedTopic = ref<string | null>(null)

const filteredPosts = computed(() => {
  if (selectedTopic.value === null) {
    return posts.value
  }
  return posts.value.filter(post => post.topic === selectedTopic.value)
})

const refreshPosts = async () => {
  await refreshNuxtData()
}
</script>

<style scoped>
.home-page {
  padding: 2rem 0;
}

.content-wrapper {
  display: flex;
  gap: 2rem;
}

.sidebar {
  width: 250px;
  flex-shrink: 0;
}

.sidebar h3 {
  margin-bottom: 1rem;
  font-size: 1.2rem;
}

.sidebar-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-list li {
  padding: 0.5rem 1rem;
  cursor: pointer;
  border-radius: 0.5rem;
  transition: background 0.2s;
}

.sidebar-list li:hover {
  background: #f4f1ec;
}

.sidebar-list li.active {
  background: #d97706;
  color: white;
}

.main-content {
  flex: 1;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

h1 {
  font-size: 2.5rem;
  margin: 0;
}

.posts-grid {
  display: grid;
  gap: 2rem;
}

.no-posts {
  text-align: center;
  color: #666;
  padding: 4rem 0;
}
</style>