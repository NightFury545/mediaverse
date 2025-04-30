import React, { useState, useEffect, useRef } from 'react';
import {
    Avatar,
    Box,
    Button,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    IconButton,
    Menu,
    MenuItem,
    Typography,
    CircularProgress
} from '@mui/material';
import {
    Bookmark,
    ChatBubbleOutline,
    Favorite,
    MoreVert,
    Visibility,
    Share,
    Flag,
    BrokenImage
} from '@mui/icons-material';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';
import { formatNumber } from '@/utils/formatNumber.js';

const PLACEHOLDER_IMAGE = 'https://via.placeholder.com/600x600.png?text=Media+Not+Found';

const PostCard = ({
                      userName = "user123",
                      userAvatar = "https://i.redd.it/snoovatar/avatars/01940b1a-87fe-4b3d-b2b6-7eb4a0a6a3a3.png",
                      postTime = "5 годин тому",
                      title = "Це приклад поста з ультра-темним дизайном",
                      content = "Тут може бути текст поста. Цей компонент має сучасний дизайн з неоновими ефектами.",
                      media = [
                          { type: 'image', url: 'https://i.redd.it/2zqs6i9jojvb1.jpg' },
                          { type: 'video', url: 'https://v.redd.it/9zqs6i9jojvb1/DASH_720.mp4', thumbnail: 'https://i.redd.it/2zqs6i9jojvb1.jpg' }
                      ],
                      likes = 245,
                      comments = 32,
                      views = 1500,
                      subreddit = "Ukraine"
                  }) => {
    // State for menu, likes, and carousel
    const [anchorEl, setAnchorEl] = useState(null);
    const [isLiked, setIsLiked] = useState(false);
    const [currentLikes, setCurrentLikes] = useState(likes);
    const [currentSlide, setCurrentSlide] = useState(0);
    const [mediaLoaded, setMediaLoaded] = useState(media.map(() => false));
    const [mediaErrors, setMediaErrors] = useState(media.map(() => false));
    const [maxHeight, setMaxHeight] = useState(600);
    const carouselRef = useRef(null);

    // Handle menu open/close
    const handleMenuOpen = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleMenuClose = () => {
        setAnchorEl(null);
    };

    // Handle like toggle
    const handleLike = () => {
        setIsLiked(!isLiked);
        setCurrentLikes(isLiked ? currentLikes - 1 : currentLikes + 1);
    };

    // Handle carousel slide change
    const handleSlideChange = (index) => {
        setCurrentSlide(index);
    };

    // Handle media load success
    const handleMediaLoad = (index) => {
        setMediaLoaded((prev) => {
            const newLoaded = [...prev];
            newLoaded[index] = true;
            return newLoaded;
        });
    };

    // Handle media load error
    const handleMediaError = (index) => {
        setMediaErrors((prev) => {
            const newErrors = [...prev];
            newErrors[index] = true;
            return newErrors;
        });
    };

    // Calculate max height based on media aspect ratios
    useEffect(() => {
        if (media.length === 0) return;

        const calculateMaxHeight = () => {
            if (!carouselRef.current) return;

            const containerWidth = carouselRef.current.offsetWidth;
            let calculatedMaxHeight = 0;

            media.forEach(item => {
                if (item.type === 'image') {
                    // For images, we'll use natural aspect ratio
                    const img = new Image();
                    img.src = item.url;
                    img.onload = () => {
                        const aspectRatio = img.height / img.width;
                        const height = containerWidth * aspectRatio;
                        if (height > calculatedMaxHeight) {
                            calculatedMaxHeight = Math.min(height, 1000); // Limit max height
                            setMaxHeight(calculatedMaxHeight);
                        }
                    };
                    img.onerror = () => {
                        // Use default aspect ratio if image fails to load
                        const height = containerWidth * 0.75;
                        if (height > calculatedMaxHeight) {
                            calculatedMaxHeight = Math.min(height, 1000);
                            setMaxHeight(calculatedMaxHeight);
                        }
                    };
                } else {
                    // For videos, we'll use 16:9 aspect ratio by default
                    const height = containerWidth * (9 / 16);
                    if (height > calculatedMaxHeight) {
                        calculatedMaxHeight = Math.min(height, 1000);
                        setMaxHeight(calculatedMaxHeight);
                    }
                }
            });
        };

        calculateMaxHeight();
        window.addEventListener('resize', calculateMaxHeight);
        return () => window.removeEventListener('resize', calculateMaxHeight);
    }, [media]);

    // Clean up on unmount
    useEffect(() => {
        return () => {
            setMediaLoaded([]);
            setMediaErrors([]);
        };
    }, []);

    return (
        <Box sx={{
            padding: '0 12px',
            cursor: 'pointer',
            '&:hover .post-card': {
                backgroundColor: 'rgba(35, 35, 37, 0.6)'
            }
        }}>
            <Card
                className="post-card"
                sx={{
                    maxWidth: '100%',
                    background: 'transparent',
                    color: '#ffffff',
                    borderRadius: '8px',
                    marginBottom: 3,
                    overflow: 'hidden',
                    backdropFilter: 'blur(12px)',
                    transition: 'all 0.2s ease',
                    boxShadow: 'none',
                    border: 'none'
                }}
            >
                {/* User Info Header */}
                <CardHeader
                    avatar={
                        <Avatar
                            src={userAvatar}
                            sx={{
                                bgcolor: '#9c27b0',
                                width: 36,
                                height: 36,
                                transition: 'all 0.2s ease',
                                border: 'none',
                                '&:hover': {
                                    boxShadow: '0 0 15px rgba(156, 39, 176, 0.8)'
                                }
                            }}
                        >
                            {userName.charAt(0)}
                        </Avatar>
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
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 600,
                                color: '#ffffff',
                                '&:hover': {
                                    textDecoration: 'underline'
                                }
                            }}>
                                u/{userName}
                            </Typography>
                        </Box>
                    }
                    subheader={
                        <Typography variant="caption" sx={{
                            color: '#b0b0b0',
                            '&:hover': {
                                color: '#ffffff'
                            }
                        }}>
                            {postTime} · r/{subreddit}
                        </Typography>
                    }
                    sx={{
                        padding: '14px 16px',
                        background: 'transparent',
                        '& .MuiCardHeader-content': {
                            overflow: 'hidden'
                        }
                    }}
                />

                {/* Options Menu */}
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
                                padding: '10px 16px',
                                '&:hover': {
                                    background: 'rgba(156, 39, 176, 0.2)'
                                },
                                '& svg': {
                                    marginRight: '12px',
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

                {/* Post Content */}
                <CardContent sx={{
                    padding: '0 16px 12px 16px',
                    background: 'transparent'
                }}>
                    <Typography variant="h6" component="h3" sx={{
                        fontSize: '18px',
                        fontWeight: 600,
                        marginBottom: content ? '10px' : 0,
                        lineHeight: 1.4,
                        color: '#ffffff'
                    }}>
                        {title}
                    </Typography>
                    {content && (
                        <Typography variant="body2" sx={{
                            fontSize: '14px',
                            lineHeight: 1.5,
                            marginBottom: media.length > 0 ? '12px' : 0,
                            color: '#e0e0e0'
                        }}>
                            {content}
                        </Typography>
                    )}
                </CardContent>

                {/* Media Section */}
                {media.length > 0 && (
                    <Box
                        ref={carouselRef}
                        sx={{
                            position: 'relative',
                            maxWidth: '100%',
                            margin: '0 16px 8px 16px',
                            backgroundColor: '#000000',
                            borderRadius: '8px',
                            overflow: 'hidden',
                            height: `${maxHeight}px`,
                            minHeight: '300px',
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'center',
                            justifyContent: 'center'
                        }}
                    >
                        {/* Blurred Background */}
                        <Box sx={{
                            position: 'absolute',
                            top: 0,
                            left: 0,
                            right: 0,
                            bottom: 0,
                            backgroundImage: mediaErrors[currentSlide]
                                ? `url(${PLACEHOLDER_IMAGE})`
                                : media[currentSlide].type === 'image'
                                    ? `url(${media[currentSlide].url})`
                                    : `url(${media[currentSlide].thumbnail || media[currentSlide].url || PLACEHOLDER_IMAGE})`,
                            backgroundSize: 'cover',
                            backgroundPosition: 'center',
                            filter: 'blur(20px) brightness(0.7)',
                            zIndex: 1,
                            borderRadius: '8px'
                        }} />

                        {/* Media Content */}
                        <Box sx={{
                            position: 'relative',
                            width: '100%',
                            height: '100%',
                            zIndex: 2,
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center'
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
                                ref={carouselRef}
                                sx={{
                                    width: '100%',
                                    height: '100%',
                                    '& .carousel': {
                                        height: '100%'
                                    },
                                    '& .slider-wrapper': {
                                        height: '100%'
                                    },
                                    '& .slider': {
                                        height: '100%'
                                    },
                                    '& .slide': {
                                        height: '100%',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        backgroundColor: 'transparent'
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
                                                height: '48px',
                                                width: '48px',
                                                borderRadius: '50%',
                                                zIndex: 3,
                                                '&:hover': {
                                                    background: 'rgb(35,10,10,0.7)',
                                                },
                                                '& .MuiSvgIcon-root': {
                                                    color: '#ffffff',
                                                    fontSize: '24px'
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
                                                height: '48px',
                                                width: '48px',
                                                borderRadius: '50%',
                                                zIndex: 3,
                                                '&:hover': {
                                                    background: 'rgb(35,10,10,0.7)',
                                                },
                                                '& .MuiSvgIcon-root': {
                                                    color: '#ffffff',
                                                    fontSize: '24px'
                                                },
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
                                            margin: '0 2px',
                                            borderRadius: '2px',
                                            backgroundColor: isSelected ? '#9c27b0' : '#4a4a4a',
                                            cursor: 'pointer',
                                            transition: 'all 0.2s ease',
                                            '&:hover': {
                                                backgroundColor: '#9c27b0'
                                            }
                                        }}
                                        onClick={onClickHandler}
                                        onKeyDown={onClickHandler}
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
                                            display: 'flex',
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            position: 'relative',
                                            overflow: 'hidden',
                                            borderRadius: '8px'
                                        }}
                                    >
                                        {/* Loading Spinner */}
                                        {!mediaLoaded[index] && !mediaErrors[index] && (
                                            <CircularProgress
                                                sx={{
                                                    color: '#9c27b0',
                                                    position: 'absolute',
                                                    zIndex: 3
                                                }}
                                            />
                                        )}

                                        {/* Error State */}
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
                                                <BrokenImage sx={{ color: '#b0b0b0', fontSize: '48px' }} />
                                                <Typography variant="body2" sx={{ color: '#e0e0e0' }}>
                                                    Не вдалося завантажити медіа
                                                </Typography>
                                            </Box>
                                        )}

                                        {/* Media Content */}
                                        {item.type === 'image' ? (
                                            <img
                                                src={mediaErrors[index] ? PLACEHOLDER_IMAGE : item.url}
                                                alt={`Post media ${index + 1}`}
                                                style={{
                                                    maxWidth: '100%',
                                                    maxHeight: '100%',
                                                    objectFit: 'contain',
                                                    objectPosition: 'center',
                                                    borderRadius: '8px',
                                                    display: mediaErrors[index] || !mediaLoaded[index] ? 'none' : 'block'
                                                }}
                                                onLoad={() => handleMediaLoad(index)}
                                                onError={() => handleMediaError(index)}
                                            />
                                        ) : (
                                            <video
                                                src={mediaErrors[index] ? PLACEHOLDER_IMAGE : item.url}
                                                controls
                                                muted
                                                autoPlay={false}
                                                style={{
                                                    width: '100%',
                                                    height: '100%',
                                                    objectFit: 'cover',
                                                    objectPosition: 'center',
                                                    borderRadius: '8px',
                                                    display: mediaErrors[index] || !mediaLoaded[index] ? 'none' : 'block'
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

                {/* Post Actions Footer */}
                <CardActions sx={{
                    padding: '8px 16px',
                    display: 'flex',
                    justifyContent: 'space-between',
                    background: 'transparent',
                    borderTop: 'none',
                    alignItems: 'center' // Додаємо для вирівнювання всіх елементів по центру
                }}>
                    <Box sx={{
                        display: 'flex',
                        alignItems: 'center',
                        gap: '8px',
                        height: '40px' // Фіксована висота для всіх рядків дій
                    }}>
                        {/* Views */}
                        <Button
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <Visibility sx={{
                                        color: '#b0b0b0',
                                        fontSize: '20px'
                                    }} />
                                </Box>
                            }
                            sx={{
                                minWidth: 'auto',
                                padding: '8px 16px',
                                color: '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: 0,
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: '14px',
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(views)}
                            </Typography>
                        </Button>

                        {/* Likes */}
                        <Button
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <Favorite sx={{
                                        color: isLiked ? '#ff4081' : '#b0b0b0',
                                        fontSize: '20px',
                                        transition: 'all 0.2s ease'
                                    }} />
                                </Box>
                            }
                            onClick={handleLike}
                            sx={{
                                minWidth: 'auto',
                                padding: '8px 16px',
                                color: isLiked ? '#ff4081' : '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: 0,
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: '14px',
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(currentLikes)}
                            </Typography>
                        </Button>

                        {/* Comments */}
                        <Button
                            startIcon={
                                <Box sx={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    height: '24px'
                                }}>
                                    <ChatBubbleOutline sx={{
                                        color: '#b0b0b0',
                                        fontSize: '20px'
                                    }} />
                                </Box>
                            }
                            sx={{
                                minWidth: 'auto',
                                padding: '8px 16px',
                                color: '#e0e0e0',
                                backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                borderRadius: '999px',
                                '&:hover': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                '& .MuiButton-startIcon': {
                                    marginRight: '8px',
                                    marginLeft: 0,
                                    height: '24px'
                                },
                                height: '40px'
                            }}
                        >
                            <Typography variant="subtitle2" sx={{
                                fontWeight: 500,
                                fontSize: '14px',
                                textTransform: 'none',
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                {formatNumber(comments)}
                            </Typography>
                        </Button>
                    </Box>

                    {/* Share Button */}
                    <Button
                        startIcon={
                            <Box sx={{
                                display: 'flex',
                                alignItems: 'center',
                                height: '24px'
                            }}>
                                <Share sx={{
                                    color: '#b0b0b0',
                                    fontSize: '20px'
                                }} />
                            </Box>
                        }
                        sx={{
                            minWidth: 'auto',
                            padding: '8px 16px',
                            color: '#e0e0e0',
                            backgroundColor: 'rgba(255, 255, 255, 0.05)',
                            borderRadius: '999px',
                            '&:hover': {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)'
                            },
                            '& .MuiButton-startIcon': {
                                marginRight: '8px',
                                marginLeft: 0,
                                height: '24px'
                            },
                            height: '40px'
                        }}
                    >
                        <Typography variant="subtitle2" sx={{
                            fontWeight: 500,
                            fontSize: '14px',
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
