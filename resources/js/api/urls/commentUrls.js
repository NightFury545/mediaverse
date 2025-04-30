const commentUrls = {
    index: (commentable) => `/${commentable}/comments`,
    show: (commentable, commentId) => `/${commentable}/comments/${commentId}`,
    store: (commentable) => `/${commentable}/comments`,
    update: (commentId) => `/comments/${commentId}`,
    destroy: (commentId) => `/comments/${commentId}`,
    replies: (commentable, commentId) => `/${commentable}/comments/${commentId}/replies`,
    userComments: '/user/comments',
};

export default commentUrls;
