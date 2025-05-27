import React from 'react';
import { Box, Typography, Avatar, Button, IconButton, Tooltip, Chip, CircularProgress } from '@mui/material';
import { Settings, Chat, GroupAdd, GroupRemove, Cancel, CheckCircle, Email, VerifiedUser, Shield, Person } from '@mui/icons-material';

const ProfileHeader = ({ profileUser, isOwner, isAuthenticated, friendStatus, handleMessage, handleFriendAction, handleRejectFriendRequest, handleEditOpen, isMobile, isOnline, formatLastSeen, isCreatingChat }) => (
    <Box
        sx={{
            display: 'flex',
            flexDirection: { xs: 'column', md: 'row' },
            gap: { xs: 2, md: 4 },
            alignItems: { xs: 'center', md: 'flex-start' },
            mb: 4,
            position: 'relative',
        }}
    >
        <Box sx={{ position: 'relative' }}>
            <Avatar
                src={profileUser.avatar}
                alt={profileUser.username}
                sx={{
                    width: { xs: 80, sm: 100, md: 150 },
                    height: { xs: 80, sm: 100, md: 150 },
                    border: '2px solid rgba(156, 39, 176, 0.5)',
                    boxShadow: '0 0 15px rgba(156, 39, 176, 0.4)',
                    transition: 'transform 0.3s',
                    '&:hover': { transform: 'scale(1.05)' },
                }}
            />
        </Box>
        <Box sx={{ flexGrow: 1, textAlign: { xs: 'center', md: 'left' } }}>
            <Box sx={{ display: 'flex', alignItems: 'center', gap: 1, mb: 1, justifyContent: { xs: 'center', md: 'flex-start' } }}>
                {profileUser.first_name || profileUser.last_name ? (
                    <>
                        <Typography variant={isMobile ? 'h5' : 'h4'} sx={{ fontWeight: 700, color: '#e0e0e0' }}>
                            {profileUser.first_name} {profileUser.last_name}
                        </Typography>
                        <Chip
                            label={profileUser.username}
                            size="small"
                            sx={{ bgcolor: '#b0b0b0', color: '#fff', fontSize: '0.75rem' }}
                        />
                    </>
                ) : (
                    <Typography variant={isMobile ? 'h5' : 'h4'} sx={{ fontWeight: 700, color: '#e0e0e0' }}>
                        {profileUser.username}
                    </Typography>
                )}
                {isOwner && (
                    <Tooltip title="Редагувати профіль">
                        <IconButton onClick={handleEditOpen} sx={{ color: '#9c27b0' }}>
                            <Settings fontSize="small" />
                        </IconButton>
                    </Tooltip>
                )}
            </Box>
            <Box sx={{ display: 'flex', gap: 1, mb: 2, justifyContent: { xs: 'center', md: 'flex-start' }, flexWrap: 'wrap' }}>
                {isOnline ? (
                    <Chip
                        icon={<CheckCircle sx={{ fontSize: '16px !important' }} />}
                        label="Онлайн"
                        size="small"
                        sx={{
                            bgcolor: 'rgba(76, 175, 80, 0.2)',
                            color: '#4caf50',
                            fontSize: '0.7rem',
                            height: 20,
                        }}
                    />
                ) : (
                    <Tooltip title={formatLastSeen()}>
                        <Chip
                            icon={<Cancel sx={{ fontSize: '16px !important' }} />}
                            label="Офлайн"
                            size="small"
                            sx={{
                                bgcolor: 'rgba(244, 67, 54, 0.1)',
                                color: '#f44336',
                                fontSize: '0.7rem',
                                height: 20,
                            }}
                        />
                    </Tooltip>
                )}
                {profileUser.role && (
                    <Chip
                        avatar={
                            profileUser.role === 'admin' ? (
                                <VerifiedUser sx={{ color: '#fff', fontSize: '0.8rem' }} />
                            ) : profileUser.role === 'moderator' ? (
                                <Shield sx={{ color: '#fff', fontSize: '0.8rem' }} />
                            ) : (
                                <Person sx={{ color: '#fff', fontSize: '0.8rem' }} />
                            )
                        }
                        label={profileUser.role === 'admin' ? 'Адмін' : profileUser.role === 'moderator' ? 'Модератор' : 'Користувач'}
                        size="small"
                        sx={{
                            bgcolor: profileUser.role === 'admin' ? '#d32f2f' : profileUser.role === 'moderator' ? '#1976d2' : '#4caf50',
                            color: '#fff',
                            fontSize: '0.7rem',
                            height: 20,
                            fontWeight: 600,
                        }}
                    />
                )}
            </Box>
            <Box sx={{ display: 'flex', gap: 1, mb: 2, justifyContent: { xs: 'center', md: 'flex-start' } }}>
                <Email sx={{ color: '#9c27b0', fontSize: '1.2rem' }} />
                <Typography variant="body2" sx={{ color: '#b0b0b0' }}>
                    {profileUser.email}
                </Typography>
            </Box>
            <Box sx={{ display: 'flex', gap: { xs: 1, sm: 2 }, flexWrap: 'wrap', justifyContent: { xs: 'center', md: 'flex-start' } }}>
                <Button
                    variant="contained"
                    startIcon={isCreatingChat ? <CircularProgress size={20} sx={{ color: '#ffffff' }} /> : <Chat />}
                    onClick={handleMessage}
                    disabled={isCreatingChat}
                    sx={{
                        bgcolor: '#9c27b0',
                        '&:hover': { bgcolor: '#7b1fa2', boxShadow: '0 0 10px rgba(156, 39, 176, 0.5)' },
                        '&:disabled': { bgcolor: '#4a1a5e', color: '#a0a0a0' },
                        fontSize: { xs: '0.75rem', sm: '0.875rem' },
                        transition: 'all 0.3s',
                        minWidth: { xs: '100px', sm: '120px' },
                    }}
                >
                    Написати
                </Button>
                {!isOwner && (
                    <>
                        <Button
                            variant="outlined"
                            startIcon={friendStatus === 'accepted' ? <GroupRemove /> : <GroupAdd />}
                            onClick={handleFriendAction}
                            disabled={friendStatus.status === 'pending_sent' || friendStatus.status === 'pending_received'}
                            sx={{
                                color: '#e0e0e0',
                                borderColor: 'rgba(156, 39, 176, 0.3)',
                                '&:hover': { borderColor: '#9c27b0', bgcolor: 'rgba(156, 39, 176, 0.1)', boxShadow: '0 0 10px rgba(156, 39, 176, 0.5)' },
                                fontSize: { xs: '0.75rem', sm: '0.875rem' },
                                transition: 'all 0.3s',
                            }}
                        >
                            {friendStatus === 'accepted'
                                ? 'Видалити з друзів'
                                : friendStatus.status === 'pending_sent'
                                    ? 'Скасувати запит'
                                    : friendStatus.status === 'pending_received'
                                        ? 'Прийняти запит'
                                        : 'Додати в друзі'}
                        </Button>
                        {friendStatus.status === 'pending_received' && (
                            <Button
                                variant="outlined"
                                startIcon={<Cancel />}
                                onClick={handleRejectFriendRequest}
                                sx={{
                                    color: '#ff4081',
                                    borderColor: 'rgba(255, 64, 129, 0.3)',
                                    '&:hover': { borderColor: '#ff4081', bgcolor: 'rgba(255, 64, 129, 0.1)', boxShadow: '0 0 10px rgba(255, 64, 129, 0.5)' },
                                    fontSize: { xs: '0.75rem', sm: '0.875rem' },
                                    transition: 'all 0.3s',
                                }}
                            >
                                Відхилити
                            </Button>
                        )}
                    </>
                )}
            </Box>
        </Box>
    </Box>
);

export default ProfileHeader;
