import { chatUrls } from '@/api/urls';

const getChats = () => window.axios.get(chatUrls.index);
const getChat = (chatId) => window.axios.get(chatUrls.show(chatId));
const createChat = (payload) => window.axios.post(chatUrls.store, payload);
const updateChat = (chatId, payload) => window.axios.put(chatUrls.update(chatId), payload);
const deleteChat = (chatId) => window.axios.delete(chatUrls.destroy(chatId));

export default {
    getChats,
    getChat,
    createChat,
    updateChat,
    deleteChat,
};
