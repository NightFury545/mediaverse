import React, { useState } from "react";
import { AppBar, Box, Drawer, IconButton, MenuItem, Toolbar, Typography } from "@mui/material";
import NotificationsIcon from "@mui/icons-material/Notifications";
import AccountCircleIcon from "@mui/icons-material/AccountCircle";
import MenuIcon from "@mui/icons-material/Menu";
import CloseIcon from "@mui/icons-material/Close"; // Іконка для закриття меню
import Search from "./Search.jsx";  // Оновлений компонент пошуку
import AuthModal from "../Auth/AuthModal.jsx";

const Navbar = () => {
    const [openDrawer, setOpenDrawer] = useState(false);
    const [openSignIn, setOpenSignIn] = useState(false);
    const [hoveredMenu, setHoveredMenu] = useState(null);
    const [hoveredSubMenu, setHoveredSubMenu] = useState(null);
    const [isMobile, setIsMobile] = useState(false);  // Для адаптивного пошуку

    const toggleDrawer = () => setOpenDrawer(!openDrawer);
    const handleSignInOpen = () => setOpenSignIn(true);
    const handleSignInClose = () => setOpenSignIn(false);
    const handleMenuHover = (menu) => setHoveredMenu(menu);
    const handleMenuLeave = () => setHoveredMenu(null);
    const handleSubMenuHover = (subMenu) => setHoveredSubMenu(subMenu);
    const handleSubMenuLeave = () => setHoveredSubMenu(null);

    // Слідкуємо за зміною розміру екрану
    React.useEffect(() => {
        const handleResize = () => setIsMobile(window.innerWidth <= 600);
        window.addEventListener("resize", handleResize);
        handleResize(); // Викликати одразу при першому рендері

        return () => window.removeEventListener("resize", handleResize);
    }, []);

    const menuItemStyles = {
        paddingLeft: "15px",
        paddingRight: "15px",
        color: "rgba(255, 255, 255, 0.7)",
        "&:hover": { color: "#ffffff" },
    };

    const subMenuStyles = (hovered) => ({
        backgroundColor: hovered ? "#666" : "transparent",
        borderRadius: "4px",
        "&:hover": { backgroundColor: "#666" },
        paddingLeft: "15px",
        paddingRight: "15px",
    });

    const dropdownMenu = (menuName, items) => (
        <Box
            onMouseEnter={() => handleMenuHover(menuName)}
            onMouseLeave={handleMenuLeave}
            sx={{ position: "relative", color: "rgba(255, 255, 255, 0.7)", "&:hover": { color: "#ffffff" } }}
        >
            <MenuItem sx={menuItemStyles}>{menuName}</MenuItem>
            {hoveredMenu === menuName && (
                <Box
                    sx={{
                        position: "absolute",
                        top: "100%",
                        left: 0,
                        backgroundColor: "rgba(0, 0, 0, 0.9)",
                        color: "#ffffff",
                        boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)",
                        borderRadius: "8px",
                        zIndex: 10,
                        opacity: hoveredMenu === menuName ? 1 : 0,
                        transition: "opacity 0.3s ease-in-out",
                    }}
                >
                    {items.map((item) => (
                        <MenuItem
                            key={item}
                            onMouseEnter={() => handleSubMenuHover(item)}
                            onMouseLeave={handleSubMenuLeave}
                            sx={subMenuStyles(hoveredSubMenu === item)}
                        >
                            {item}
                        </MenuItem>
                    ))}
                </Box>
            )}
        </Box>
    );

    return (
        <>
            <AppBar position="sticky" sx={{
                background: "transparent",
                backdropFilter: "blur(8px)",
                boxShadow: "none",
                borderBottom: "0.3px solid rgba(255, 255, 255, 0.05)"
            }}>
                <Toolbar sx={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                    <Box sx={{ display: "flex", alignItems: "center", gap: 4 }}>
                        {/* Кнопка меню */}
                        <IconButton
                            sx={{
                                display: { xs: "block", md: "none" },
                                color: "#ffffff",
                                fontSize: "30px", // Розмір
                                padding: "8px", // Зменшене відступи для менше виділення
                                borderRadius: "8px", // Округлі краї
                                "&:hover": { backgroundColor: "rgba(255, 255, 255, 0.05)" }, // Менше виділення
                                marginLeft: "0px", // Лівіше
                                marginTop: "4px", // Трохи нижче
                            }}
                            edge="start"
                            onClick={toggleDrawer}
                        >
                            <MenuIcon />
                        </IconButton>
                        {/* Задаємо стилі для MediaVerse */}
                        <Typography variant="h6"
                                    sx={{
                                        color: "#ffffff",
                                        fontWeight: "bold",
                                        textAlign: "left",
                                        flexGrow: 1,
                                        display: { xs: "none", md: "block" } // Приховуємо на мобільних
                                    }}>
                            MediaVerse
                        </Typography>
                        <Box sx={{ display: { xs: "none", md: "flex" }, gap: 3, alignItems: "center", paddingTop: "3px" }}>
                            {dropdownMenu("Головна", [])}
                            {dropdownMenu("Мережа", ["Чати", "Пости", "Коментарі"])}
                            {dropdownMenu("Фільми", ["Новинки", "Популярне", "Жанри"])}
                        </Box>
                    </Box>
                    <Box sx={{ display: "flex", alignItems: "center", gap: 2 }}>
                        <Search isMobile={isMobile} /> {/* Тепер передаємо isMobile, що адаптується */}
                        <IconButton sx={{ color: "#ffffff" }}><NotificationsIcon /></IconButton>
                        <IconButton sx={{ color: "#ffffff" }} onClick={handleSignInOpen}>
                            <AccountCircleIcon />
                        </IconButton>
                    </Box>
                </Toolbar>
            </AppBar>

            <Drawer anchor="left" open={openDrawer} onClose={toggleDrawer}
                    sx={{ "& .MuiDrawer-paper": { backgroundColor: "#000000", color: "#ffffff" } }}>
                <Box sx={{ width: 250, position: "relative" }}>
                    {/* Додаємо MediaVerse над хрестиком */}
                    <Typography variant="h6"
                                sx={{
                                    color: "#ffffff",
                                    fontWeight: "bold",
                                    textAlign: "center",
                                    marginTop: "13px",
                                    justifySelf: "left",
                                    marginLeft: "13px"
                                }}>
                        MediaVerse
                    </Typography>

                    {/* Кнопка для закриття меню */}
                    <IconButton
                        sx={{
                            color: "#ffffff",
                            position: "absolute",
                            top: "10px",
                            right: "10px",
                        }}
                        onClick={toggleDrawer}
                    >
                        <CloseIcon />
                    </IconButton>

                    <MenuItem onClick={toggleDrawer}>Головна</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Мережа</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Фільми</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Форум</MenuItem>
                </Box>
            </Drawer>

            {/* Модальне вікно входу */}
            <AuthModal open={openSignIn} handleClose={handleSignInClose} />
        </>
    );
};

export default Navbar;
