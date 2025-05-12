import PostsPage from "@/Pages/Social/PostsPage.jsx";
import PostDetailsPage from "@/Pages/Social/PostDetailsPage.jsx";
import CreatePostPage from "@/Pages/Social/CreatePostPage.jsx";

export const postRoutes = [
    {
        path: '/posts',
        element: <PostsPage/>,
    },
    {
        path: '/posts/:identifier',
        element: <PostDetailsPage/>,
    },
    {
        path: '/posts/create',
        element: <CreatePostPage/>,
    },
];
