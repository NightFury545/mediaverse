const BASE_URL = '/auth';

const authUrls = {
    register: `${BASE_URL}/register`,
    login: `${BASE_URL}/login`,
    logout: `${BASE_URL}/logout`,
    refreshToken: `${BASE_URL}/refresh-token`,

    googleRedirect: `${BASE_URL}/google`,
    googleCallback: `${BASE_URL}/google/callback`,

    githubRedirect: `${BASE_URL}/github`,
    githubCallback: `${BASE_URL}/github/callback`,
};

export default authUrls;
