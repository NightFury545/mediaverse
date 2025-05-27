import React, { useState } from 'react';
import {
    Box,
    Typography,
    Avatar,
    IconButton,
    Dialog,
    DialogContent,
    useMediaQuery,
    useTheme,
    Grid,
    Button,
    Divider,
} from '@mui/material';
import { motion, AnimatePresence } from 'framer-motion';
import {
    Edit,
    Delete,
    Check,
    Close,
} from '@mui/icons-material';
import { useMutation, useQueryClient } from 'react-query';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import '../../../css/quill.css';
import { messageActions } from '@/api/actions';
import { useAuth } from '@/Components/Auth/AuthProvider.jsx';
import { toast } from 'react-toastify';

// Constants for styles
const COLORS = {
    chatBackground: 'rgba(10, 10, 15, 0.98)',
    accent: '#9c27b0',
    textPrimary: '#ffffff',
    textSecondary: 'rgba(255, 255, 255, 0.7)',
    border: 'rgba(156, 39, 176, 0.3)',
    error: '#f44336',
    dateDivider: 'rgba(156, 39, 176, 0.5)',
};

const SIZES = {
    avatarMessage: 40,
    fontSizeMessage: { xs: '14px', sm: '15px' },
    padding: { xs: '12px', sm: '16px' },
    borderRadius: { xs: 0, sm: '12px' },
    messageMargin: '12px',
};

const quillModules = {
    toolbar: [
        ['bold', 'italic', 'underline'],
        ['link', 'blockquote', 'code-block'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        ['clean'],
    ],
};

const quillFormats = [
    'header',
    'bold', 'italic', 'underline',
    'link', 'blockquote', 'code-block',
    'list', 'bullet',
];

// Format time to HH:mm
const formatTime = (date) => {
    return new Date(date).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    });
};

const MediaPreview = ({ attachments, isMobile }) => {
    const count = attachments.length;
    if (count === 0) return null;

    return (
        <Grid container spacing={1} sx={{ mt: 1, maxWidth: isMobile ? '80%' : 300 }}>
            {attachments.slice(0, 5).map((media, index) => {
                const isVideo = media.type.startsWith('video');
                return (
                    <Grid item xs={count <= 2 ? 6 : 4} key={index}>
                        {isVideo ? (
                            <video
                                src={media.url}
                                controls
                                style={{
                                    width: '100%',
                                    borderRadius: '8px',
                                    maxHeight: count <= 2 ? '150px' : '100px',
                                    objectFit: 'cover',
                                    border: `1px solid ${COLORS.border}`,
                                }}
                            />
                        ) : (
                            <img
                                src={media.url}
                                alt={`Media ${index}`}
                                style={{
                                    width: '100%',
                                    borderRadius: '8px',
                                    maxHeight: count <= 2 ? '150px' : '100px',
                                    objectFit: 'cover',
                                    border: `1px solid ${COLORS.border}`,
                                }}
                            />
                        )}
                    </Grid>
                );
            })}
            {count > 5 && (
                <Grid item xs={4}>
                    <Box
                        sx={{
                            width: '100%',
                            height: '100px',
                            borderRadius: '8px',
                            border: `1px solid ${COLORS.border}`,
                            bgcolor: 'rgba(255, 255, 255, 0.05)',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            color: COLORS.textPrimary,
                            fontSize: SIZES.fontSizeMessage,
                        }}
                    >
                        +{count - 5}
                    </Box>
                </Grid>
            )}
        </Grid>
    );
};

const DateDivider = ({ date }) => (
    <Box sx={{ display: 'flex', alignItems: 'center', my: 2 }}>
        <Divider sx={{ flexGrow: 1, borderColor: COLORS.dateDivider }} />
        <Typography
            variant="caption"
            sx={{
                mx: 2,
                color: COLORS.textSecondary,
                fontSize: '12px',
                fontWeight: 500,
            }}
        >
            {new Date(date).toLocaleDateString('uk', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            })}
        </Typography>
        <Divider sx={{ flexGrow: 1, borderColor: COLORS.dateDivider }} />
    </Box>
);

const Message = ({ message, chatId, id, previousMessage, nextMessage }) => {
    const { user } = useAuth();
    const queryClient = useQueryClient();
    const theme = useTheme();
    const isMobile = useMediaQuery(theme.breakpoints.down('sm'));
    const isOwnMessage = message.user_id === user.id;
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const [editContent, setEditContent] = useState(message.content);
    const [isHovered, setIsHovered] = useState(false);

    // Debug: Log message content length
    console.log('Message content length:', { id: message.id, length: message.content?.length || 0 });

    const showDateDivider = () => {
        if (!previousMessage) return true;
        const prevDate = new Date(previousMessage.created_at).toDateString();
        const currentDate = new Date(message.created_at).toDateString();
        return prevDate !== currentDate;
    };

    const editMessageMutation = useMutation(
        (payload) => messageActions.updateMessage(message.id, payload),
        {
            onSuccess: (response) => {
                const updatedMessage = response.data.message;
                queryClient.setQueryData(['messages', chatId], (oldData) => {
                    if (!oldData || !Array.isArray(oldData)) return oldData;
                    return oldData.map((m) =>
                        m.id === message.id ? { ...m, content: updatedMessage.content } : m
                    );
                });
                setEditContent(updatedMessage.content);
                setIsEditModalOpen(false);
                toast.success('Повідомлення відредаговано');
            },
            onError: (error) => {
                toast.error(`Помилка редагування: ${error.response?.data?.message || 'Щось пішло не так'}`);
            },
        }
    );

    const deleteMessageMutation = useMutation(
        () => messageActions.deleteMessage(message.id),
        {
            onSuccess: () => {
                queryClient.setQueryData(['messages', chatId], (oldData) => {
                    if (!oldData || !Array.isArray(oldData)) return oldData;
                    return oldData.filter((m) => m.id !== message.id);
                });
                toast.success('Повідомлення видалено');
            },
            onError: (error) => {
                toast.error(`Помилка видалення: ${error.response?.data?.message || 'Щось пішло не так'}`);
            },
        }
    );

    const retryMessageMutation = useMutation(
        (payload) => messageActions.createMessage(payload),
        {
            onSuccess: (response) => {
                queryClient.setQueryData(['messages', chatId], (oldData) => {
                    if (!oldData || !Array.isArray(oldData)) return oldData;
                    return oldData.map((m) =>
                        m.id === message.id ? { ...response.data, isPending: false, isError: false } : m
                    );
                });
                toast.success('Повідомлення надіслано');
            },
            onError: (error) => {
                toast.error(`Повторна спроба не вдалася: ${error.response?.data?.message || 'Щось пішло не так'}`);
            },
        }
    );

    const handleEditOpen = () => {
        setEditContent(message.content);
        setIsEditModalOpen(true);
    };

    const handleEditClose = () => {
        setIsEditModalOpen(false);
    };

    const handleEditSave = () => {
        if (editContent.trim() && editContent !== '<p><br></p>') {
            editMessageMutation.mutate({ content: editContent });
        }
    };

    const handleDelete = () => {
        if (window.confirm('Ви впевнені, що хочете видалити це повідомлення?')) {
            deleteMessageMutation.mutate();
        }
    };

    const handleRetry = () => {
        const formData = new FormData();
        formData.append('content', message.content);
        formData.append('chat_id', chatId);
        message.attachments.forEach((attachment, index) => {
            formData.append(`attachments[${index}]`, attachment.url);
        });
        retryMessageMutation.mutate(formData);
    };

    const displayName = message.user.first_name && message.user.last_name
        ? `${message.user.first_name} ${message.user.last_name}`
        : message.user.username || 'Користувач';

    return (
        <>
            {showDateDivider() && (
                <DateDivider date={message.created_at} />
            )}
            <motion.div
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.3 }}
                id={id}
                onMouseEnter={() => setIsHovered(true)}
                onMouseLeave={() => setIsHovered(false)}
                style={{
                    display: 'flex',
                    justifyContent: isOwnMessage ? 'flex-end' : 'flex-start',
                    marginBottom: SIZES.messageMargin,
                    paddingLeft: isMobile ? '8px' : '16px',
                    paddingRight: isMobile ? '8px' : '16px',
                    position: 'relative',
                }}
            >
                <Box
                    sx={{
                        display: 'flex',
                        flexDirection: isOwnMessage ? 'row-reverse' : 'row',
                        alignItems: 'flex-start',
                        gap: 1,
                        maxWidth: isMobile ? '90%' : '50%',
                        width: '100%',
                    }}
                >
                    <Avatar
                        src={message.user.avatar}
                        alt={displayName}
                        sx={{
                            width: SIZES.avatarMessage,
                            height: SIZES.avatarMessage,
                            bgcolor: COLORS.accent,
                            flexShrink: 0,
                        }}
                    />
                    <Box
                        sx={{
                            position: 'relative',
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'flex-start',
                            mt: '4px',
                        }}
                    >
                        <Box
                            sx={{
                                bgcolor: isOwnMessage ? 'rgba(156, 39, 176, 0.2)' : 'rgba(255, 255, 255, 0.05)',
                                borderRadius: isOwnMessage
                                    ? '12px 0 12px 12px'
                                    : '0 12px 12px 12px',
                                p: 1.5,
                                paddingBottom: '4px',
                                backdropFilter: 'blur(10px)',
                                border: message.isError
                                    ? `1px solid ${COLORS.error}`
                                    : `1px solid ${COLORS.border}`,
                                boxShadow: '0 2px 10px rgba(0, 0, 0, 0.3)',
                                opacity: message.isPending ? 0.6 : 1,
                                minWidth: '120px',
                                maxWidth: { xs: '90%', sm: '600px' }, // Added maxWidth
                                ml: isOwnMessage ? 0 : '12px',
                                mr: isOwnMessage ? '12px' : 0,
                            }}
                        >
                            <Typography
                                variant="caption"
                                sx={{
                                    color: COLORS.textSecondary,
                                    fontSize: '12px',
                                    fontWeight: 500,
                                    mb: 0.5,
                                    display: 'block',
                                }}
                            >
                                {displayName}
                            </Typography>
                            {message.content && (
                                <Typography
                                    sx={{
                                        color: COLORS.textPrimary,
                                        fontSize: SIZES.fontSizeMessage,
                                        lineHeight: 1.4,
                                        wordBreak: 'break-word',
                                        '& b': { fontWeight: 700 },
                                        '& i': { fontStyle: 'italic' },
                                        '& u': { textDecoration: 'underline' },
                                        '& li': { display: 'list-item', listStyleType: 'bullet', ml: 2 },
                                        '& p': { margin: 0 },
                                        '& blockquote': {
                                            borderLeft: `2px solid ${COLORS.accent}`,
                                            pl: 1,
                                            ml: 0.5,
                                        },
                                        '& code': {
                                            bgcolor: 'rgba(255, 255, 255, 0.05)',
                                            p: 0.5,
                                            borderRadius: '4px',
                                        },
                                    }}
                                    dangerouslySetInnerHTML={{ __html: message.content }}
                                />
                            )}
                            <MediaPreview
                                attachments={message.attachments || []}
                                isMobile={isMobile}
                            />
                            {message.isError && (
                                <Button
                                    variant="outlined"
                                    size="small"
                                    onClick={handleRetry}
                                    sx={{
                                        mt: 1,
                                        color: COLORS.error,
                                        borderColor: COLORS.error,
                                        '&:hover': {
                                            borderColor: COLORS.error,
                                            backgroundColor: 'rgba(244, 67, 54, 0.1)',
                                        },
                                    }}
                                >
                                    Повторити
                                </Button>
                            )}
                            <Box
                                sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: isOwnMessage ? 'flex-start' : 'flex-end',
                                    mt: 1,
                                    gap: 0.5,
                                }}
                            >
                                {isOwnMessage ? (
                                    <>
                                        <AnimatePresence>
                                            {message.is_read ? (
                                                <>
                                                    <motion.div
                                                        initial={{ opacity: 0, x: -5 }}
                                                        animate={{ opacity: 1, x: 0 }}
                                                        transition={{ delay: 0.1, duration: 0.3 }}
                                                    >
                                                        <Check sx={{ color: COLORS.accent, fontSize: 16 }} />
                                                    </motion.div>
                                                    <motion.div
                                                        initial={{ opacity: 0, x: -5 }}
                                                        animate={{ opacity: 1, x: 0 }}
                                                        transition={{ duration: 0.3 }}
                                                    >
                                                        <Check sx={{ color: COLORS.accent, fontSize: 16, ml: -0.5 }} />
                                                    </motion.div>
                                                </>
                                            ) : (
                                                <motion.div
                                                    initial={{ opacity: 0 }}
                                                    animate={{ opacity: 1 }}
                                                    transition={{ duration: 0.3 }}
                                                >
                                                    <Check sx={{ color: COLORS.textSecondary, fontSize: 16 }} />
                                                </motion.div>
                                            )}
                                        </AnimatePresence>
                                        <Typography
                                            variant="caption"
                                            sx={{
                                                color: COLORS.textSecondary,
                                                fontSize: '12px',
                                            }}
                                        >
                                            {formatTime(message.created_at)}
                                        </Typography>
                                    </>
                                ) : (
                                    <>
                                        <Typography
                                            variant="caption"
                                            sx={{
                                                color: COLORS.textSecondary,
                                                fontSize: '12px',
                                            }}
                                        >
                                            {formatTime(message.created_at)}
                                        </Typography>
                                        <AnimatePresence>
                                            {message.is_read ? (
                                                <>
                                                    <motion.div
                                                        initial={{ opacity: 0, x: 5 }}
                                                        animate={{ opacity: 1, x: 0 }}
                                                        transition={{ delay: 0.1, duration: 0.3 }}
                                                    >
                                                        <Check sx={{ color: COLORS.accent, fontSize: 16 }} />
                                                    </motion.div>
                                                    <motion.div
                                                        initial={{ opacity: 0, x: 5 }}
                                                        animate={{ opacity: 1, x: 0 }}
                                                        transition={{ duration: 0.3 }}
                                                    >
                                                        <Check sx={{ color: COLORS.accent, fontSize: 16, ml: -0.5 }} />
                                                    </motion.div>
                                                </>
                                            ) : (
                                                <motion.div
                                                    initial={{ opacity: 0 }}
                                                    animate={{ opacity: 1 }}
                                                    transition={{ duration: 0.3 }}
                                                >
                                                    <Check sx={{ color: COLORS.textSecondary, fontSize: 16 }} />
                                                </motion.div>
                                            )}
                                        </AnimatePresence>
                                    </>
                                )}
                            </Box>
                            {isHovered && isOwnMessage && !message.isError && (
                                <Box
                                    sx={{
                                        position: 'absolute',
                                        top: '50%',
                                        [isOwnMessage ? 'left' : 'right']: '-48px',
                                        transform: 'translateY(-50%)',
                                        display: 'flex',
                                        flexDirection: 'column',
                                        gap: 1,
                                        bgcolor: COLORS.chatBackground,
                                        p: 0.5,
                                        borderRadius: '8px',
                                        border: `1px solid ${COLORS.border}`,
                                        boxShadow: '0 2px 10px rgba(0, 0, 0, 0.3)',
                                    }}
                                >
                                    <IconButton
                                        size="small"
                                        onClick={handleEditOpen}
                                        sx={{
                                            color: COLORS.textSecondary,
                                            '&:hover': { color: COLORS.accent },
                                        }}
                                    >
                                        <Edit fontSize="small" />
                                    </IconButton>
                                    <IconButton
                                        size="small"
                                        onClick={handleDelete}
                                        sx={{
                                            color: COLORS.textSecondary,
                                            '&:hover': { color: '#ff4081' },
                                        }}
                                    >
                                        <Delete fontSize="small" />
                                    </IconButton>
                                </Box>
                            )}
                        </Box>
                    </Box>
                </Box>
            </motion.div>
            <Dialog
                open={isEditModalOpen}
                onClose={handleEditClose}
                maxWidth={isMobile ? 'xs' : 'sm'}
                fullWidth
                sx={{
                    '& .MuiDialog-paper': {
                        background: COLORS.chatBackground,
                        border: `1px solid ${COLORS.border}`,
                        borderRadius: SIZES.borderRadius,
                        backdropFilter: 'blur(15px)',
                        boxShadow: '0 8px 32px rgba(0, 0, 0, 0.5)',
                        color: COLORS.textPrimary,
                    },
                }}
            >
                <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', p: SIZES.padding }}>
                    <Typography variant="h6" sx={{ color: COLORS.textPrimary }}>
                        Редагувати повідомлення
                    </Typography>
                    <IconButton
                        onClick={handleEditClose}
                        sx={{ color: COLORS.textSecondary, '&:hover': { color: COLORS.accent } }}
                    >
                        <Close />
                    </IconButton>
                </Box>
                <DialogContent sx={{ p: SIZES.padding, pt: 0 }}>
                    <ReactQuill
                        value={editContent}
                        onChange={setEditContent}
                        modules={quillModules}
                        formats={quillFormats}
                        placeholder="Редагуйте ваше повідомлення..."
                        theme="snow"
                    />
                    <Box sx={{ display: 'flex', gap: 2, mt: 2, justifyContent: 'flex-end' }}>
                        <Button
                            variant="contained"
                            onClick={handleEditSave}
                            disabled={editMessageMutation.isLoading || !editContent.trim() || editContent === '<p><br></p>'}
                            sx={{
                                bgcolor: COLORS.accent,
                                '&:hover': { bgcolor: '#7b1fa2', boxShadow: '0 0 10px rgba(156, 39, 176, 0.5)' },
                                fontSize: SIZES.fontSizeMessage,
                            }}
                        >
                            Зберегти
                        </Button>
                        <Button
                            variant="outlined"
                            onClick={handleEditClose}
                            sx={{
                                color: COLORS.textPrimary,
                                borderColor: COLORS.border,
                                '&:hover': {
                                    borderColor: COLORS.accent,
                                    backgroundColor: 'rgba(156, 39, 176, 0.1)',
                                },
                                fontSize: SIZES.fontSizeMessage,
                            }}
                        >
                            Скасувати
                        </Button>
                    </Box>
                </DialogContent>
            </Dialog>
        </>
    );
};

export default Message;
