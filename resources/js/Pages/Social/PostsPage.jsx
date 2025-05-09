import React, { useState, useEffect, useRef, useCallback } from 'react';
import { useInfiniteQuery, useQuery } from 'react-query';
import { motion, AnimatePresence } from 'framer-motion';
import {
    Box,
    Container,
    Grid,
    Typography,
    CircularProgress,
    Skeleton,
    Divider,
    IconButton,
    Paper,
    Button,
    Drawer,
    useMediaQuery,
    useTheme, Chip
} from '@mui/material';
import {
    KeyboardArrowUp,
    FilterList,
    Whatshot,
    Favorite,
    ChatBubbleOutline,
    PostAdd,
    SentimentDissatisfied
} from '@mui/icons-material';
import PostCard from '@/Components/Social/PostCard.jsx';
import PostsFilter from '@/Components/Social/PostsFilter.jsx';
import {likeActions, postActions} from '@/api/actions';
import {useAuth} from "@/Components/Auth/AuthProvider.jsx";

const fetchPosts = async ({ pageParam = null, query = '' }) => {
    const response = pageParam
        ? await window.axios.get(pageParam)
        : await postActions.getPosts(query);

    return {
        posts: response.data.data.map((post) => ({
            id: post.id,
            title: post.title,
            content: post.content,
            user: {
                id: post.user?.id,
                name: post.user?.username || 'Anonymous',
                avatar: post.user?.avatar || `https://i.pravatar.cc/150?img=${post.user?.id || 0}`
            },
            attachments: post.attachments || [],
            likes_count: post.likes_count || 0,
            comments_count: post.comments_count || 0,
            views_count: post.views_count || 0,
            created_at: post.created_at,
            slug: post.slug,
            tags: post.tags ? post.tags.map(tag => tag.name) : [],
            visibility: post.visibility || 'public',
            comments_enabled: post.comments_enabled ?? true
        })),
        nextCursor: response.data.next_cursor,
        nextPageUrl: response.data.next_page_url,
        hasMore: !!response.data.next_page_url,
        totalPosts: response.data.data.length
    };
};

const fetchUserLikes = async () => {
    const query = 'filter[likeable_type]=Post';
    const response = await likeActions.getUserLikes(query);
    return response.data.data;
};

const fetchTopPosts = async () => {
    const response = await postActions.getPosts('sort=-comments_count&perPage=10');
    return {
        posts: response.data.data.map((post) => ({
            id: post.id,
            title: post.title,
            tags: post.tags || [],
            likes_count: post.likes_count || 0,
            comments_count: post.comments_count || 0
        })),
        totalPosts: response.data.data.length
    };
};

const EmptyPostsPlaceholder = () => (
    <motion.div
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.3 }}
    >
        <Paper
            sx={{
                backgroundColor: 'rgba(10, 10, 15, 0.7)',
                borderRadius: 2,
                p: 4,
                textAlign: 'center',
                border: '1px solid rgba(156, 39, 176, 0.2)',
                boxShadow: '0 4px 20px rgba(0, 0, 0, 0.3)',
                marginBottom: 3
            }}
        >
            <PostAdd sx={{ fontSize: 60, color: '#9c27b0', mb: 2, opacity: 0.8 }} />
            <Typography variant="h5" sx={{ mb: 2, color: '#ffffff', fontWeight: 500 }}>
                No posts found
            </Typography>
            <Typography
                variant="body1"
                sx={{ color: '#b0b0b0', mb: 3, maxWidth: '400px', margin: '0 auto' }}
            >
                It looks quiet here. Be the first to share something with the community!
            </Typography>
            <Button
                variant="contained"
                startIcon={<PostAdd />}
                sx={{
                    bgcolor: '#9c27b0',
                    marginTop: '16px',
                    '&:hover': {
                        bgcolor: '#7b1fa2',
                        boxShadow: '0 0 10px rgba(156, 39, 176, 0.5)'
                    }
                }}
            >
                Create First Post
            </Button>
        </Paper>
    </motion.div>
);

const EmptyTopPostsPlaceholder = () => (
    <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ duration: 0.3 }}
    >
        <Paper
            sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                borderRadius: 2,
                p: 3,
                textAlign: 'center',
                border: '1px dashed rgba(156, 39, 176, 0.3)'
            }}
        >
            <SentimentDissatisfied
                sx={{ fontSize: 40, color: '#9c27b0', mb: 1, opacity: 0.7 }}
            />
            <Typography variant="body1" sx={{ color: '#b0b0b0', fontStyle: 'italic' }}>
                No trending posts yet
            </Typography>
            <Typography variant="caption" sx={{ color: '#b0b0b0', display: 'block', mt: 1 }}>
                Popular posts will appear here
            </Typography>
        </Paper>
    </motion.div>
);

const PostsPage = () => {
    const theme = useTheme();
    const isMobile = useMediaQuery(theme.breakpoints.down('md'));
    const isTablet = useMediaQuery(theme.breakpoints.between('sm', 'lg'));
    const isDesktop = useMediaQuery(theme.breakpoints.up('lg'));
    const [query, setQuery] = useState('sort=-created_at');
    const [showScrollTop, setShowScrollTop] = useState(false);
    const [showFilters, setShowFilters] = useState(false);
    const observer = useRef();
    const loadingRef = useRef(false);
    const { isAuthenticated } = useAuth();
    const { user } = useAuth();

    const {
        data,
        fetchNextPage,
        hasNextPage,
        isFetchingNextPage,
        isLoading,
        isError,
        error
    } = useInfiniteQuery(
        ['posts', query],
        ({ pageParam }) => fetchPosts({ pageParam, query }),
        {
            getNextPageParam: (lastPage) => lastPage.nextPageUrl || undefined,
            refetchOnWindowFocus: false,
            staleTime: 1000 * 60 * 5,
            keepPreviousData: true
        }
    );

    const {
        data: userLikes = [],
        isLoading: isUserLikesLoading,
        isError: isUserLikesError,
        error: userLikesError
    } = useQuery(['userLikes'], fetchUserLikes, {
        enabled: !!isAuthenticated && !!user.email_verified_at,
        staleTime: 1000 * 60 * 5,
        select: (likes) => {
            return likes.reduce((acc, like) => {
                if (like.likeable_type === 'App\\Models\\Post') {
                    acc[like.likeable_id] = {
                        user_liked: true,
                        like_id: like.id
                    };
                }
                return acc;
            }, {});
        }
    });

    const {
        data: topPostsData,
        isLoading: isTopPostsLoading,
        isError: isTopPostsError,
        error: topPostsError
    } = useQuery('topPosts', fetchTopPosts, {
        staleTime: 1000 * 60 * 5
    });

    const lastPostRef = useCallback(
        (node) => {
            if (isFetchingNextPage || loadingRef.current) return;
            if (observer.current) observer.current.disconnect();

            observer.current = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && hasNextPage) {
                    loadingRef.current = true;
                    fetchNextPage().finally(() => {
                        loadingRef.current = false;
                    });
                }
            });

            if (node) observer.current.observe(node);
        },
        [isFetchingNextPage, hasNextPage, fetchNextPage]
    );

    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

    const handleApplyFilters = (queryString) => {
        setQuery(queryString || 'sort=-created_at');
    };

    useEffect(() => {
        const handleScroll = () => {
            if (window.pageYOffset > 300) {
                setShowScrollTop(true);
            } else {
                setShowScrollTop(false);
            }
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    const posts = data?.pages?.flatMap(page => page.posts) || [];
    const totalPosts = data?.pages?.reduce((sum, page) => sum + (page.totalPosts || 0), 0) || 0;
    const topPosts = topPostsData?.posts || [];
    const totalTopPosts = topPostsData?.totalPosts || 0;

    const toggleFilters = () => {
        setShowFilters(!showFilters);
    };

    const FilterButton = () => (
        <Button
            startIcon={<FilterList />}
            onClick={toggleFilters}
            sx={{
                mb: 2,
                color: '#e0e0e0',
                border: '1px solid rgba(156, 39, 176, 0.5)',
                '&:hover': {
                    backgroundColor: 'rgba(156, 39, 176, 0.1)',
                    boxShadow: '0 0 10px rgba(156, 39, 176, 0.3)'
                }
            }}
        >
            Filters
        </Button>
    );

    const TopPostsSidebar = () => (
        <Paper
            sx={{
                backdropFilter: 'blur(10px)',
                borderRadius: 2,
                p: 2,
                border: '1px solid rgba(156, 39, 176, 0.2)',
                background: 'rgba(10, 10, 15, 0.7)',
                boxShadow: '0 4px 20px rgba(0, 0, 0, 0.3)',
                position: 'sticky',
                top: 20,
                minWidth: 250
            }}
        >
            <Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
                <Whatshot sx={{ mr: 1, color: '#ff4081' }} />
                <Typography variant="h6" sx={{ color: '#ffffff' }}>
                    Top Posts
                </Typography>
            </Box>
            <Divider sx={{ bgcolor: 'rgba(255, 255, 255, 0.12)', mb: 2 }} />

            {isTopPostsLoading ? (
                <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
                    {Array.from({ length: 3 }).map((_, i) => (
                        <Box key={`top-skeleton-${i}`} sx={{ display: 'flex' }}>
                            <Skeleton
                                variant="rectangular"
                                width={60}
                                height={60}
                                sx={{
                                    borderRadius: 1,
                                    mr: 2,
                                    bgcolor: 'rgba(255, 255, 255, 0.1)'
                                }}
                            />
                            <Box sx={{ flexGrow: 1 }}>
                                <Skeleton
                                    width="80%"
                                    height={20}
                                    sx={{ mb: 1, bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                />
                                <Skeleton
                                    width="60%"
                                    height={16}
                                    sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                />
                            </Box>
                        </Box>
                    ))}
                </Box>
            ) : isTopPostsError ? (
                <Typography color="error" variant="body2">
                    Error loading top posts: {topPostsError.message}
                </Typography>
            ) : totalTopPosts === 0 ? (
                <EmptyTopPostsPlaceholder />
            ) : (
                <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
                    {topPosts?.map((post) => (
                        <motion.div
                            key={post.id}
                            whileHover={{ scale: 1.02 }}
                            whileTap={{ scale: 0.98 }}
                        >
                            <Paper
                                sx={{
                                    backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                    borderRadius: 1,
                                    p: 1.5,
                                    cursor: 'pointer',
                                    transition: 'all 0.2s ease',
                                    '&:hover': {
                                        backgroundColor: 'rgba(156, 39, 176, 0.1)',
                                        boxShadow: '0 0 10px rgba(156, 39, 176, 0.2)'
                                    }
                                }}
                            >
                                <Typography
                                    variant="subtitle2"
                                    sx={{
                                        fontWeight: 600,
                                        mb: 0.5,
                                        display: '-webkit-box',
                                        WebkitLineClamp: 2,
                                        WebkitBoxOrient: 'vertical',
                                        overflow: 'hidden',
                                        color: '#ffffff'
                                    }}
                                >
                                    {post.title}
                                </Typography>
                                <Box sx={{ display: 'flex', alignItems: 'center', mt: 1 }}>
                                    {post.tags?.length > 0 && (
                                        <Chip
                                            label={`# ${post.tags[0].name}`}
                                            size="small"
                                            sx={{
                                                mr: 1,
                                                bgcolor: 'rgba(156, 39, 176, 0.2)',
                                                color: '#e0e0e0'
                                            }}
                                        />
                                    )}
                                    <Box sx={{ display: 'flex', alignItems: 'center', ml: 'auto' }}>
                                        <Favorite
                                            sx={{ fontSize: 16, color: '#ff4081', mr: 0.5 }}
                                        />
                                        <Typography variant="caption" sx={{ mr: 1, color: '#e0e0e0' }}>
                                            {post.likes_count.toLocaleString()}
                                        </Typography>
                                        <ChatBubbleOutline
                                            sx={{ fontSize: 16, color: '#b0b0b0', mr: 0.5 }}
                                        />
                                        <Typography variant="caption" sx={{ color: '#e0e0e0' }}>
                                            {post.comments_count.toLocaleString()}
                                        </Typography>
                                    </Box>
                                </Box>
                            </Paper>
                        </motion.div>
                    ))}
                </Box>
            )}
        </Paper>
    );

    return (
        <Box
            sx={{
                minHeight: '100vh',
                color: '#e0e0e0',
                pt: 2,
                pb: 8
            }}
        >
            <Container maxWidth="xl" sx={{ px: { xs: 2, sm: 3, md: 4 } }}>
                {isMobile && <FilterButton />}

                <Drawer
                    anchor="bottom"
                    open={showFilters && isMobile}
                    onClose={toggleFilters}
                    sx={{
                        '& .MuiDrawer-paper': {
                            backgroundColor: 'rgba(10, 10, 15, 0.9)',
                            borderTop: '1px solid rgba(156, 39, 176, 0.3)',
                            backdropFilter: 'blur(12px)',
                            borderRadius: '12px 12px 0 0',
                            px: 2,
                            pt: 2,
                            pb: 4
                        }
                    }}
                >
                    <PostsFilter isMobile={isMobile} onClose={toggleFilters} onApplyFilters={handleApplyFilters} />
                </Drawer>

                <Grid container spacing={3}>
                    {/* Left sidebar - Filters */}
                    {!isMobile && (
                        <Grid
                            item
                            xs={12}
                            md={3}
                            lg={2.5}
                            sx={{
                                display: 'flex',
                                flexDirection: 'column',
                                position: 'sticky',
                                top: 20,
                                alignSelf: 'flex-start',
                                height: 'fit-content'
                            }}
                        >
                            <motion.div
                                initial={{ opacity: 0, x: -20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.3 }}
                            >
                                <PostsFilter onApplyFilters={handleApplyFilters} />
                            </motion.div>
                        </Grid>
                    )}

                    {/* Main content - Posts */}
                    <Grid item xs={12} md={isMobile ? 12 : isTablet ? 7 : isDesktop ? 6 : 12}>
                        {isLoading && (
                            <Box sx={{ display: 'flex', flexDirection: 'column', gap: 3 }}>
                                {Array.from({ length: 5 }).map((_, i) => (
                                    <motion.div
                                        key={`skeleton-${i}`}
                                        initial={{ opacity: 0, y: 20 }}
                                        animate={{ opacity: 1, y: 0 }}
                                        transition={{ delay: i * 0.1 }}
                                    >
                                        <Paper
                                            sx={{
                                                backgroundColor: 'rgba(10, 10, 15, 0.7)',
                                                borderRadius: 2,
                                                p: 2,
                                                border: '1px solid rgba(156, 39, 176, 0.2)',
                                                boxShadow: '0 4px 20px rgba(0, 0, 0, 0.3)'
                                            }}
                                        >
                                            <Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
                                                <Skeleton
                                                    variant="circular"
                                                    width={40}
                                                    height={40}
                                                    sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                                />
                                                <Box sx={{ ml: 2, flexGrow: 1 }}>
                                                    <Skeleton
                                                        width="60%"
                                                        height={20}
                                                        sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                                    />
                                                    <Skeleton
                                                        width="40%"
                                                        height={16}
                                                        sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                                    />
                                                </Box>
                                            </Box>
                                            <Skeleton
                                                width="90%"
                                                height={24}
                                                sx={{ mb: 1, bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                            />
                                            <Skeleton
                                                width="80%"
                                                height={18}
                                                sx={{ mb: 2, bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                                            />
                                            <Skeleton
                                                variant="rectangular"
                                                width="100%"
                                                height={300}
                                                sx={{
                                                    borderRadius: 1,
                                                    bgcolor: 'rgba(255, 255, 255, 0.1)'
                                                }}
                                            />
                                            <Box sx={{ display: 'flex', mt: 2 }}>
                                                <Skeleton
                                                    width={80}
                                                    height={36}
                                                    sx={{
                                                        mr: 1,
                                                        borderRadius: 18,
                                                        bgcolor: 'rgba(255, 255, 255, 0.1)'
                                                    }}
                                                />
                                                <Skeleton
                                                    width={80}
                                                    height={36}
                                                    sx={{
                                                        mr: 1,
                                                        borderRadius: 18,
                                                        bgcolor: 'rgba(255, 255, 255, 0.1)'
                                                    }}
                                                />
                                                <Skeleton
                                                    width={80}
                                                    height={36}
                                                    sx={{
                                                        borderRadius: 18,
                                                        bgcolor: 'rgba(255, 255, 255, 0.1)'
                                                    }}
                                                />
                                            </Box>
                                        </Paper>
                                    </motion.div>
                                ))}
                            </Box>
                        )}

                        {isError && (
                            <motion.div
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                exit={{ opacity: 0 }}
                            >
                                <Paper
                                    sx={{
                                        backgroundColor: 'rgba(10, 10, 15, 0.7)',
                                        borderRadius: 2,
                                        p: 3,
                                        textAlign: 'center',
                                        border: '1px solid rgba(156, 39, 176, 0.2)',
                                        boxShadow: '0 4px 20px rgba(0, 0, 0, 0.3)'
                                    }}
                                >
                                    <Typography variant="h6" color="error" sx={{ mb: 2 }}>
                                        Error loading posts
                                    </Typography>
                                    <Typography variant="body2" sx={{ mb: 2, color: '#e0e0e0' }}>
                                        {error.message}
                                    </Typography>
                                    <Button
                                        variant="contained"
                                        sx={{
                                            bgcolor: '#9c27b0',
                                            '&:hover': {
                                                bgcolor: '#7b1fa2',
                                                boxShadow: '0 0 10px rgba(156, 39, 176, 0.5)'
                                            }
                                        }}
                                        onClick={() => window.location.reload()}
                                    >
                                        Retry
                                    </Button>
                                </Paper>
                            </motion.div>
                        )}

                        {!isLoading && !isError && totalPosts === 0 ? (
                            <EmptyPostsPlaceholder />
                        ) : (
                            <AnimatePresence>
                                {posts.map((post, index) => (
                                    <motion.div
                                        key={post.id}
                                        initial={{ opacity: 0, y: 20 }}
                                        animate={{ opacity: 1, y: 0 }}
                                        exit={{ opacity: 0 }}
                                        transition={{ duration: 0.3 }}
                                        ref={index === posts.length - 1 ? lastPostRef : null}
                                    >
                                        <Box sx={{ mb: 3 }}>
                                            <PostCard
                                                post={post}
                                                userLiked={userLikes[post.id]?.user_liked || false}
                                                likeId={userLikes[post.id]?.like_id} />
                                        </Box>
                                    </motion.div>
                                ))}
                            </AnimatePresence>
                        )}

                        {isFetchingNextPage && (
                            <motion.div
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                exit={{ opacity: 0 }}
                            >
                                <Box sx={{ display: 'flex', justifyContent: 'center', mt: 3, mb: 6 }}>
                                    <CircularProgress size={40} thickness={4} sx={{ color: '#9c27b0' }} />
                                </Box>
                            </motion.div>
                        )}
                    </Grid>

                    {/* Right sidebar - Top Posts */}
                    {isDesktop && (
                        <Grid
                            item
                            lg={3.5}
                            sx={{
                                display: { xs: 'none', lg: 'flex' },
                                flexDirection: 'column',
                                position: 'sticky',
                                top: 20,
                                alignSelf: 'flex-start',
                                height: 'fit-content'
                            }}
                        >
                            <motion.div
                                initial={{ opacity: 0, x: 20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.3 }}
                            >
                                <TopPostsSidebar />
                            </motion.div>
                        </Grid>
                    )}
                </Grid>
            </Container>

            {/* Scroll to top button */}
            <AnimatePresence>
                {showScrollTop && (
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: 20 }}
                        transition={{ duration: 0.3 }}
                        style={{
                            position: 'fixed',
                            bottom: 24,
                            right: 24,
                            zIndex: 1000
                        }}
                    >
                        <IconButton
                            onClick={scrollToTop}
                            sx={{
                                backgroundColor: 'rgba(156, 39, 176, 0.8)',
                                color: 'white',
                                '&:hover': {
                                    backgroundColor: 'rgba(156, 39, 176, 1)',
                                    boxShadow: '0 0 15px rgba(156, 39, 176, 0.5)'
                                }
                            }}
                        >
                            <KeyboardArrowUp />
                        </IconButton>
                    </motion.div>
                )}
            </AnimatePresence>
        </Box>
    );
};

export default PostsPage;
