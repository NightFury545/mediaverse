import UserProfilePage from "@/Pages/Social/UserProfilePage.jsx";
import UserSettingsPage from "@/Pages/Social/UserSettingsPage.jsx";

export const userRoutes = [
    {
        path: '/users/:username',
        element: <UserProfilePage/>,
    },
    {
        path: '/settings',
        element: <UserSettingsPage/>,
    },
];
