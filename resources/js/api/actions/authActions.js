import { authUrls } from '@/api/urls';

const register = (payload) => window.axios.post(authUrls.register, payload);
const login = (payload) => window.axios.post(authUrls.login, payload);
const logout = () => window.axios.post(authUrls.logout);
const refreshToken = () => window.axios.post(authUrls.refreshToken);

const googleRedirect = () => window.axios.get(authUrls.googleRedirect);
const googleCallback = (code) => window.axios.get(authUrls.googleCallback(code));

const githubRedirect = () => window.axios.get(authUrls.githubRedirect);
const githubCallback = (code) => window.axios.get(authUrls.githubCallback(code));

export default {
    register,
    login,
    logout,
    refreshToken,
    googleRedirect,
    googleCallback,
    githubRedirect,
    githubCallback,
};
