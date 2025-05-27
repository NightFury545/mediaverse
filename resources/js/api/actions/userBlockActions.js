import { userBlockUrls } from '@/api/urls';

const getUserBlocks = () => window.axios.get(userBlockUrls.index);
const createUserBlock = (payload) => window.axios.post(userBlockUrls.store, payload);
const deleteUserBlock = (userBlockId) => window.axios.delete(userBlockUrls.destroy(userBlockId));

export default {
    getUserBlocks,
    createUserBlock,
    deleteUserBlock,
};
