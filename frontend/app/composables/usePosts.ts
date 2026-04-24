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
    title: string
    slug: string
    content: string
    created_at: string
}

export const usePosts = () => {
    const config = useRuntimeConfig()

    const getPosts = () =>
        useFetch<{ data: Post[] }>(`${config.public.apiBase}/posts`)

    const getPost = (slug: string) =>
        useFetch<Post>(`${config.public.apiBase}/posts/${slug}`)

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