import { messageUrls } from '@/api/urls';

const getMessages = (chatId) => window.axios.get(messageUrls.index(chatId));
const createMessage = (payload) => window.axios.post(messageUrls.store, payload);
const updateMessage = (messageId, payload) => window.axios.put(messageUrls.update(messageId), payload);
const deleteMessage = (messageId) => window.axios.delete(messageUrls.destroy(messageId));

export default {
    getMessages,
    createMessage,
    updateMessage,
    deleteMessage,
};
