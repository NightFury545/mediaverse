import React from 'react';
import {Container, Typography} from '@mui/material';
import PostCard from "@/Components/Social/PostCard.jsx";

const UserProfilePage = () => {
    return (
        <div style={{marginTop: "15%", marginLeft: "25%", marginRight: "25%", marginBottom: "15%"}}>
        <PostCard
            userName="example_user"
            userAvatar="https://example.com/avatar.jpg"
            postTime="5 hours ago"
            title="This is an example post title"
            content="This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title. This is some example post content that might appear below the title."
            media={[
                { type: 'image', url: 'https://images.unsplash.com/photo-1579353977828-2a4eab540b9a' },
                { type: 'image', url: 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb' },
                { type: 'video', url: 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4' },
                { type: 'video', url: 'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4' },
            ]}
            likes={245}
            comments={32}
            views={1500}
            subreddit="javascript"
        />
        </div>
    );
};

export default UserProfilePage;
