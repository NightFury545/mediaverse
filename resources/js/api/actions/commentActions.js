import { commentUrls } from '@/api/urls';

const getComments = (commentable) => window.axios.get(commentUrls.index(commentable));
const getComment = (commentable, commentId) => window.axios.get(commentUrls.show(commentable, commentId));
const createComment = (commentable, payload) => window.axios.post(commentUrls.store(commentable), payload);
const updateComment = (commentId, payload) => window.axios.put(commentUrls.update(commentId), payload);
const deleteComment = (commentId) => window.axios.delete(commentUrls.destroy(commentId));

const getReplies = (commentable, commentId) => window.axios.get(commentUrls.replies(commentable, commentId));

export default {
    getComments,
    getComment,
    createComment,
    updateComment,
    deleteComment,
    getReplies,
};
