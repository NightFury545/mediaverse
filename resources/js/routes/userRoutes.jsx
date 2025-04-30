import UserProfilePage from "@/Pages/Social/UserProfilePage.jsx";

export const userRoutes = [
    {
        path: '/users/:username',
        element: <UserProfilePage/>,
    },
];
