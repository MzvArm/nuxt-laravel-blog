type Post = {
    title: string
    slug: string
    content: string
    created_at: string
}

export const usePosts = () => {
    const config = useRuntimeConfig()

    const getPosts = () => {
        return useFetch<{ data: Post[] }>(
            `${config.public.apiBase}/posts`
        )
    }

    const getPost = (slug: string) => {
        return useFetch<Post>(
            `${config.public.apiBase}/posts/${slug}`
        )
    }

    return { getPosts, getPost }
}