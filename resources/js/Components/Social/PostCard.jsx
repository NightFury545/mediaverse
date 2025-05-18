import React, { useEffect, useRef, useState, useCallback } from 'react';
import {
    Avatar,
    Box,
    Button,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    CircularProgress,
    IconButton,
    Menu,
    MenuItem,
    Typography,
    Chip
} from '@mui/material';
import {
    Bookmark,
    BrokenImage,
    ChatBubbleOutline,
    Favorite,
    Flag,
    MoreVert,
    Share,
    Visibility
} from '@mui/icons-material';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';
import { formatNumber } from '@/utils/formatNumber.js';
import UserAvatar from "@/Components/Social/UserAvatar.jsx";
import { likeActions } from "@/api/actions/index.js";
import { useMutation, useQueryClient } from "react-query";
import { formatDate } from "@/utils/formatDate.js";
import {normalizeAttachments} from "@/utils/normalizeAttachments.js";
import {STORAGE_URL} from "@/config/env.js";
import {useNavigate} from "react-router-dom";
import DOMPurify from 'dompurify';

const PLACEHOLDER_IMAGE = 'https://via.placeholder.com/600x600.png?text=Media+Not+Found';

const PostCard = ({
                      post = {
                          id: '',
                          title: '',
                          content: '',
                          user: { id: 0, username: '', avatar: '' },
                          attachments: [],
                          likes_count: 0,
                          comments_count: 0,
                          views_count: 0,
                          created_at: new Date().toISOString(),
                          slug: '',
                          tags: [],
                          visibility: 'public',
                          comments_enabled: true,
                          user_liked: false,
                          like_id: null
                      },
                      isClickable = true,
                      previewMode = false
                  }) => {
    const media = previewMode ? post.attachments : normalizeAttachments(post.attachments);

    const [anchorEl, setAnchorEl] = useState(null);
    const [isLiked, setIsLiked] = useState(post.user_liked);
    const [currentLikes, setCurrentLikes] = useState(post.likes_count || 0);
    const [currentSlide, setCurrentSlide] = useState(0);
    const [mediaLoaded, setMediaLoaded] = useState(media.map(() => false));
    const [mediaErrors, setMediaErrors] = useState(media.map(() => false));
    const [maxHeight, setMaxHeight] = useState(window.innerWidth <= 400 ? 250 : window.innerWidth <= 600 ? 300 : 400);
    const queryClient = useQueryClient();
    const carouselRef = useRef(null);
    const navigate = useNavigate();

    const handleMenuOpen = (event) => {
        if (previewMode) return;
        event.stopPropagation();
        setAnchorEl(event.currentTarget);
    };

    const handleMenuClose = (event) => {
        if (previewMode) return;
        event.stopPropagation();
        setAnchorEl(null);
    };

    const handleMenuItemClick = (event) => {
        if (previewMode) return;
        event.stopPropagation();
        handleMenuClose(event);
    };

    const handleNameClick = (event) => {
        if (previewMode) return;
        event.stopPropagation();
    };

    useEffect(() => {
        setIsLiked(post.user_liked);
    }, [post.user_liked]);

    const createLikeMutation = useMutation(
        () => likeActions.createLike('posts', post.id),
        {
            onMutate: async () => {
                setIsLiked(true);
                setCurrentLikes(prev => prev + 1);
            },
            onSuccess: () => {
                queryClient.invalidateQueries(['userLikes']);
                queryClient.invalidateQueries(['posts']);
            },
            onError: () => {
                setIsLiked(false);
                setCurrentLikes(prev => prev - 1);
            }
        }
    );

    const deleteLikeMutation = useMutation(
        () => likeActions.deleteLike(post.like_id),
        {
            onMutate: async () => {
                setIsLiked(false);
                setCurrentLikes(prev => prev - 1);
            },
            onSuccess: () => {
                queryClient.invalidateQueries(['userLikes']);
                queryClient.invalidateQueries(['posts']);
            },
            onError: () => {
                setIsLiked(true);
                setCurrentLikes(prev => prev + 1);
            }
        }
    );

    const handleLike = async () => {
        if (previewMode) return;
        if (isLiked && post.like_id) {
            deleteLikeMutation.mutate();
        } else {
            createLikeMutation.mutate();
        }
    };

    const handleSlideChange = (index) => {
        setCurrentSlide(index);
    };

    const handleMediaLoad = (index) => {
        setMediaLoaded((prev) => {
            const newLoaded = [...prev];
            newLoaded[index] = true;
            return newLoaded;
        });
    };

    const handleMediaError = (index) => {
        setMediaErrors((prev) => {
            const newErrors = [...prev];
            newErrors[index] = true;
            return newErrors;
        });
    };

    const debounce = (func, wait) => {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    };

    const calculateMaxHeight = useCallback(() => {
        if (!carouselRef.current || media.length === 0) return;

        const containerWidth = carouselRef.current.offsetWidth;
        const isVerySmallScreen = window.innerWidth <= 400;
        const isSmallScreen = window.innerWidth <= 600;

        let calculatedMaxHeight = isVerySmallScreen ? 250 : isSmallScreen ? 300 : 400;

        const loadPromises = media.map((item, index) => {
            return new Promise((resolve) => {
                if (item.type === 'image') {
                    const img = new Image();
                    img.src = previewMode ? item.url : STORAGE_URL + item.url;
                    img.onload = () => {
                        const aspectRatio = img.height / img.width;
                        const height = containerWidth * aspectRatio * (isSmallScreen ? 1.2 : 1);
                        resolve(height);
                    };
                    img.onerror = () => {
                        const height = containerWidth * (isSmallScreen ? 0.75 : 0.5625);
                        resolve(height);
                    };
                } else {
                    const height = containerWidth * (isSmallScreen ? 0.75 : 0.5625);
                    resolve(height);
                }
            });
        });

        Promise.all(loadPromises).then((heights) => {
            const maxCalculatedHeight = Math.max(...heights);
            if (maxCalculatedHeight > calculatedMaxHeight) {
                calculatedMaxHeight = Math.min(maxCalculatedHeight, isSmallScreen ? 550 : 700);
                setMaxHeight(calculatedMaxHeight);
            }
        });
    }, [media]);

    useEffect(() => {
        const debouncedCalculateMaxHeight = debounce(calculateMaxHeight, 300);
        debouncedCalculateMaxHeight();
        window.addEventListener('resize', debouncedCalculateMaxHeight);
        return () => window.removeEventListener('resize', debouncedCalculateMaxHeight);
    }, [calculateMaxHeight]);

    useEffect(() => {
        return () => {
            setMediaLoaded([]);
            setMediaErrors([]);
        };
    }, []);

    const handleCardClick = (event) => {
        const target = event.target;
        const isInteractiveElement = target.closest(
            'button, a, input, textarea, [role="button"], .MuiAvatar-root, .UserName, .MuiButton-root, .MuiIconButton-root, .MuiChip-root, .carousel'
        );

        if (!isInteractiveElement) {
            navigate(`/posts/${post.slug}`);
        }
    };

    const handleCommentClick = () => {
        if (previewMode) return;
        navigate(`/posts/${post.id}`);
    };

    const sanitizedContent = DOMPurify.sanitize(post.content, {
        ALLOWED_TAGS: ['p', 'br', 'strong', 'em', 'u', 'a', 'ul', 'ol', 'li', 'blockquote'],
        ALLOWED_ATTR: ['href', 'target', 'rel']
    });

    return (
        <Box sx={{
            padding: { xs: '0 4px', sm: '0 8px' },
            cursor: isClickable ? 'pointer' : 'default',
            boxSizing: 'border-box',
            width: '100%',
            maxWidth: '100%',
            overflow: 'hidden',
            ...(isClickable && {
                '&:hover .post-card': {
                    backgroundColor: 'rgba(35, 35, 37, 0.6)'
                }
            })
        }}>
            <Card
                className="post-card"
                onClick={isClickable ? handleCardClick : undefined}
                sx={{
                    width: '100%',
                    maxWidth: '100%',
                    background: 'transparent',
                    color: '#ffffff',
                    borderRadius: '8px',
                    marginBottom: 2,
                    overflow: 'hidden',
                    backdropFilter: 'blur(12px)',
                    transition: 'all 0.2s ease',
                    boxShadow: 'none',
                    border: 'none',
                    boxSizing: 'border-box'
                }}
            >
                <CardHeader
                    avatar={
                        <UserAvatar
                            userId={post.user.id}
                            src={post.user.avatar}
                        >
                            {post.user.username.charAt(0)}
                        </UserAvatar>
                    }
                    action={
                        <IconButton
                            aria-label="settings"
                            onClick={handleMenuOpen}
                            sx={{
                                color: '#b0b0b0',
                                '&:hover': {
                                    color: '#ffffff',
                                    backgroundColor: 'rgba(156, 39, 176, 0.2)'
                                }
                            }}
                        >
                            <MoreVert />
                        </IconButton>
                    }
                    title={
                        <Box sx={{ display: 'flex', alignItems: 'center', gap: 1 }}>
                            <Typography  onClick={handleNameClick} variant="subtitle2" sx={{
                                fontWeight: 600,
                                color: '#ffffff',
                                cursor: 'pointer',
                                fontSize: { xs: '14px', sm: '16px' },
                                '&:hover': {
                                    textDecoration: 'underline'
                                }
                            }}>
                                {post.user.username}
                            </Typography>
                        </Box>
                    }
                    subheader={
                        <Typography variant="caption" sx={{
                            color: '#b0b0b0',
                            fontSize: { xs: '12px', sm: '14px' },
                            '&:hover': {
                                color: '#ffffff'
                            }
                        }}>
                            {formatDate(post.created_at)} · {post.slug || 'community'}
                        </Typography>
                    }
                    sx={{
                        padding: { xs: '10px 12px', sm: '14px 16px' },
                        background: 'transparent',
                        '& .MuiCardHeader-content': {
                            overflow: 'hidden'
                        },
                        width: '100%',
                        boxSizing: 'border-box'
                    }}
                />

                <Menu
                    anchorEl={anchorEl}
                    open={Boolean(anchorEl)}
                    onClose={handleMenuClose}
                    PaperProps={{
                        sx: {
                            background: 'rgba(26, 26, 27, 0.9)',
                            color: '#ffffff',
                            border: 'none',
                            boxShadow: '0 0 30px rgba(0, 0, 0, 0.5)',
                            backdropFilter: 'blur(12px)',
                            borderRadius: '8px',
                            overflow: 'hidden',
                            '& .MuiMenuItem-root': {
                                padding: { xs: '8px 12px', sm: '10px 16px' },
                                fontSize: { xs: '13px', sm: '14px' },
                                '&:hover': {
                                    background: 'rgba(156, 39, 176, 0.2)'
                                },
                                '& svg': {
                                    marginRight: '10px',
                                    color: '#b0b0b0'
                                }
                            }
                        }
                    }}
                >
                    <MenuItem onClick={handleMenuClose}>
                        <Bookmark fontSize="small" /> Зберегти
                    </MenuItem>
                    <MenuItem onClick={handleMenuClose}>
                        <Flag fontSize="small" /> Поскаржитися
                    </MenuItem>
                </Menu>

                <CardContent sx={{
                    padding: { xs: '0 12px 8px 12px', sm: '0 16px 12px 16px' },
                    background: 'transparent',
                    width: '100%',
                    boxSizing: 'border-box'
                }}>
                    <Typography variant="h6" component="h3" sx={{
                        fontSize: { xs: '16px', sm: '18px' },
                        fontWeight: 600,
                        marginBottom: post.content ? '10px' : 0,
                        lineHeight: 1.4,
                        color: '#ffffff'
                    }}>
                        {post.title}
                    </Typography>
                    {post.content && (
                        <Box
                            sx={{
                                fontSize: { xs: '14px', sm: '15px' },
                                lineHeight: '1.5',
                                marginBottom: post.tags.length > 0 || media.length > 0 ? '12px' : 0,
                                color: '#e0e0e0',
                                '& p': { margin: '0 0 8px 0' },
                                '& strong': { fontWeight: 700 },
                                '& em': { fontStyle: 'italic' },
                                '& u': { textDecoration: 'underline' },
                                '& a': { color: '#ff4081', textDecoration: 'underline', '&:hover': { color: '#f50057' } },
                                '& ul, & ol': { margin: '0 0 8px 16px', paddingLeft: '16px' },
                                '& li': { marginBottom: '4px' },
                                '& blockquote': {
                                    borderLeft: '3px solid #ff4081',
                                    paddingLeft: '12px',
                                    margin: '0 0 8px 0',
                                    color: '#b0b0b0'
                                }
                            }}
                            dangerouslySetInnerHTML={{ __html: sanitizedContent }}
                        />
                    )}
                    {post.tags.length > 0 && (
                        <Box sx={{
                            display: 'flex',
                            flexWrap: 'wrap',
                            gap: '8px',
                            marginBottom: media.length > 0 ? '4px' : 0
                        }}>
                            {post.tags.map((tag, index) => (
                                <Chip
                                    key={index}
                                    label={'# ' + tag}
                                    sx={{
                                        backgroundColor: 'rgba(156, 39, 176, 0.2)',
                                        color: '#e0e0e0',
                                        fontSize: { xs: '12px', sm: '13px' },
                                        fontWeight: 500,
                                        height: { xs: '26px', sm: '28px' },
                                        borderRadius: '14px',
                                        transition: 'all 0.2s ease',
                                        '&:hover': {
                                            backgroundColor: 'rgba(156, 39, 176, 0.4)',
                                            color: '#ffffff',
                                            cursor: 'pointer'
                                        }
                                    }}
                                />
                            ))}
                        </Box>
                    )}
                </CardContent>

                {media.length > 0 && (
                    <Box
                        ref={carouselRef}
                        sx={{
                            position: 'relative',
                            width: { xs: 'calc(100% - 16px)', sm: 'calc(100% - 24px)' },
                            margin: { xs: '0 4px 8px 4px', sm: '0 12px 12px 12px' },
                            backgroundColor: '#000000',
                            borderRadius: '8px',
                            overflow: 'hidden',
                            maxHeight: `${maxHeight}px`,
                            minHeight: '150px',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            transition: 'max-height 0.3s ease',
                            boxSizing: 'border-box',
                            '@media (max-width: 400px)': {
                                maxHeight: `${maxHeight}px`,
                                minHeight: '150px',
                                width: 'calc(100% - 8px)'
                            },
                            '@media (min-width: 401px) and (max-width: 600px)': {
                                maxHeight: `${maxHeight}px`,
                                width: 'calc(100% - 8px)'
                            }
                        }}
                    >
                        <Box sx={{
                            position: 'absolute',
                            top: 0,
                            left: 0,
                            right: 0,
                            bottom: 0,
                            backgroundImage: mediaErrors[currentSlide]
                                ? `url(${PLACEHOLDER_IMAGE})`
                                : media[currentSlide].type === 'image'
                                    ? `url(${previewMode ? media[currentSlide].url : STORAGE_URL + media[currentSlide].url})`
                                    : `url(${previewMode ? (media[currentSlide].thumbnail || media[currentSlide].url) : (media[currentSlide].thumbnail || STORAGE_URL + media[currentSlide].url) || PLACEHOLDER_IMAGE})`,
                            backgroundSize: 'cover',
                            backgroundPosition: 'center',
                            filter: 'blur(20px) brightness(0.7)',
                            zIndex: 1,
                            borderRadius: '8px'
                        }} />

                        <Box sx={{
                            position: 'relative',
                            width: '100%',
                            height: '100%',
                            maxHeight: `${maxHeight}px`,
                            zIndex: 2,
                            boxSizing: 'border-box'
                        }}>
                            <Carousel
                                showArrows={media.length > 1}
                                showStatus={false}
                                showThumbs={false}
                                infiniteLoop
                                emulateTouch
                                selectedItem={currentSlide}
                                onChange={handleSlideChange}
                                swipeable
                                dynamicHeight={false}
                                sx={{
                                    width: '100%',
                                    height: '100%',
                                    '& .carousel': {
                                        height: '100%',
                                        width: '100%'
                                    },
                                    '& .slider-wrapper': {
                                        height: '100%',
                                        overflow: 'hidden',
                                        width: '100%'
                                    },
                                    '& .slider': {
                                        height: '100%',
                                        width: '100%'
                                    },
                                    '& .slide': {
                                        height: '100%',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        backgroundColor: 'transparent',
                                        width: '100%'
                                    }
                                }}
                                renderArrowPrev={(onClickHandler, hasPrev) =>
                                    hasPrev && (
                                        <IconButton
                                            onClick={onClickHandler}
                                            sx={{
                                                position: 'absolute',
                                                top: '50%',
                                                left: '8px',
                                                transform: 'translateY(-50%)',
                                                background: 'rgba(37,3,3,0.6)',
                                                height: { xs: '40px', sm: '48px' },
                                                width: { xs: '40px', sm: '48px' },
                                                borderRadius: '50%',
                                                zIndex: 3,
                                                '&:hover': {
                                                    background: 'rgb(35,10,10,0.7)'
                                                },
                                                '& .MuiSvgIcon-root': {
                                                    color: '#ffffff',
                                                    fontSize: { xs: '20px', sm: '24px' }
                                                }
                                            }}
                                        >
                                            <svg viewBox="0 0 24 24">
                                                <path fill="currentColor" color={'gray'} d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                                            </svg>
                                        </IconButton>
                                    )
                                }
                                renderArrowNext={(onClickHandler, hasNext) =>
                                    hasNext && (
                                        <IconButton
                                            onClick={onClickHandler}
                                            sx={{
                                                position: 'absolute',
                                                top: '50%',
                                                right: '8px',
                                                transform: 'translateY(-50%)',
                                                background: 'rgba(37,3,3,0.6)',
                                                height: { xs: '40px', sm: '48px' },
                                                width: { xs: '40px', sm: '48px' },
                                                borderRadius: '50%',
                                                zIndex: 3,
                                                '&:hover': {
                                                    background: 'rgb(35,10,10,0.7)'
                                                },
                                                '& .MuiSvgIcon-root': {
                                                    color: '#ffffff',
                                                    fontSize: { xs: '20px', sm: '24px' }
                                                }
                                            }}
                                        >
                                            <svg viewBox="0 0 24 24">
                                                <path fill="currentColor" color={'gray'} d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z" />
                                            </svg>
                                        </IconButton>
                                    )
                                }
                                renderIndicator={(onClickHandler, isSelected, index, label) => (
                                    <Box
                                        component="li"
                                        sx={{
                                            width: isSelected ? '24px' : '8px',
                                            height: '4px',
                                            display: 'inline-block',
                                            margin: '0 4px',
                                            borderRadius: '2px',
                                            backgroundColor: isSelected ? '#9c27b0' : '#4a4a4a',
                                            cursor: 'pointer',
                                            transition: 'width 0.3s ease, background-color 0.3s ease',
                                            '&:hover': {
                                                backgroundColor: '#9c27b0'
                                            }
                                        }}
                                        onClick={onClickHandler}
                                        onKeyDown={(e) => {
                                            if (e.key === 'Enter' || e.key === ' ') {
                                                onClickHandler(e);
                                            }
                                        }}
                                        value={index}
                                        key={index}
                                        role="button"
                                        tabIndex={0}
                                        aria-label={`${label} ${index + 1}`}
                                    />
                                )}
                            >
                                {media.map((item, index) => (
                                    <Box
                                        key={index}
                                        sx={{
                                            width: '100%',
                                            height: '100%',
                                            maxHeight: `${maxHeight}px`,
                                            display: 'flex',
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            position: 'relative',
                                            overflow: 'hidden',
                                            borderRadius: '8px',
                                            boxSizing: 'border-box'
                                        }}
                                    >
                                        {!mediaLoaded[index] && !mediaErrors[index] && (
                                            <CircularProgress
                                                sx={{
                                                    color: '#9c27b0',
                                                    position: 'absolute',
                                                    zIndex: 3
                                                }}
                                            />
                                        )}

                                        {mediaErrors[index] && (
                                            <Box sx={{
                                                width: '100%',
                                                height: '100%',
                                                display: 'flex',
                                                flexDirection: 'column',
                                                alignItems: 'center',
                                                justifyContent: 'center',
                                                backgroundColor: 'rgba(0, 0, 0, 0.5)',
                                                zIndex: 2
                                            }}>
                                                <BrokenImage sx={{ color: '#b0b0b0', fontSize: { xs: '40px', sm: '48px' } }} />
                                                <Typography variant="body2" sx={{ color: '#e0e0e0', fontSize: { xs: '13px', sm: '14px' } }}>
                                                    Не вдалося завантажити медіа
                                                </Typography>
                                            </Box>
                                        )}

                                        {item.type === 'image' ? (
                                            <img
                                                src={mediaErrors[index] ? PLACEHOLDER_IMAGE : (previewMode ? item.url : STORAGE_URL + item.url)}
                                                alt={`Post media ${index + 1}`}
                                                style={{
                                                    width: '100%',
                                                    height: '100%',
                                                    maxHeight: `${maxHeight}px`,
                                                    objectFit: 'contain',
                                                    objectPosition: 'center',
                                                    borderRadius: '8px',
                                                    display: mediaErrors[index] || !mediaLoaded[index] ? 'none' : 'block',
                                                    boxSizing: 'border-box'
                                                }}
                                                onLoad={() => handleMediaLoad(index)}
                                                onError={() => handleMediaError(index)}
                                            />
                                        ) : (
                                            <video
                                                src={mediaErrors[index] ? PLACEHOLDER_IMAGE : (previewMode ? item.url : STORAGE_URL + item.url)}
                                                controls
                                                muted
                                                autoPlay={false}
                                                style={{
                                                    width: '100%',
                                                    height: '100%',
                                                    maxHeight: `${maxHeight}px`,
                                                    objectFit: window.innerWidth <= 600 ? 'cover' : 'contain',
                                                    objectPosition: 'center',
                                                    borderRadius: '8px',
                                                    display: mediaErrors[index] || !mediaLoaded[index] ? 'none' : 'block',
                                                    boxSizing: 'border-box'
                                                }}
                                                onLoadedData={() => handleMediaLoad(index)}
                                                onError={() => handleMediaError(index)}
                                            />
                                        )}
                                    </Box>
                                ))}
                            </Carousel>
                        </Box>
                    </Box>
                )}

                <CardActions sx={{
                    padding: { xs: '8px 12px', sm: '10px 16px' },
                    display: 'flex',
                    justifyContent: 'space-between',
                    background: 'transparent',
                    borderTop: 'none',
                    alignItems: 'center',
                    flexWrap: 'wrap',
                    gap: '8px',
                    width: '100%',
                    boxSizing: 'border-box'
                }}>
                    <Box sx={{
                        display: 'flex',
                        alignItems: 'center',
                        gap: '8px',
                        height: '40px',
                        flexWrap: 'wrap'
                    }}>
                        <Button
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <Visibility sx={{
                                        color: '#b0b0b0',
                                        fontSize: { xs: '20px', sm: '22px' }
                                    }} />
                                </Box>
                            }
                            sx={{
                                minWidth: 'auto',
                                padding: { xs: '8px 14px', sm: '8px 16px' },
                                color: '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: '0',
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: { xs: '14px', sm: '15px' },
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(post.views_count)}
                            </Typography>
                        </Button>

                        <Button
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <Favorite sx={{
                                        color: isLiked ? '#ff4081' : '#b0b0b0',
                                        fontSize: { xs: '20px', sm: '22px' },
                                        transition: 'all 0.2s ease'
                                    }} />
                                </Box>
                            }
                            onClick={handleLike}
                            sx={{
                                minWidth: 'auto',
                                padding: { xs: '8px 14px', sm: '8px 16px' },
                                color: isLiked ? '#ff4081' : '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: '0',
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: { xs: '14px', sm: '15px' },
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(currentLikes)}
                            </Typography>
                        </Button>

                        <Button
                            onClick={handleCommentClick}
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <ChatBubbleOutline sx={{
                                        color: '#b0b0b0',
                                        fontSize: { xs: '20px', sm: '22px' }
                                    }} />
                                </Box>
                            }
                            sx={{
                                minWidth: 'auto',
                                padding: { xs: '8px 14px', sm: '8px 16px' },
                                color: '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: '0',
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: { xs: '14px', sm: '15px' },
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(post.comments_count)}
                            </Typography>
                        </Button>
                    </Box>

                    <Button
                        startIcon={
                            <Box sx={{
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                <Share sx={{
                                    color: '#b0b0b0',
                                    fontSize: { xs: '20px', sm: '22px' }
                                }} />
                            </Box>
                        }
                        sx={{
                            minWidth: 'auto',
                            padding: { xs: '8px 14px', sm: '8px 16px' },
                            color: '#e0e0e0',
                            backgroundColor: 'rgba(255, 255, 255, 0.05)',
                            borderRadius: '999px',
                            '&:hover': {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)'
                            },
                            '& .MuiButton-startIcon': {
                                marginRight: '8px',
                                marginLeft: '0',
                                height: '24px'
                            },
                            height: '40px'
                        }}
                    >
                        <Typography variant="subtitle2" sx={{
                            fontWeight: 500,
                            fontSize: { xs: '14px', sm: '15px' },
                            textTransform: 'none',
                            display: 'flex',
                            alignItems: 'center',
                            height: '24px'
                        }}>
                            Поділитися
                        </Typography>
                    </Button>
                </CardActions>
            </Card>
        </Box>
    );
};

export default PostCard;
