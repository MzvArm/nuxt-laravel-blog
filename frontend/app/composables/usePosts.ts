// type Post = {
//     title: string
//     slug: string
//     content: string
//     created_at: string
// }

// export const usePosts = () => {
//     const config = useRuntimeConfig()

//     const getPosts = () => {
//         return useFetch<{ data: Post[] }>(
//             `${config.public.apiBase}/posts`
//         )
//     }

//     const getPost = (slug: string) => {
//         return useFetch<Post>(
//             `${config.public.apiBase}/posts/${slug}`
//         )
//     }

//     return { getPosts, getPost }
// }

type Post = {
    id: number
    title: string
    slug: string
    content: string
    author: string
    topic: string
    published_at: string
    image_path?: string | null
    created_at: string
    updated_at: string
}

export const usePosts = () => {
    const config = useRuntimeConfig()

    const getPosts = () =>
        useFetch<{ data: Post[] }>(`${config.public.apiBase}/posts`)

    const getPost = (slug: string) =>
        useFetch<{ data: Post }>(`${config.public.apiBase}/posts/${slug}`)

    const createPost = async (payload: {
        title: string
        author: string
        published_at: string
        topic: string
        content: string
    }) => {
        return await $fetch(`${config.public.apiBase}/posts`, {
            method: 'POST',
            body: payload
        })
    }

    return { getPosts, getPost, createPost }
}