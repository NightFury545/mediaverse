import { userUrls } from '@/api/urls';

const getUsers = () => window.axios.get(userUrls.index);
const getUser = (userId) => window.axios.get(userUrls.show(userId));
const updateUser = (userId, payload) => window.axios.put(userUrls.update(userId), payload);
const deleteUser = (userId) => window.axios.delete(userUrls.delete(userId));
const getMe = () => window.axios.get(userUrls.me);

export default {
    getUsers,
    getUser,
    updateUser,
    deleteUser,
    getMe,
};
