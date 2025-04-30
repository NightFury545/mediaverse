import { tagUrls } from '@/api/urls';

const getTags = () => window.axios.get(tagUrls.index);

export default {
    getTags,
};
