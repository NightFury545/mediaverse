import { commentUrls } from '@/api/urls';

const getComments = (commentableType, commentableId) =>
    window.axios.get(commentUrls.index(commentableType, commentableId));

const getComment = (commentId) =>
    window.axios.get(commentUrls.show(commentId));

const createComment = (commentableType, commentableId, payload) =>
    window.axios.post(commentUrls.store(commentableType, commentableId), payload);

const updateComment = (commentId, payload) =>
    window.axios.put(commentUrls.update(commentId), payload);

const deleteComment = (commentId) =>
    window.axios.delete(commentUrls.destroy(commentId));

const getReplies = (commentId) =>
    window.axios.get(commentUrls.replies(commentId));

export default {
    getComments,
    getComment,
    createComment,
    updateComment,
    deleteComment,
    getReplies,
};
