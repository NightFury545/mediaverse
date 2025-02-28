const fetchChats = async () => {
    try {
        const response = await window.axios.get('/chats');
        return response.data;
    } catch (error) {
        console.error("Error fetching chats:", error);
        throw error;
    }
};

export default fetchChats;
