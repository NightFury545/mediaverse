import {homeRoutes} from "./homeRoutes";
import {userRoutes} from "./userRoutes.jsx";
import {postRoutes} from "./postRoutes.jsx";

export const routes = [
    ...homeRoutes,
    ...userRoutes,
    ...postRoutes,
];
