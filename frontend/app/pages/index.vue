<script setup lang="ts">
const { getPosts } = usePosts()

const { data, pending } = await getPosts()
</script>

<template>
  <div class="container">
    <Header />

    <h1>Posts</h1>

    <div v-if="pending">
      <USkeleton v-for="i in 5" :key="i" class="card" />
    </div>

    <div v-else>
      <PostCard
        v-for="post in data?.data"
        :key="post.slug"
        :post="post"
      />
    </div>
  </div>
</template>