import { postUrls } from '@/api/urls';

const getPosts = () => window.axios.get(postUrls.index);
const getPost = (postId) => window.axios.get(postUrls.show(postId));
const createPost = (payload) => window.axios.post(postUrls.store, payload);
const updatePost = (postId, payload) => window.axios.put(postUrls.update(postId), payload);
const deletePost = (postId) => window.axios.delete(postUrls.destroy(postId));

export default {
    getPosts,
    getPost,
    createPost,
    updatePost,
    deletePost,
};
