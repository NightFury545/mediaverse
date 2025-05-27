import React from 'react';
import {
    Box,
    Typography,
    Skeleton,
    useMediaQuery,
    useTheme,
    Button, Container,
} from '@mui/material';
import { motion } from 'framer-motion';
import { useQuery } from 'react-query';
import { Forum } from '@mui/icons-material';
import { Link } from 'react-router-dom';
import { chatActions } from '@/api/actions';
import ChatCard from '@/Components/Social/ChatCard.jsx';

const SkeletonChatCard = () => {
    const theme = useTheme();
    const isMobile = useMediaQuery(theme.breakpoints.down('sm'));

    return (
        <Box
            sx={{
                display: 'flex',
                alignItems: 'center',
                p: { xs: 1, sm: 2 },
                backgroundColor: 'rgba(10, 10, 15, 0.7)',
                borderRadius: 2,
                border: '1px solid rgba(156, 39, 176, 0.2)',
                mb: 1,
            }}
        >
            <Skeleton
                variant="circular"
                width={isMobile ? 40 : 48}
                height={isMobile ? 40 : 48}
                sx={{ mr: { xs: 1, sm: 2 }, bgcolor: 'rgba(255, 255, 255, 0.1)' }}
            />
            <Box sx={{ flexGrow: 1 }}>
                <Skeleton
                    variant="text"
                    width="60%"
                    height={isMobile ? 20 : 24}
                    sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                />
                <Skeleton
                    variant="text"
                    width="80%"
                    height={isMobile ? 16 : 20}
                    sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
                />
            </Box>
            <Skeleton
                variant="text"
                width={isMobile ? 60 : 80}
                height={isMobile ? 16 : 20}
                sx={{ bgcolor: 'rgba(255, 255, 255, 0.1)' }}
            />
        </Box>
    );
};

const EmptyChatsPlaceholder = ({ isError = false, error }) => {
    const theme = useTheme();
    const isMobile = useMediaQuery(theme.breakpoints.down('sm'));

    return (
        <Box
            sx={{
                position: 'fixed',
                top: 0,
                left: 0,
                right: 0,
                bottom: 0,
                background: 'linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 100%)',
                color: '#e0e0e0',
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                p: 3,
                overflow: 'hidden',
                '&::before': {
                    content: '""',
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    backgroundImage: `linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7)),
                    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C27B0' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
                    opacity: 0.3,
                    zIndex: 0,
                },
            }}
        >
            <Box
                sx={{
                    position: 'relative',
                    zIndex: 1,
                    maxWidth: { xs: '100%', sm: '90%', md: '800px' },
                    textAlign: 'center',
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                    mt: { xs: 14, sm: 18 },
                }}
            >
                <motion.div
                    initial={{ scale: 0.8, opacity: 0 }}
                    animate={{ scale: 1, opacity: 1 }}
                    transition={{ duration: 0.6 }}
                >
                    <Forum
                        sx={{
                            fontSize: isMobile ? 100 : 150,
                            color: '#9c27b0',
                            mb: 3,
                            opacity: 0.9,
                        }}
                    />
                </motion.div>

                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.5, delay: 0.2 }}
                >
                    <Typography
                        variant={isMobile ? 'h3' : 'h2'}
                        sx={{
                            fontWeight: 700,
                            color: '#ffffff',
                            mb: 2,
                            lineHeight: 1.2,
                        }}
                    >
                        {isError ? 'Ой, щось пішло не так!' : 'Розпочніть розмову!'}
                    </Typography>
                </motion.div>

                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ duration: 0.5, delay: 0.4 }}
                >
                    <Typography
                        variant={isMobile ? 'body1' : 'h6'}
                        sx={{
                            color: '#b0b0b0',
                            mb: 4,
                            maxWidth: '600px',
                            lineHeight: 1.6,
                        }}
                    >
                        {isError ? (
                            <>
                                Не вдалося завантажити чати.<br />
                                Спробуйте ще раз пізніше.
                            </>
                        ) : (
                            <>
                                Схоже, у вас ще немає чатів.<br />
                                Напишіть комусь першим і почніть спілкування!
                            </>
                        )}
                    </Typography>
                </motion.div>

                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.5, delay: 0.6 }}
                    style={{ display: 'flex', gap: '16px', flexWrap: 'wrap', justifyContent: 'center' }}
                >
                    <Button
                        component={Link}
                        to="/users"
                        variant="contained"
                        sx={{
                            bgcolor: '#9c27b0',
                            color: '#ffffff',
                            fontWeight: 600,
                            px: 4,
                            py: 1.5,
                            borderRadius: '8px',
                            textTransform: 'none',
                            fontSize: isMobile ? '0.875rem' : '1rem',
                            minWidth: '200px',
                            '&:hover': {
                                bgcolor: '#7b1fa2',
                                boxShadow: '0 0 15px rgba(156, 39, 176, 0.5)',
                            },
                        }}
                    >
                        Знайти друзів
                    </Button>

                    <Button
                        component={Link}
                        to="/posts"
                        variant="outlined"
                        sx={{
                            borderColor: 'rgba(156, 39, 176, 0.5)',
                            color: '#e0e0e0',
                            fontWeight: 600,
                            px: 4,
                            py: 1.5,
                            borderRadius: '8px',
                            textTransform: 'none',
                            fontSize: isMobile ? '0.875rem' : '1rem',
                            minWidth: '200px',
                            '&:hover': {
                                borderColor: '#9c27b0',
                                backgroundColor: 'rgba(156, 39, 176, 0.1)',
                            },
                        }}
                    >
                        До постів
                    </Button>
                </motion.div>

                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ duration: 0.5, delay: 0.8 }}
                >
                    <Typography
                        variant="caption"
                        sx={{
                            display: 'block',
                            mt: 4,
                            color: 'rgba(176, 176, 176, 0.5)',
                            fontFamily: 'monospace',
                        }}
                    >
                        {isError ? `// Помилка: ${error?.message || 'невідома'}` : '// Чатів: 0'}
                    </Typography>
                </motion.div>
            </Box>

            {[...Array(20)].map((_, i) => (
                <motion.div
                    key={i}
                    style={{
                        position: 'absolute',
                        backgroundColor: '#fff',
                        borderRadius: '50%',
                        width: `${Math.random() * 3 + 1}px`,
                        height: `${Math.random() * 3 + 1}px`,
                        left: `${Math.random() * 100}%`,
                        top: `${Math.random() * 100}%`,
                        opacity: 0,
                    }}
                    animate={{
                        opacity: [0, 0.8, 0],
                        scale: [1, 1.5, 1],
                    }}
                    transition={{
                        duration: Math.random() * 3 + 2,
                        repeat: Infinity,
                        repeatType: 'reverse',
                        delay: Math.random() * 5,
                    }}
                />
            ))}
        </Box>
    );
};

const ChatsPage = () => {
    const {
        data: chats = [],
        isLoading,
        isError,
        error,
    } = useQuery('chats', () => chatActions.getChats().then(res => res.data.data), {
        staleTime: 0,
        retry: false,
        refetchOnWindowFocus: false
    });

    return (
        <Box
            sx={{
                minHeight: '100vh',
                color: '#e0e0e0',
                bgcolor: 'transparent',
            }}
        >
            {isLoading ? (
                <Container maxWidth="xl" sx={{ py: { xs: 2, sm: 3 } }}>
                    <motion.div
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        transition={{ duration: 0.5 }}
                    >
                        <Box
                            sx={{
                                display: 'flex',
                                flexDirection: 'column',
                                gap: 1,
                                maxWidth: { xs: '100%', sm: 600 },
                                mx: 'auto',
                            }}
                        >
                            {[...Array(4)].map((_, index) => (
                                <SkeletonChatCard key={index} />
                            ))}
                        </Box>
                    </motion.div>
                </Container>
            ) : isError || chats.length === 0 ? (
                <EmptyChatsPlaceholder isError={isError} error={error} />
            ) : (
                <Container maxWidth="xl" sx={{ py: { xs: 2, sm: 3 } }}>
                    <motion.div
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        transition={{ duration: 0.5 }}
                    >
                        <Box
                            sx={{
                                display: 'flex',
                                flexDirection: 'column',
                                gap: 1,
                                maxWidth: { xs: '100%', sm: 600 },
                                mx: 'auto',
                            }}
                        >
                            {chats.map((chat) => (
                                <ChatCard key={chat.id} chat={chat} />
                            ))}
                        </Box>
                    </motion.div>
                </Container>
            )}
        </Box>
    );
};

export default ChatsPage;
